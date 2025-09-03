<?php

namespace App\Helpers;

/**
 * Format respons API yang disederhanakan dengan status 'success' atau 'error'.
 */
class ResponseFormatter
{
    /**
     * Memberikan respons SUKSES.
     */
    public static function success($data = null, $message = 'success', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Memberikan respons ERROR untuk semua jenis kegagalan.
     */
    public static function error($data = null, $message = 'An error occurred', $code = 400)
    {
        // --- PERBAIKAN DI SINI ---
        // Jika data yang dikirim adalah error validasi dari Laravel,
        // kita akan ubah strukturnya agar sesuai dengan yang diharapkan oleh tes.
        if (is_array($data) && $code === 422) {
             return response()->json([
                'message' => $message,
                'errors' => $data, // Menggunakan kunci 'errors' bukan 'data'
            ], $code);
        }

        // Untuk error lainnya, gunakan format yang sudah ada.
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
