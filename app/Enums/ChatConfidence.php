<?php

namespace App\Enums;

enum ChatConfidence: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
}
