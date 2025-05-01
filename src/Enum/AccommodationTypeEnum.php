<?php

namespace App\Enum;

enum AccommodationTypeEnum: string
{
    case  Hotel = 'Hotel';

    case  PRIVATE_RENTAL = 'Airbnb / private rental';

    case  GUESTHOUSE = 'Guesthouse';

    case  CAMPSITE = 'Campsite';

    case  FRIENDS_OR_FAMILY = 'Friends/family';
    case  PRIVATE_PROPERTY = 'private property';

    case  Other = 'Other';

}
