<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class JsonManipulationController extends Controller
{
    public function manipulateJson()
    {
        $json1Response = Http::get('https://pastebin.com/raw/18HKxBeM', ['password' => 'jfcX8q3ezy']);
        $json2Response = Http::get('https://pastebin.com/raw/2fBXAWqh', ['password' => 'tQZRQ9UJH8']);
        $json3Response = Http::get('https://pastebin.com/raw/P7xNa6Ji', ['password' => 'GDYzTGEVjR']);
        $json4Response = Http::get('https://pastebin.com/raw/hifJjX4i', ['password' => 'G2ghZ56h6C']);
        dd(json_decode($json1Response->body(), true));

        if ($json1Response->successful() && $json2Response->successful() && $json3Response->successful() && $json4Response->successful()) {
            $json1Data = json_decode($json1Response->body(), true);
            $json2Data = json_decode($json2Response->body(), true);
            $json3Data = json_decode($json3Response->body(), true);
            $json4Data = json_decode($json4Response->body(), true);

            // Create a map of ahass code to ahass data for quick lookup
            $ahassMap = [];
            foreach ($json2Data['data'] as $ahass) {
                $ahassMap[$ahass['code']] = $ahass;
            }

            // Create a new structure for the manipulated JSON
            $manipulatedJson = [
                'status' => 1,
                'message' => 'Data Successfully Retrieved.',
                'data' => [],
            ];

            foreach ($json1Data['data'] as $item) {
                $booking = $item['booking'];
                $ahassCode = $booking['workshop']['code'];

                // Retrieve AHASS data from the map
                $ahass = $ahassMap[$ahassCode] ?? null;

                if ($ahass) {
                    $manipulatedJson['data'][] = [
                        'name' => $item['name'],
                        'email' => $item['email'],
                        'booking_number' => $booking['booking_number'],
                        'book_date' => $booking['book_date'],
                        'ahass_code' => $ahassCode,
                        'ahass_name' => $ahass['name'],
                        'ahass_address' => $ahass['address'] ?? '',
                        'ahass_contact' => $ahass['phone_number'] ?? '',
                        'ahass_distance' => $ahass['distance'] ?? 0,
                        'motorcycle_ut_code' => $booking['motorcycle']['ut_code'],
                        'motorcycle' => $booking['motorcycle']['name'],
                    ];
                }
            }

            // Sort the data by 'ahass_distance'
            usort($manipulatedJson['data'], function ($a, $b) {
                return $a['ahass_distance'] <=> $b['ahass_distance'];
            });

            return response()->json($manipulatedJson);
        } else {
            return response()->json([
                'error' => 'Failed to fetch JSON data',
            ], 500);
        }
    }
}

