<?php

namespace App\Helpers;

/**
 * Format respons API yang terstandardisasi (mengikuti prinsip JSend).
 */
class ResponseFormatter
{
    /**
     * Memberikan respons SUKSES.
     *
     * @param mixed $data Data yang akan dikembalikan.
     * @param string $message Pesan sukses.
     * @param int $code Kode status HTTP (default: 200 OK).
     * @return \Illuminate\Http\JsonResponse
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
     * Memberikan respons ERROR karena masalah di sisi server.
     *
     * @param string $message Pesan error.
     * @param int $code Kode status HTTP (default: 500 Internal Server Error).
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = 'An error occurred', $code = 500)
    {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'data' => null,
        ], $code);
    }

    /**
     * Memberikan respons GAGAL karena data dari klien tidak valid.
     * Sangat berguna untuk menangani error validasi.
     *
     * @param mixed $data Berisi detail error validasi.
     * @param string $message Pesan utama kegagalan.
     * @param int $code Kode status HTTP (default: 422 Unprocessable Entity).
     * @return \Illuminate\Http\JsonResponse
     */
    public static function fail($data = null, $message = 'Invalid data provided', $code = 422)
    {
        return response()->json([
            'status' => 'fail',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}