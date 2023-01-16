<?php

namespace App\Services\Bank\BankIdentifier;

enum BankIdentifier: string
{
    case PASARGAD = "502229";
    case PARSIAN = "622106";
    public function bank(): string
    {
        return match ($this){
            self::PASARGAD => "بانک پاسارگاد",
            self::PARSIAN => "بانک پارسیان"
        };
    }

    public function items(): array
    {
        return array_map(fn ($item) => $item->value, self::cases());
    }
}
