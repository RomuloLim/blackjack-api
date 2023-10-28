<?php

namespace App\Enums;

enum WalletStatus: int
{
    case Inactive = 0;
    case Primay = 1;
    case Secondary = 2;

}
