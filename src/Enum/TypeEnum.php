<?php

namespace App\Enum;

enum TypeEnum: string
{
    case STANDARD = 'for_profit';
    case NON_PROFIT = 'non_profit';
    case CHARITY = 'charity';
    case GOVERNMENT = 'government';
    case MUNICIPAL = 'municipal';
    case EDUCATIONAL = 'educational';
    case CULTURAL = 'cultural';
    case RELIGIOUS = 'religious';
    case COOPERATIVE = 'cooperative';
    case SOCIAL_ENTERPRISE = 'social_enterprise';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::STANDARD => 'Standard',
            self::CHARITY => 'Charity',
            self::GOVERNMENT => 'Government',
            self::MUNICIPAL => 'Municipal',
            self::EDUCATIONAL => 'Educational',
            self::CULTURAL => 'Cultural',
            self::RELIGIOUS => 'Religious',
            self::OTHER => 'Other',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
