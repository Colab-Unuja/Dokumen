<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use Exception;

class RedisService
{
    /**
     * Menyimpan data ke dalam Redis dengan TTL opsional.
     */
    public function set(string $key, mixed $data, ?int $ttl = null): bool
    {
        return $this->execute(function () use ($key, $data, $ttl) {
            $data = $this->serialize($data);
            Redis::set($key, $data);
            if ($ttl) {
                Redis::expire($key, $ttl);
            }
            return true;
        });
    }

    /**
     * Mengambil data dari Redis berdasarkan key.
     */
    public function get(string $key): mixed
    {
        return $this->execute(function () use ($key) {
            $data = Redis::get($key);
            if (!$data) {
                Log::warning("Data tidak ditemukan di Redis untuk key: {$key}");
            }
            return $data ? $this->deserialize($data) : null;
        });
    }

    /**
     * Menghapus data dari Redis berdasarkan key.
     */
    public function delete(string $key): bool
    {
        return $this->execute(fn() => Redis::del($key) > 0);
    }

    /**
     * Memeriksa apakah data dengan key tertentu ada di Redis.
     */
    public function exists(string $key): bool
    {
        return $this->execute(fn() => Redis::exists($key) > 0);
    }

    /**
     * Menambah nilai numerik pada key Redis.
     */
    public function increment(string $key, int $amount = 1): ?int
    {
        return $this->execute(fn() => Redis::incrby($key, $amount));
    }

    /**
     * Mengurangi nilai numerik pada key Redis.
     */
    public function decrement(string $key, int $amount = 1): ?int
    {
        return $this->execute(fn() => Redis::decrby($key, $amount));
    }

    /**
     * Mengambil semua key-value pairs yang cocok dengan pola tertentu.
     */
    public function getAll(string $pattern = '*'): array
    {
        return $this->execute(function () use ($pattern) {
            $keys = Redis::keys($pattern);
            $data = [];
            foreach ($keys as $key) {
                $data[$key] = $this->deserialize(Redis::get($key));
            }
            return $data;
        }, []);
    }

    /**
     * Wrapper untuk penanganan error umum.
     */
    private function execute(callable $callback, mixed $default = null): mixed
    {
        try {
            return $callback();
        } catch (Exception $e) {
            Log::error("Redis operation failed: {$e->getMessage()}", ['exception' => $e]);
            return $default;
        }
    }

    /**
     * Serialisasi data sebelum disimpan.
     */
    private function serialize(mixed $data): string
    {
        return is_array($data) || is_object($data) ? json_encode($data) : (string) $data;
    }

    /**
     * Deserialisasi data setelah diambil.
     */
    private function deserialize(?string $data): mixed
    {
        if (is_null($data)) {
            return null;
        }

        $decoded = json_decode($data, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : $data;
    }
}
