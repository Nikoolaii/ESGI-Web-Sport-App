<?php

namespace App\Service;

class DistanceCalculator
{
    public function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371;

        $latDistance = deg2rad($lat2 - $lat1);
        $lonDistance = deg2rad($lon2 - $lon1);

        $a = sin($latDistance / 2) * sin($latDistance / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDistance / 2) * sin($lonDistance / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        $distance = round($distance, 2);

        return $distance;
    }
}