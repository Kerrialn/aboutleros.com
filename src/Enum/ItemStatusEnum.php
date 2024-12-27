<?php

namespace App\Enum;

enum ItemStatusEnum: int
{
    case PUBLISHED = 1;
    case PENDING = 2;
    case REJECTED = 3;
    case  REMOVED = 4;

}
