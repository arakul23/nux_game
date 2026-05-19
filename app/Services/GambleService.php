<?php

declare(strict_types=1);

namespace App\Services;

readonly class GambleService
{
    private const string STATUS_WIN = 'win';

    private const string STATUS_LOSE = 'lose';

    public function calculateResult(): array
    {
        $number = rand(1, 1000);
        $even = $this->isEven($number);

        return [
            'number' => $number,
            'status' => $even ? self::STATUS_WIN : self::STATUS_LOSE,
            'amount' => $even ? $this->calculateAmount($number) : 0

        ];
    }

    private function isEven(int $number): bool
    {
        return $number % 2 === 0;
    }

    private function calculateAmount(int $number): float
    {
        return round(match (true) {
            $number > 900 => ($number * 70) / 100,
            $number > 600 => ($number * 50) / 100,
            $number > 300 => ($number * 30) / 100,
            default => ($number * 10) / 100,
        }, 2);
    }
}
