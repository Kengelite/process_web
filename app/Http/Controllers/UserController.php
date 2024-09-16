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
        ->get();

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