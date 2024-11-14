<?php

namespace App\Http\Controllers;

use App\Services\RedisService;
use Illuminate\Http\Request;

class RedisController extends Controller
{
    protected RedisService $redisService;

    /**
     * Inject RedisService via constructor.
     *
     * @param RedisService $redisService
     */
    public function __construct(RedisService $redisService)
    {
        $this->redisService = $redisService;
    }

    /**
     * Menyimpan data di Redis dengan TTL opsional.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        $ttl = $request->input('ttl');

        $success = $this->redisService->set($key, $value, $ttl);

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Data stored successfully' : 'Failed to store data'
        ]);
    }

    /**
     * Mengambil data dari Redis berdasarkan key.
     *
     * @param string $key
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($key)
    {
        $value = $this->redisService->get($key);

        return response()->json([
            'key' => $key,
            'value' => $value
        ]);
    }

    /**
     * Menghapus data dari Redis berdasarkan key.
     *
     * @param string $key
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($key)
    {
        $success = $this->redisService->delete($key);

        return response()->json([
            'success' => $success,
            'message' => $success ? 'Data deleted successfully' : 'Failed to delete data'
        ]);
    }

    /**
     * Memeriksa apakah key ada di Redis.
     *
     * @param string $key
     * @return \Illuminate\Http\JsonResponse
     */
    public function exists($key)
    {
        $exists = $this->redisService->exists($key);

        return response()->json([
            'key' => $key,
            'exists' => $exists
        ]);
    }

    /**
     * Menambah nilai numerik pada key.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function increment(Request $request)
    {
        $key = $request->input('key');
        $amount = $request->input('amount', 1);

        $newValue = $this->redisService->increment($key, $amount);

        return response()->json([
            'key' => $key,
            'value' => $newValue
        ]);
    }

    /**
     * Mengurangi nilai numerik pada key.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decrement(Request $request)
    {
        $key = $request->input('key');
        $amount = $request->input('amount', 1);

        $newValue = $this->redisService->decrement($key, $amount);

        return response()->json([
            'key' => $key,
            'value' => $newValue
        ]);
    }

    /**
     * Mengambil semua key-value pairs yang cocok dengan pola.
     *
     * @param string $pattern
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll($pattern = '*')
    {
        $data = $this->redisService->getAll($pattern);

        return response()->json($data);
    }
}
