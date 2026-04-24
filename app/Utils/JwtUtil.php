<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class JwtUtil
{
    /**
     * แปลง TTL (เช่น 15m, 24h, 7d) เป็น Carbon expires_at
     */
    public static function parseTTL(string $ttl): Carbon
    {
        $value = (int) preg_replace('/[^0-9]/', '', $ttl);
        $unit = strtolower(preg_replace('/[^a-zA-Z]/', '', $ttl));

        $expiresAt = Carbon::now();
        switch ($unit) {
            case 'm':
                $expiresAt->addMinutes($value);
                break;
            case 'h':
                $expiresAt->addHours($value);
                break;
            case 'd':
                $expiresAt->addDays($value);
                break;
            default:
                // Default 24 hours if format is wrong
                $expiresAt->addHours(24);
                break;
        }

        return $expiresAt;
    }

    /**
     * สร้าง JWT Token พร้อมเข้ารหัส HMAC SHA256
     */
    public static function createToken(array $payload): string
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $base64UrlHeader = self::base64UrlEncode($header);
        
        $base64UrlPayload = self::base64UrlEncode(json_encode($payload));
        
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, Config::get('jwt.secret_key'), true);
        $base64UrlSignature = self::base64UrlEncode($signature);

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    /**
     * ถอดรหัสและตรวจสอบลายเซ็น JWT Token
     * @return array|null คืนค่า Array ของ payload ถ้าถูกต้อง ไม่ถูกดัดแปลง คืนค่า null หากปลอมแปลง
     */
    public static function verifyToken(string $token): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }

        [$base64UrlHeader, $base64UrlPayload, $base64UrlSignatureProvided] = $parts;

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, Config::get('jwt.secret_key'), true);
        $base64UrlSignatureCalculated = self::base64UrlEncode($signature);

        if (!hash_equals($base64UrlSignatureCalculated, $base64UrlSignatureProvided)) {
            return null; // Signature ไม่ตรง โดนปลอมแปลง
        }

        $payload = json_decode(self::base64UrlDecode($base64UrlPayload), true);
        return $payload;
    }

    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode(string $data): string
    {
        $padding = strlen($data) % 4;
        if ($padding > 0) {
            $data .= str_repeat('=', 4 - $padding);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
