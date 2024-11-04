<?php

namespace App\Http\Middleware;

use Closure;
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
        $email = session('user_name');

        // ตรวจสอบ email ใน session
        $allowedEmail = 'keng@gmail.com';
        if (!$email || $email !== $allowedEmail) {
            // redirect หรือแสดง error หาก email ไม่ผ่าน
            return redirect('/pagelogin');
        }
        return $next($request);
    }
}
