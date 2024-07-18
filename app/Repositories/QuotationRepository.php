<?php

namespace App\Repositories;

use App\Models\Quotation;
use App\Repositories\Interfaces\QuotationRepositoryInterface;
use Carbon\Carbon;

class QuotationRepository implements QuotationRepositoryInterface
{
    private const FIXED_RATE = 3;

    public function index(array $requestParams): Array
    {
        $ages = explode(",", $requestParams['age']);

        $tripLength = Carbon::parse($requestParams['start_date'])->diffInDays(Carbon::parse($requestParams['end_date'])) + 1;

        $total = 0;
        foreach ($ages as $age) {
            if (!is_numeric($age)) {
                return [
                    'status' => 'failed',
                    'message' => 'One or more age inputs are wrong. Please check the data you send in the request.',
                ];
            }
            $total += self::FIXED_RATE * $this->ageLoad($age) * $tripLength;
        }

        $quotation = Quotation::create([
            'age' => $requestParams['age'],
            'currency_id' => $requestParams['currency_id'],
            'total' => $total,
            'start_date' => $requestParams['start_date'],
            'end_date' => $requestParams['end_date'],
        ]);

        return [
            'status' => 'success',
            'total' => $total,
            'currency_id' => $requestParams['currency_id'],
            'quotation_id' => $quotation->id,
        ];
    }

    private function ageLoad(int $age): float
    {
        switch ($age) {
            case ($age >= 18 && $age <= 30):
                return 0.6;
            case ($age >= 31 && $age <= 40):
                return 0.7;
            case ($age >= 41 && $age <= 50):
                return 0.8;
            case ($age >= 51 && $age <= 60):
                return 0.9;
            case ($age >= 61 && $age <= 70):
                return 1;
        }
    }
}
