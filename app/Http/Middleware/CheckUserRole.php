<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tokenString = session('token');

        if (!$tokenString) {
            session()->flush();
            return redirect('/pagelogin')->with('error', 'กรุณาเข้าสู่ระบบผ่านระบบใหม่');
        }

        // 1. ถอดรหัสและตรวจสอบลายเซ็น JWT (Verify Signature)
        $payload = \App\Utils\JwtUtil::verifyToken($tokenString);

        if (!$payload) {
            session()->flush();
            return redirect('/pagelogin')->with('error', 'เซสชั่นไม่ถูกต้องหรือถูกปลอมแปลง');
        }

        // 2. เช็ควันหมดอายุใน Payload
        if ($payload['expires_at'] < time()) {
            session()->flush();
            return redirect('/pagelogin')->with('error', 'เซสชั่นหมดอายุ กรุณาล็อกอินใหม่');
        }

        // 3. ตรวจสอบใน Database ว่า Token นี้มีอยู่จริง และยังไม่ถูก Revoked ใช่หรือไม่
        $dbToken = DB::table('tokens')
            ->where('token', $tokenString)
            ->where('user_id', $payload['user_id'])
            ->first();

        if (!$dbToken || $dbToken->revoked || strtotime($dbToken->expires_at) < time()) {
            session()->flush();
            return redirect('/pagelogin')->with('error', 'การเข้าสู่ระบบถูกยกเลิกแล้วจากการเข้าสู่ระบบที่อื่น');
        }

        // 4. ตรวจสอบข้อมูล User ว่ามีอยู่จริงและ Role ตรงกับการอนุญาต
        $user = DB::table('users')->where('user_id', $payload['user_id'])->first();

        if (!$user || $user->role !== $payload['role']) {
            session()->flush();
            return redirect('/pagelogin')->with('error', 'ไม่มีสิทธิ์เข้าถึงหรือข้อมูลผู้ใช้งานไม่ตรงกัน');
        }

        // 5. หากผ่านทุกประการ อัปเดตเวลาใช้งานล่าสุด
        DB::table('tokens')->where('token_id', $dbToken->token_id)->update(['last_used_at' => now()]);

        // 6. ส่งต่อข้อมูลผู้ใช้ไปให้ Controller ใช้งานได้ทันที 
        $request->attributes->add([
            'current_user'     => $user,
            'token_payload'    => $payload
        ]);

        return $next($request);
    }
}
