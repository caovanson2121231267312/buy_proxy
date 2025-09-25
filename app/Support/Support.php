<?php

namespace App\Support;

use Illuminate\Support\Str;

class VietQr
{
    /**
     * Build VietQR image URL (no API key required).
     *
     * @param  string $bankId       // ví dụ: "mbbank", "vietcombank", "acb", "techcombank", "vietinbank", ...
     * @param  string $accountNo    // số tài khoản
     * @param  string|null $accountName // KHÔNG dấu, VIẾT HOA (docs yêu cầu)
     * @param  int|null $amount     // số tiền (VND)
     * @param  string|null $addInfo // nội dung chuyển khoản (ghi chú)
     * @param  string $template     // compact | compact2 | qr_only | print
     */
    public static function quickLink(
        string $bankId,
        string $accountNo,
        ?string $accountName = null,
        ?int $amount = null,
        ?string $addInfo = null,
        string $template = 'compact2',
        string $ext = 'png'
    ): string {
        // Chuẩn hóa tên tài khoản: bỏ dấu + UPPER
        if ($accountName) {
            $accountName = Str::upper(Str::of(Str::ascii($accountName))->replace(['  '], ' '));
        }

        $base = sprintf('https://img.vietqr.io/image/%s-%s-%s.%s', strtolower($bankId), $accountNo, $template, $ext);

        $qs = array_filter([
            'amount'      => $amount,
            'addInfo'     => $addInfo,
            'accountName' => $accountName,
        ], fn($v) => $v !== null && $v !== '');

        return $base . (empty($qs) ? '' : ('?' . http_build_query($qs)));
    }
}
