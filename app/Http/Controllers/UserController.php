<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\quiz;

class UserController extends Controller
{
    public function show(): View
    {
        return view('user.index');
    }
    public function showform(): View
    {
        $quiz = Quiz::join('type_quizzes', 'quizzes.type_id', '=', 'type_quizzes.id_type_quizzes')
            ->where('quizzes.id_quizzes', '1')
            ->select('quizzes.*', 'type_quizzes.type_name')
            ->first();

        return view('user.form', ['quiz' => $quiz]);

    }
    public function shownextform(Request $request)
    {
       
        try {
            // ดึงข้อมูลคำตอบจากคำร้องขอ
            $answer = $request->input('answer');

            $quiz = Quiz::join('type_quizzes', 'quizzes.type_id', '=', 'type_quizzes.id_type_quizzes')
            ->where('quizzes.id_quizzes', '2')
            ->select('quizzes.*', 'type_quizzes.type_name')
            ->first();

            return response()->json(['message' => 'คำตอบถูกส่งเรียบร้อยแล้ว','quiz' => $quiz, 'answer' => $answer]);
        } catch (Exception $e) {
            // ส่ง error message กลับไปยัง client เพื่อช่วยในการ debug
            return response()->json(['error' => $e->getMessage()], 500);
        } 

    }
}
