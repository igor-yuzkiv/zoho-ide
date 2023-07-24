<?php

namespace App\Containers\Projects\Enums;

enum ConnectionStatus: int
{
    case DRAFT = 0;

    case ACTIVE = 1;

    case SUSPENDED = 2;
}
