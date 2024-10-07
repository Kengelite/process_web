<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\document;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserController extends Controller
{
    public function show(): View
    {
        $documents = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->select('documents.*', 'type_alls.type_all_name', 'teachers.teacher_name', 'employees.emp_name', 'cotton.cotton_name', 'years.year_name')
        ->get();
        foreach ($documents as $document) {
            $document->encoded_id = base64_encode($document->documnet_id);
        }
        foreach ($documents as $document) {
        if ($document->end_time) {
            $endDate = Carbon::parse($document->end_time);
            $daysRemaining = (int) Carbon::now()->diffInDays($endDate, false);
            if ($daysRemaining <= 0) {
                $document->days_remaining = "สิ้นสุด";
            } else {
                $document->days_remaining = $daysRemaining . " วัน";
            }
        } else {
            $document->days_remaining = "ไม่ได้ระบุวัน"; // หรือค่าเริ่มต้นที่คุณต้องการ
        }
    }

        $total_assets = DB::table('documents')->count();
        // $total_assets_today = DB::table('documents')
        // ->whereDate('created_at', Carbon::today())
        // ->count();
        // return view('user.index');
        $total_all = DB::table('documents')
        ->select('id_type', DB::raw('count(*) as total'))
        ->groupBy('id_type')
        ->get();
        return view('user.index', ['documents' => $documents,
        // 'total_assets_today' => $total_assets_today ,
        'total_all'=> $total_all,
        'total_assets' => $total_assets]);
    }
    public function showprocess(): View
    {
        $documents = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->where('id_type' ,'=' , '1')
        ->get();
        // return view('user.index');
        return view('user.page_data_process', ['documents' => $documents]);
    }
    public function showproject(): View
    {
        $documents = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->where('id_type' ,'=' , '2')
        ->get();
        // return view('user.index');
        return view('user.page_data_project', ['documents' => $documents]);
    }
    public function showproduct(): View
    {
        $documents = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->where('id_type' ,'=' , '3')
        ->get();
        // return view('user.index');
        return view('user.page_data_product', ['documents' => $documents]);
    }
    public function showemployee(): View
    {
        $documents = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->whereNotNull('emp_id')
        ->get();
        // return view('user.index');
        return view('user.employee', ['documents' => $documents]);
    }
    public function showeteacher(): View
    {
        $documents = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->whereNotNull('teacher_id')
        ->get();
        // return view('user.index');
        return view('user.teacher', ['documents' => $documents]);
    }
    public function showform(): View
    {
        // $quiz = Quiz::join('type_quizzes', 'quizzes.type_id', '=', 'type_quizzes.id_type_quizzes')
        //     ->where('quizzes.id_quizzes', '1')
        //     ->select('quizzes.*', 'type_quizzes.type_name')
        //     ->first();
        return view('user.index');
        // return view('user.form', ['quiz' => $quiz]);

    }
    public function dataPage()
    {
    $documents = session('document');
    if (!$documents) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูล');
    }
    return view('user.page_select_data', compact('documents'));
    }   
    public function selectshowdata(Request $request)
    {
        
        $encodedId = $request->input('id');
        $id = base64_decode($encodedId);
    
    $document = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->where('documnet_id', '=', $id)
        ->first();

    if (!$document) {
        abort(404, 'Document not found');
    }

    // return response()->json(['document' => $document]);
    session(['document' => $document]);
    return response()->json(['redirect_url' => route('data_page')]);
    }



    public function selectshowdata_get($id)
    {
        $id = base64_decode($id);
        // $id = base64_decode($encodedId);
        // dd($id);
        $document = DB::table('documents')
        ->leftJoin('type_alls', 'id_type', '=', 'type_all_id')
        ->leftJoin('teachers', 'start_teacher', '=', 'teacher_id')
        ->leftJoin('employees', 'start_employee', '=', 'emp_id')
        ->leftJoin('cotton', 'id_cotton', '=', 'cotton_id')
        ->leftJoin('years', 'id_year', '=', 'year_id')
        ->where('documnet_id', '=', $id)
        ->first();

        if (!$document) {
            abort(404, 'Document not found');
        }

    // return response()->json(['document' => $document]);
    return view('user.page_select_data', ['documents' => $document]);

    }





// แก้ไขข้อมูล id_number
public function edit_number_controller(Request $request, $id)
{
    if ($id) {
        // Base64 decode ถ้า id ถูกเข้ารหัส
        $id_col = base64_decode($id);
        $newIdValue = $request->input('data_value');
        $edit_col = $request->input('edit_col');
        // ตรวจสอบว่า id มีค่าและไม่ใช่ค่าว่าง
        if (!empty($id_col) && !empty($newIdValue) && !empty($edit_col)) {
            // ทำการอัพเดตข้อมูลหรือการดำเนินการที่ต้องการ

            if($edit_col == "id_number"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['id_number' => $newIdValue]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "name"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['document_name' => $newIdValue]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "version"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['version' => $newIdValue]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "end_time"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['end_time' => $newIdValue]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "year"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['year' => $newIdValue]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }
            

        } else {
            return response()->json(['success' => false, 'message' => 'Invalid ID or data value']);
        }
    }else{
        return response()->json(['success' => false, 'message' => 'No ID provided']);
    }
    
}


public function get_data_year(Request $request)
{
    try {
        $years = DB::table('years')->get();
        return response()->json(['success' => true, 'data' => $years]);
    } catch (Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}
    public function shownextform(Request $request)
    {
       
        // try {
        //     // ดึงข้อมูลคำตอบจากคำร้องขอ
        //     $answer = $request->input('answer');

        //     $quiz = Quiz::join('type_quizzes', 'quizzes.type_id', '=', 'type_quizzes.id_type_quizzes')
        //     ->where('quizzes.id_quizzes', '2')
        //     ->select('quizzes.*', 'type_quizzes.type_name')
        //     ->first();

        //     return response()->json(['message' => 'คำตอบถูกส่งเรียบร้อยแล้ว','quiz' => $quiz, 'answer' => $answer]);
        // } catch (Exception $e) {
        //     // ส่ง error message กลับไปยัง client เพื่อช่วยในการ debug
        //     return response()->json(['error' => $e->getMessage()], 500);
        // } 
        return response()->json(['error' => 'กกก'], 500);
    }
}