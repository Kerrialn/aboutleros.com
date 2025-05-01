<?php

namespace App\Enum;

enum ContentTypeEnum: string
{
    case EVENTS = 'events';
    case CUISINE_AND_NIGHTLIFE = 'cuisine-nightlife';
    case SHOPPING_AND_SUPPLIES = 'shopping-supplies';
    case BEACHES_AND_NATURE = 'beaches-nature';
    case MARINE_AND_YACHTING = 'marine-yachting';
    case CULTURE_AND_HERITAGE = 'culture-heritage';
    case TRAVEL_AND_TRANSPORT = 'travel-transport';
    case ACCOMMODATION = 'accommodation';
    case INFORMATION = 'information';
}
