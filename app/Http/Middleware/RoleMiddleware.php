<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * ตรวจสอบสิทธิ์ (Role) ว่าตรงกับที่กำหนดใน Route หรือไม่
     * ใช้งาน: ->middleware('role:admin') หรือ ->middleware('role:user')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // เช็คว่ามีค่าใน Session หรือไม่
        $currentRole = session('role');

        if (!$currentRole || $currentRole !== $role) {
            // หากไม่มีสิทธิ์ ให้ดีดออกไปหน้า Login หรือหน้าแจ้งเติอนไม่มีสิทธิ์
            return back()->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }

        return $next($request);
    }
}
