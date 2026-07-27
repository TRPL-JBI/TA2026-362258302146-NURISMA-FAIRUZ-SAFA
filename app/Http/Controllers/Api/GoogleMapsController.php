<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleMapsController extends Controller
{
    public function resolve(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $url = $request->url;

        try {

            /*
            |--------------------------------------------------------------------------
            | Mengikuti redirect dari short link Google Maps
            |--------------------------------------------------------------------------
            */

            $response = Http::withOptions([
                'allow_redirects' => true,
            ])->get($url);

            $finalUrl = $response->effectiveUri();

            /*
            |--------------------------------------------------------------------------
            | Mencari koordinat dari URL tujuan
            |--------------------------------------------------------------------------
            */

            $coordinates = $this->extractCoordinates(
                (string) $finalUrl
            );

            return response()->json([
                'original_url' => $url,
                'final_url' => (string) $finalUrl,
                'coordinates' => $coordinates,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Gagal memproses link Google Maps.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function extractCoordinates($url)
{
    /*
    |--------------------------------------------------------------------------
    | Format 1:
    | https://www.google.com/maps/@-8.3095424,114.2885081,19.83z
    |--------------------------------------------------------------------------
    */

    if (preg_match(
        '/@(-?\d+\.\d+),(-?\d+\.\d+)/',
        $url,
        $matches
    )) {
        return [
            'latitude' => (float) $matches[1],
            'longitude' => (float) $matches[2],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Format 2:
    | https://www.google.com/maps/search/-8.311555,+114.297284
    |--------------------------------------------------------------------------
    */

    if (preg_match(
        '/\/maps\/search\/(-?\d+\.\d+),\+?(-?\d+\.\d+)/',
        $url,
        $matches
    )) {
        return [
            'latitude' => (float) $matches[1],
            'longitude' => (float) $matches[2],
        ];
    }

    return null;
}
}