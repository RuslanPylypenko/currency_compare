<?php

declare(strict_types=1);

namespace App\Model;

enum Currency: string
{
    case USD = "USD";
    case EUR = "EUR";
    case UAH = "UAH";

    /**
     * @return Currency[]
     */
    public static function currencies(): array
    {
        return [self::EUR, self::USD];
    }
}
