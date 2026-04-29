<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\File;

class FileController extends Controller
{
    /**
     * แสดงรายการไฟล์ MOU
     * super_admin เห็นทุกไฟล์ / คนอื่นเห็นเฉพาะไฟล์ตัวเอง
     */
    public function index(Request $request)
    {
        $user = $request->attributes->get('current_user');

        if ($user->role === 'super_admin') {
            // Super Admin เห็นทุกไฟล์
            $files = DB::table('files')
                ->leftJoin('users', 'files.uploaded_by_user_id', '=', 'users.user_id')
                ->whereNull('files.deleted_at')
                ->select('files.*', 'users.name as uploader_name', 'users.email as uploader_email', 'users.role as uploader_role')
                ->orderBy('files.created_at', 'desc')
                ->get();
        } else {
            // User ทั่วไปเห็นเฉพาะไฟล์ตัวเอง
            $files = DB::table('files')
                ->leftJoin('users', 'files.uploaded_by_user_id', '=', 'users.user_id')
                ->where('files.uploaded_by_user_id', $user->user_id)
                ->whereNull('files.deleted_at')
                ->select('files.*', 'users.name as uploader_name', 'users.email as uploader_email')
                ->orderBy('files.created_at', 'desc')
                ->get();
        }

        return view('user.mou', [
            'files' => $files,
            'currentUser' => $user,
        ]);
    }

    /**
     * อัปโหลดไฟล์ MOU พร้อมบีบอัดไฟล์
     */
    public function store(Request $request)
    {
        $user = $request->attributes->get('current_user');

        // 1. Validate ไฟล์ (สูงสุด 40MB)
        try {
            $request->validate([
                'file' => 'required|file|max:40960|mimes:pdf,doc,docx',
            ], [
                'file.required' => 'กรุณาเลือกไฟล์',
                'file.max' => 'ขนาดไฟล์ต้องไม่เกิน 40MB',
                'file.mimes' => 'อนุญาตเฉพาะไฟล์ PDF, DOC, DOCX เท่านั้น',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        $uploadedFile = $request->file('file');

        if (!$uploadedFile->isValid()) {
            return back()->with('swal_error', 'ไฟล์ไม่สมบูรณ์ กรุณาลองใหม่อีกครั้ง');
        }

        $extension = strtolower($uploadedFile->getClientOriginalExtension());
        $originalName = $uploadedFile->getClientOriginalName();
        $tempPath = $uploadedFile->getRealPath();
        
        // กำหนดเส้นทางเก็บไฟล์จริง
        $storedName = time() . '_' . uniqid();
        $finalExtension = $extension;
        
        DB::beginTransaction();
        try {
            // --- Algorithm บีบอัดไฟล์ ---
            $compressedPath = storage_path('app/private/mou_files/temp_' . $storedName . '.' . $extension);
            if (!file_exists(storage_path('app/private/mou_files'))) {
                mkdir(storage_path('app/private/mou_files'), 0755, true);
            }

            if ($extension === 'pdf') {
                // บีบอัด PDF ด้วย Ghostscript (ถ้ามี)
                $gsCommand = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=" . escapeshellarg($compressedPath) . " " . escapeshellarg($tempPath);
                shell_exec($gsCommand);
                
                // เช็คว่าบีบอัดสำเร็จและขนาดเล็กลงจริงไหม
                if (file_exists($compressedPath) && filesize($compressedPath) < filesize($tempPath)) {
                    $finalPath = 'private/mou_files/' . $storedName . '.pdf';
                    Storage::disk('local')->put($finalPath, file_get_contents($compressedPath));
                    unlink($compressedPath);
                } else {
                    // ถ้าบีบไม่ลง หรือไม่มี GS ให้ใช้ไฟล์เดิม
                    $finalPath = $uploadedFile->storeAs('private/mou_files', $storedName . '.pdf', 'local');
                    if (file_exists($compressedPath)) unlink($compressedPath);
                }
                $fileType = 'pdf';
            } else {
                // บีบอัด DOC/DOCX ด้วยการทำเป็น ZIP
                $zipPath = storage_path('app/private/mou_files/' . $storedName . '.zip');
                $zip = new \ZipArchive();
                if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                    $zip->addFile($tempPath, $originalName);
                    $zip->close();
                    $finalPath = 'private/mou_files/' . $storedName . '.zip';
                    $finalExtension = 'zip';
                } else {
                    // ถ้าบีบไม่สำเร็จ ให้เก็บไฟล์เดิม
                    $finalPath = $uploadedFile->storeAs('private/mou_files', $storedName . '.' . $extension, 'local');
                }
                $fileType = 'document';
            }

            // บันทึกลง Database
            DB::table('files')->insert([
                'uploaded_by_user_id' => $user->user_id,
                'file_path' => $finalPath,
                'file_size' => Storage::disk('local')->size($finalPath),
                'file_type' => $fileType,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return redirect()->route('mou.index')->with('success', 'อัปโหลดและบีบอัดไฟล์ "' . $originalName . '" สำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('MOU Upload Error: ' . $e->getMessage(), ['user_id' => $user->user_id, 'file' => $originalName]);
            
            // ลบไฟล์ที่อาจค้างอยู่ใน Storage
            if (isset($finalPath) && Storage::disk('local')->exists($finalPath)) {
                Storage::disk('local')->delete($finalPath);
            }

            return back()->with('swal_error', 'เกิดข้อผิดพลาดทางเทคนิค ไม่สามารถบันทึกไฟล์ได้');
        }
    }

    /**
     * ลบไฟล์ MOU (Soft Delete)
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->attributes->get('current_user');

        try {
            $file = DB::table('files')
                ->where('file_id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$file) {
                return redirect()->route('mou.index')->with('swal_error', 'ไม่พบไฟล์ที่ต้องการลบ');
            }

            // ตรวจสอบสิทธิ์: เจ้าของไฟล์ หรือ super_admin เท่านั้น
            if ($user->role !== 'super_admin' && $file->uploaded_by_user_id !== $user->user_id) {
                return redirect()->route('mou.index')->with('swal_error', 'คุณไม่มีสิทธิ์ลบไฟล์นี้');
            }

            DB::beginTransaction();

            // Soft delete ใน Database
            DB::table('files')->where('file_id', $id)->update([
                'deleted_at' => now(),
            ]);

            // ลบไฟล์จริงออกจาก Storage
            if (Storage::disk('local')->exists($file->file_path)) {
                Storage::disk('local')->delete($file->file_path);
            }

            DB::commit();
            return redirect()->route('mou.index')->with('success', 'ลบไฟล์สำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('MOU Delete Error: ' . $e->getMessage(), ['user_id' => $user->user_id, 'file_id' => $id]);
            return back()->with('swal_error', 'ไม่สามารถลบไฟล์ได้เนื่องจากข้อผิดพลาดของระบบ');
        }
    }

    /**
     * ดาวน์โหลดไฟล์ MOU อย่างปลอดภัย
     */
    public function download(Request $request, $id)
    {
        $user = $request->attributes->get('current_user');

        $file = DB::table('files')
            ->where('file_id', $id)
            ->whereNull('deleted_at')
            ->first();

        if (!$file) {
            abort(404, 'ไม่พบไฟล์');
        }

        // ตรวจสอบสิทธิ์
        if ($user->role !== 'super_admin' && $file->uploaded_by_user_id !== $user->user_id) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้');
        }

        $fullPath = storage_path('app/' . $file->file_path);

        if (!file_exists($fullPath)) {
            abort(404, 'ไม่พบไฟล์ในระบบ');
        }

        // ดึงชื่อไฟล์เดิมจาก path
        $filename = basename($file->file_path);

        return response()->download($fullPath, $filename);
    }

    /**
     * Preview ไฟล์ (เฉพาะ PDF — ส่ง inline เข้าเบราว์เซอร์)
     */
    public function preview(Request $request, $id)
    {
        $user = $request->attributes->get('current_user');

        $file = DB::table('files')
            ->where('file_id', $id)
            ->whereNull('deleted_at')
            ->first();

        if (!$file) {
            abort(404, 'ไม่พบไฟล์');
        }

        // ตรวจสอบสิทธิ์
        if ($user->role !== 'super_admin' && $file->uploaded_by_user_id !== $user->user_id) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้');
        }

        $fullPath = storage_path('app/' . $file->file_path);

        if (!file_exists($fullPath)) {
            abort(404, 'ไม่พบไฟล์ในระบบ');
        }

        // กำหนด Content-Type ตามชนิดไฟล์
        $mimeType = mime_content_type($fullPath);

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($file->file_path) . '"',
        ]);
    }
}
