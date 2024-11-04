<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\document;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{


 
    public function login(Request $request)
    {
        // Validate the login form data
        // $request->validate([
        //     'username' => 'required|email',
        //     'password' => 'required|min:20',
        // ]);
    
        // Retrieve the user record from the 'email' table

        $user = DB::table('email')
        ->where('email', $request->username)
        ->where('password', $request->password) // Direct comparison for plain text
        ->first();
    
    if ($user) {
        // Password is correct
        Session::put('user_id', $user->email_id);
        Session::put('user_name', $user->email);
        // Redirect or return a success response
        return response()->json(['success' => true, 'message' => 'Login successful']);
    } else {
        // Invalid credentials
        return response()->json(['success' => false, 'message' => 'Invalid email or password']);
    }
    }


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

        // $total_assets = DB::table('documents')->count();
        $total_assets = DB::table('documents')
        ->where("id_type","=","1")
        ->count();

        $total_assets_teacher = DB::table('documents')
        ->where("id_type","=","1")
        ->whereNotNull('start_teacher')
        ->count();

        $total_assets_employee = DB::table('documents')
        ->where("id_type","=","1")
        ->whereNotNull('start_employee')
        ->count();

        $total_assets_cotton = DB::table('documents')
        ->select('id_cotton')
        ->where('id_type', '=', '1')
        ->groupBy('id_cotton')
        ->get()
        ->count();
        // $total_assets_today = DB::table('documents')
        // ->whereDate('created_at', Carbon::today())
        // ->count();
        // return view('user.index');
        $total_all = DB::table('documents')
        ->select('id_type', DB::raw('count(*) as total'))
        ->groupBy('id_type')
        ->get();
        return view('user.page_data_process', ['documents' => $documents,
        // 'total_assets_today' => $total_assets_today ,
        'total_all'=> $total_all,
        'total_assets_teacher'=>$total_assets_teacher,
        'total_assets_cotton'=>$total_assets_cotton,
        'total_assets_employee'=>$total_assets_employee,
        'total_assets' => $total_assets]);
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

         // $total_assets = DB::table('documents')->count();
         $total_assets = DB::table('documents')
         ->where("id_type","=","2")
         ->count();
 
         $total_assets_teacher = DB::table('documents')
         ->where("id_type","=","2")
         ->whereNotNull('start_teacher')
         ->count();
 
         $total_assets_employee = DB::table('documents')
         ->where("id_type","=","2")
         ->whereNotNull('start_employee')
         ->count();
 
         $total_assets_cotton = DB::table('documents')
         ->select('id_cotton')
         ->where('id_type', '=', '2')
         ->groupBy('id_cotton')
         ->get()
         ->count();
        
        $total_all = DB::table('documents')
        ->select('id_type', DB::raw('count(*) as total'))
        ->groupBy('id_type')
        ->get();
        return view('user.page_data_project', ['documents' => $documents,
        // 'total_assets_today' => $total_assets_today ,
        'total_all'=> $total_all,
        'total_assets_teacher'=>$total_assets_teacher,
        'total_assets_cotton'=>$total_assets_cotton,
        'total_assets_employee'=>$total_assets_employee,
        'total_assets' => $total_assets]);
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

    $total_assets = DB::table('documents')
    ->where("id_type","=","3")
    ->count();

    $total_assets_teacher = DB::table('documents')
    ->where("id_type","=","3")
    ->whereNotNull('start_teacher')
    ->count();

    $total_assets_employee = DB::table('documents')
    ->where("id_type","=","3")
    ->whereNotNull('start_employee')
    ->count();

    $total_assets_cotton = DB::table('documents')
    ->select('id_cotton')
    ->where('id_type', '=', '3')
    ->groupBy('id_cotton')
    ->get()
    ->count();
        $total_all = DB::table('documents')
        ->select('id_type', DB::raw('count(*) as total'))
        ->groupBy('id_type')
        ->get();
        return view('user.page_data_product', ['documents' => $documents,
        // 'total_assets_today' => $total_assets_today ,
        'total_all'=> $total_all,
        'total_assets_teacher'=>$total_assets_teacher,
        'total_assets_cotton'=>$total_assets_cotton,
        'total_assets_employee'=>$total_assets_employee,
        'total_assets' => $total_assets]);
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
    

        $total_assets = DB::table('documents')
        ->whereNotNull('start_employee')
        ->count();
    
        $total_assets_emp_process = DB::table('documents')
        ->where("id_type","=","1")
        ->whereNotNull('start_employee')
        ->count();
    
        $total_assets_emp_project = DB::table('documents')
        ->where("id_type","=","2")
        ->whereNotNull('start_employee')
        ->count();
    
        $total_assets_emp_product = DB::table('documents')
        ->where("id_type","=","3")
        ->whereNotNull('start_employee')
        ->count();


        $data_employees = DB::table('employees')
            ->leftJoin('positions', 'id_position', '=', 'position_id')
            ->get();
    
        return view('user.employee', ['documents' => $documents, 
        'total_assets' => $total_assets,
        'total_assets_emp_process'=>$total_assets_emp_process,
        'total_assets_emp_product'=>$total_assets_emp_product,
        'total_assets_emp_project'=>$total_assets_emp_project,
        
        'data_employees' => $data_employees]);
    }








   // ฟังก์ชันแสดงหน้าเพิ่มข้อมูลเอกสาร
   public function create_process()
   {
       // ดึงข้อมูล ฝ่าย, ประเภท และ ปี
       $cottons = DB::table('cotton')->get();
       $types = DB::table('type_alls')->get();
       $years = DB::table('years')->get();
   
       // ดึงข้อมูลอาจารย์ พร้อมตำแหน่งทางวิชาการ
       $teachers = DB::table('teachers')
                   ->join('academics', 'teachers.id_aca', '=', 'academics.academic_id')
                   ->select('teachers.*', 'academics.academic_name', 'academics.academic_stort_name')
                   ->get();
   
       // ดึงข้อมูลพนักงาน พร้อมตำแหน่งทางวิชาการ
       $employees = DB::table('employees')
                   ->join('academics', 'employees.id_aca', '=', 'academics.academic_id')
                   ->select('employees.*', 'academics.academic_name', 'academics.academic_stort_name')
                   ->get();
   
       return view('user.create.page_create_process', compact('cottons', 'types', 'teachers', 'employees', 'years'));
   }
   // บันทึกข้อมูลเอกสารใหม่ลงในฐานข้อมูล
   public function store_process(Request $request)
   {
       // ตรวจสอบความถูกต้องของข้อมูล
       $request->validate([
        'id_number' => 'required|string|max:255',
        'document_name' => 'required|string|max:255',
        'version' => 'required|integer',
        'end_time' => 'required|date',
        'id_cotton' => 'required|integer',
        'id_type' => 'required|integer',
        'start_teacher' => 'nullable|string',
        'start_employee' => 'nullable|string',
        'description' => 'nullable|string|max:1000', // เพิ่ม validation สำหรับ description
    ]);
       // บันทึกข้อมูลลงในฐานข้อมูล
       
       try {
        DB::table('documents')->insert([
            'documnet_id' => Str::uuid(),
            'id_number' => $request->id_number,
            'document_name' => $request->document_name,
            'version' => $request->version,
            'end_time' => $request->end_time,
            'id_year' => $request->id_years, 
            'id_cotton' => $request->id_cotton,
            'id_type' => $request->id_type,
            'description' => $request->description ?? null, 
            'start_teacher' => $request->start_teacher ?? null, 
            'start_employee' => $request->start_employee ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error("Error inserting document: " . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
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
        $data_teachers = DB::table('teachers')
        ->leftJoin('academics', 'id_aca', '=', 'academic_id')
        ->leftJoin('positions', 'id_position', '=', 'position_id')
        ->get();

        $total_assets = DB::table('documents')
        ->whereNotNull('start_teacher')
        ->count();
    
        $total_assets_teacher_process = DB::table('documents')
        ->where("id_type","=","1")
        ->whereNotNull('start_teacher')
        ->count();
    
        $total_assets_teacher_project = DB::table('documents')
        ->where("id_type","=","2")
        ->whereNotNull('start_teacher')
        ->count();
    
        $total_assets_teacher_product = DB::table('documents')
        ->where("id_type","=","3")
        ->whereNotNull('start_teacher')
        ->count();


        // return view('user.index');
        return view('user.teacher', ['documents' => $documents,
        'total_assets' => $total_assets,
        'total_assets_teacher_process'=>$total_assets_teacher_process,
        'total_assets_teacher_product'=>$total_assets_teacher_product,
        'total_assets_teacher_project'=>$total_assets_teacher_project,
        'data_teachers'=>$data_teachers]);
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


    // โชว์ข้อมูลที่นำไปสำหรับแก้ไข หรืออัพโหลดไฟล์
    public function selectshowdata_get($id)
    {
        $id = base64_decode($id);
        // $id = base64_decode($encodedId);
        // dd($id);
        $document = DB::table('documents')
        ->leftJoin('type_alls', 'documents.id_type', '=', 'type_alls.type_all_id')
        ->leftJoin('teachers', 'documents.start_teacher', '=', 'teachers.teacher_id')
        ->leftJoin('employees', 'documents.start_employee', '=', 'employees.emp_id')
        ->leftJoin('cotton', 'documents.id_cotton', '=', 'cotton.cotton_id')
        ->leftJoin('years', 'documents.id_year', '=', 'years.year_id')
        ->leftJoin('academics', 'teachers.id_aca', '=', 'academics.academic_id') // ระบุชื่อตารางให้ชัดเจน
        ->where('documents.documnet_id', '=', $id)
        ->first();

        $file_all_document = DB::table('file_alls')
        ->where('id_documnet', '=', $id)
        ->get()->map(function($file) {
            $file->updated_at = \Carbon\Carbon::parse($file->updated_at);
            $file->created_at = \Carbon\Carbon::parse($file->created_at);
            return $file;
        });

        if (!$document) {
            abort(404, 'Document not found');
        }

    // return response()->json(['document' => $document]);
    return view('user.page_select_data', ['documents' => $document,'file_all_document'=>$file_all_document]);

    }





// แก้ไขข้อมูล id_number ทั้งหมด
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
                    ->update(['id_number' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "name"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['document_name' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "description"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['description' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "version"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['version' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "end_time"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['end_time' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                    return response()->json(['success' => true, 'message' =>  $newIdValue]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "year"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['id_year' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                        $val_update = DB::table('years')
                        ->where('year_id', '=', $newIdValue)
                        ->first(['year_name']);
                    return response()->json(['success' => true, 'message' =>  "ค.ศ.".$val_update->year_name]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "cotton"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['id_cotton' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                        $val_update = DB::table('cotton')
                        ->where('cotton_id', '=', $newIdValue)
                        ->first(['cotton_name']);
                    return response()->json(['success' => true, 'message' => $val_update->cotton_name]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "types"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['id_type' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                        $val_update = DB::table('type_alls')
                        ->where('type_all_id', '=', $newIdValue)
                        ->first(['type_all_name']);
                    return response()->json(['success' => true, 'message' => $val_update->type_all_name]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "teachers"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['start_teacher' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                        $val_update = DB::table('teachers')
                        ->where('teacher_id', '=', $newIdValue)
                        ->first(['teacher_name','teacher_lname']);
                    return response()->json(['success' => true, 'message' => $val_update->teacher_name]);
                } else {
                    return response()->json(['success' => false, 'message' => 'No rows were updated. The value might be the same as before.']);
                }
            }else  if($edit_col == "employees"){
                $affected = DB::table('documents')
                    ->where('documnet_id', $id_col)
                    ->update(['start_employee' => $newIdValue
                    , 'updated_at' => now()
                ]);
                if ($affected > 0) {
                        $val_update = DB::table('employees')
                        ->where('emp_id', '=', $newIdValue)
                        ->first(['emp_name','emp_lname']);
                    return response()->json(['success' => true, 'message' => $val_update->emp_name]);
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
public function get_data_cotton(Request $request)
{
    try {
        $cottons = DB::table('cotton')->get();
        return response()->json(['success' => true, 'data' => $cottons]);
    } catch (Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

public function add_data_new_DB(Request $request)
{
    try {
        $newIdValue = $request->input('val_add');
        $add_col = $request->input('type');
        
        if($add_col == "add_year"){
            // ตรวจสอบว่ามีข้อมูลในตาราง years ที่ตรงกับ id หรือไม่
            $affected = DB::table('years')
                          ->where('year_name', $newIdValue)
                          ->count();
        
            // ถ้าไม่มีข้อมูล ให้ทำการเพิ่มข้อมูลใหม่
            if ($affected == 0) {
                $aff_years = DB::table('years')->insert([
                    ['year_name' =>  $newIdValue]
                ]);
                
                if ($aff_years) {
                    return response()->json(['success' => true, 'message' => "เพิ่มข้อมูลปี ค.ศ." . $newIdValue . " เรียบร้อยแล้ว"]);
                } else {
                    return response()->json(['success' => false, 'message' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาลองใหม่อีกครั้ง']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'ข้อมูลปี ค.ศ.' . $newIdValue . ' มีอยู่แล้วในระบบ']);
            }
        }else  if($add_col == "add_cotton"){
            // ตรวจสอบว่ามีข้อมูลในตาราง years ที่ตรงกับ id หรือไม่
            $affected = DB::table('cotton')
                          ->where('cotton_name', $newIdValue)
                          ->count();
        
            // ถ้าไม่มีข้อมูล ให้ทำการเพิ่มข้อมูลใหม่
            if ($affected == 0) {
                $aff_years = DB::table('cotton')->insert([
                    ['cotton_name' =>  $newIdValue]
                ]);
                
                if ($aff_years) {
                    return response()->json(['success' => true, 'message' => "" . $newIdValue . " เรียบร้อยแล้ว"]);
                } else {
                    return response()->json(['success' => false, 'message' => 'ไม่สามารถเพิ่มข้อมูลได้ กรุณาลองใหม่อีกครั้ง']);
                }
            } else {
                return response()->json(['success' => false, 'message' => '' . $newIdValue . ' มีอยู่แล้วในระบบ']);
            }
        }
    } catch (Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}




public function get_data_type(Request $request)
{
    try {
        $types = DB::table('type_alls')->get();
        return response()->json(['success' => true, 'data' => $types]);
    } catch (Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}



public function get_data_teachers(Request $request)
{
    try {
        $data_teachers = DB::table('teachers')
        ->leftJoin('academics', 'id_aca', '=', 'academic_id')
        ->get();
        return response()->json(['success' => true, 'data' => $data_teachers]);
    } catch (Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}




public function get_data_employee(Request $request)
{
    try {
        $data_employees = DB::table('employees')->get();
        return response()->json(['success' => true, 'data' => $data_employees]);
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





    // uploadfile
  
public function uploadFile(Request $request, $id)
{    
    $id_col = base64_decode($id);
    if ($request->file('file')) {
        $name = $request->input('name-input');
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        // สร้างชื่อไฟล์ด้วย UUID
        $fileName = Str::uuid() . '.' . $extension;
        $filePath = $file->storeAs('uploads', $fileName, 'public');
        $url = 'storage/' . $filePath;

        // แปลงหน้าแรกของ PDF เป็น PNG ถ้าเป็น PDF
       

        // บันทึกข้อมูลลงในฐานข้อมูลด้วย Query Builder
        DB::table('file_alls')->insert([
            'file_all_id' => (string) Str::uuid(), // Generate a UUID using Laravel helper
            'file_all_name' => $name,
            'file_url' => $url,
            'thumbnail_url' => null, // Store the thumbnail URL if available
            'status' => '1',
            'id_documnet' =>     $id_col, // Fixed the spelling to 'id_document'
        ]);

        return response()->json(['success' => true, 'filePath' => $url]);
    }

    return response()->json(['success' => false]);
}

public function changeStatus(Request $request)
{
    // ตรวจสอบว่ามีไฟล์ที่มี ID ที่กำหนดอยู่หรือไม่
    $file = DB::table('file_alls')->where('file_all_id', $request->fileId)->first();

    if ($file) {
        // ใช้ Query Builder ในการอัปเดตสถานะ
        DB::table('file_alls')
            ->where('file_all_id', $request->fileId)
            ->update(['status' => $request->status
            , 'updated_at' => now()]);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => $request->input('fileId')]);
}





// เพิ่ม cread_teacher_new 

public function create_teacher()
{
    // ดึงข้อมูลจากตาราง positions, sexes และ academics เพื่อนำมาใช้ในแบบฟอร์ม
    $positions = DB::table('positions')->get();
    $sexes = DB::table('sexes')->get();
    $academics = DB::table('academics')->get();

    return view('user.create.page_create_teacher', compact('positions', 'sexes', 'academics'));
}
public function store_teacher(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'teacher_lname' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_position' => 'required|integer',
            'id_sex' => 'required|integer',
            'id_aca' => 'required|integer',
        ]);

        // อัปโหลดรูปภาพ
        $pictureUrl = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = Str::uuid() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('public/uploads/teachers', $pictureName);
            $pictureUrl = 'storage/uploads/teachers/' . $pictureName;
        }

        // บันทึกข้อมูลโดยใช้ Query Builder
        DB::table('teachers')->insert([
            'teacher_id' => Str::uuid(),
            'teacher_name' => $request->teacher_name,
            'teacher_lname' => $request->teacher_lname,
            'picture_url' => $pictureUrl,
            'id_position' => $request->id_position,
            'id_sex' => $request->id_sex,
            'id_aca' => $request->id_aca,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['success' => true]);
    }
    public function edit_teacher($id)
    {
        // ดึงข้อมูลอาจารย์ที่ต้องการแก้ไข
        $teacher = DB::table('teachers')->where('teacher_id', $id)->first();

        // ดึงข้อมูลตำแหน่ง, เพศ, และคำนำหน้า
        $positions = DB::table('positions')->get();
        $sexes = DB::table('sexes')->get();
        $academics = DB::table('academics')->get();

        // ส่งข้อมูลไปที่ view
        return view('user.edit.page_edit_teacher', compact('teacher', 'positions', 'sexes', 'academics'));
    }

    public function update_teacher(Request $request, $id)
    {
        $request->validate([
            'teacher_name' => 'required|string|max:255',
            'teacher_lname' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_position' => 'required|integer',
            'id_sex' => 'required|integer',
            'id_aca' => 'required|integer',
        ]);

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
        $pictureUrl = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = Str::uuid() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('public/uploads/teachers', $pictureName);
            $pictureUrl = 'storage/uploads/teachers/' . $pictureName;
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        DB::table('teachers')->where('teacher_id', $id)->update([
            'teacher_name' => $request->teacher_name,
            'teacher_lname' => $request->teacher_lname,
            'picture_url' => $pictureUrl ?? DB::table('teachers')->where('teacher_id', $id)->value('picture_url'),
            'id_position' => $request->id_position,
            'id_sex' => $request->id_sex,
            'id_aca' => $request->id_aca,
            'updated_at' => now()
        ]);

        return response()->json(['success' => true]);
    }




    // เพิ่มข้อมูลของ employee
    public function create_employee()
{
    // ดึงข้อมูลจากตาราง positions, sexes และ academics เพื่อนำมาใช้ในแบบฟอร์ม
    $positions = DB::table('positions')->get();
    $sexes = DB::table('sexes')->get();
    $academics = DB::table('academics')->get();

    return view('user.create.page_create_employee', compact('positions', 'sexes', 'academics'));
}
public function edit_employee($id)
{
    // ดึงข้อมูลอาจารย์ที่ต้องการแก้ไข
    $employee = DB::table('employees')->where('emp_id', $id)->first();

    // ดึงข้อมูลตำแหน่ง, เพศ, และคำนำหน้า
    $positions = DB::table('positions')->get();
    $sexes = DB::table('sexes')->get();
    $academics = DB::table('academics')->get();

    // ส่งข้อมูลไปที่ view
    return view('user.edit.page_edit_employee', compact('employee', 'positions', 'sexes', 'academics'));
}
public function store_employee(Request $request)
{
    $request->validate([
        'emp_name' => 'required|string|max:255',
        'emp_lname' => 'required|string|max:255',
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'id_position' => 'required|integer',
        'id_sex' => 'required|integer',
        'id_aca' => 'required|integer',
    ]);

    // อัปโหลดรูปภาพ
    $pictureUrl = null;
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        $pictureName = Str::uuid() . '.' . $picture->getClientOriginalExtension();
        $picture->storeAs('public/uploads/employees', $pictureName);
        $pictureUrl = 'storage/uploads/employees/' . $pictureName;
    }

    // บันทึกข้อมูลโดยใช้ Query Builder
    DB::table('employees')->insert([
        'emp_id' => Str::uuid(),
        'emp_name' => $request->emp_name,
        'emp_lname' => $request->emp_lname,
        'picture_url' => $pictureUrl,
        'id_position' => $request->id_position,
        'id_sex' => $request->id_sex,
        'id_aca' => $request->id_aca,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return response()->json(['success' => true]);
}
public function update_employee(Request $request, $id)
{
    $request->validate([
        'emp_name' => 'required|string|max:255',
        'emp_lname' => 'required|string|max:255',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'id_position' => 'required|integer',
        'id_sex' => 'required|integer',
        'id_aca' => 'required|integer',
    ]);

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
    $pictureUrl = null;
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        $pictureName = Str::uuid() . '.' . $picture->getClientOriginalExtension();
        $picture->storeAs('public/uploads/employees', $pictureName);
        $pictureUrl = 'storage/uploads/employees/' . $pictureName;
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    DB::table('employees')->where('emp_id', $id)->update([
        'emp_name' => $request->emp_name,
        'emp_lname' => $request->emp_lname,
        'picture_url' => $pictureUrl ?? DB::table('employees')->where('emp_id', $id)->value('picture_url'),
        'id_position' => $request->id_position,
        'id_sex' => $request->id_sex,
        'id_aca' => $request->id_aca,
        'updated_at' => now()
    ]);

    return response()->json(['success' => true]);
}
}