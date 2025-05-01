<?php

namespace App\Enum;

enum TravelMotivationEnum: string
{
    case  LEISURE = 'Leisure/Holiday';
    case  BUSINESS = 'business';
    case   CULTURAL_OR_HISTORICAL_INTERESTS = 'Cultural or historical interests';
    case  FRIENDS_OR_FAMILY = 'Friends/family';
    case  PUBLIC_EVENT = 'Public event';
    case  PRIVATE_EVENT = 'Private event';
    case  SAILING_OR_YACHTING = 'Sailing/yachting';
    case  NATURE_OR_OUTDOOR_ACTIVITIES = 'Nature and outdoor activities';
    case  Other = 'Other (please specify)';
}
