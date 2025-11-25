<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RectorApiClient
{
    /**
     * Fetch rector data from external API and map to expected keys.
     * Returns array|null with keys: name, position, academic_title, image, message, is_active
     */
    public function fetch(): ?array
    {
        $url = config('services.rector.url');
        $token = config('services.rector.token');

        if (empty($url)) {
            return null;
        }

        try {
            $client = Http::withOptions(['verify' => true])->timeout(8);
            if (!empty($token)) {
                $client = $client->withHeaders(['Authorization' => 'Bearer ' . $token]);
            }

            $resp = $client->get($url);
            if (!$resp->successful()) {
                Log::warning('RectorApiClient non-success response', ['status' => $resp->status(), 'url' => $url]);
                return null;
            }

            $data = $resp->json();
            if (empty($data) || !is_array($data)) {
                return null;
            }

            // map common fields with fallbacks
            $mapped = [
                'name' => $data['name'] ?? $data['title'] ?? null,
                'position' => $data['position'] ?? $data['cargo'] ?? null,
                'academic_title' => $data['academic_title'] ?? $data['titulo'] ?? null,
                'image' => $data['image'] ?? $data['image_url'] ?? $data['photo'] ?? null,
                'message' => $data['message'] ?? $data['mensaje'] ?? $data['content'] ?? null,
                'is_active' => $data['is_active'] ?? $data['active'] ?? true,
            ];

            return $mapped;
        } catch (\Exception $e) {
            Log::error('RectorApiClient exception: ' . $e->getMessage(), ['url' => $url]);
            return null;
        }
    }
}
