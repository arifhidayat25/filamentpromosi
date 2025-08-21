<?php

namespace App\Helpers;

/**
 * Format respons API yang disederhanakan dengan status 'success' atau 'error'.
 */
class ResponseFormatter
{
    /**
     * Memberikan respons SUKSES.
     *
     * @param mixed $data Data yang akan dikembalikan.
     * @param string $message Pesan sukses.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, $message = 'success')
    {
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    /**
     * Memberikan respons ERROR untuk semua jenis kegagalan.
     *
     * @param mixed $data Detail error (opsional, misal: error validasi).
     * @param string $message Pesan error utama.
     * @param int $code Kode status HTTP (default: 400 Bad Request).
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($data = null, $message = 'An error occurred', $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}