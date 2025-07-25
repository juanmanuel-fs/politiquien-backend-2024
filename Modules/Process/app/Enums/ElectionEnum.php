<?php
namespace Modules\Process\Enums;

enum ElectionEnum: int {
    case PRESIDENTIAL = 1;
    case CONGRESSMAN = 2;
    case ANDEAN_PARLIAMENT = 3;
    case REGIONAL = 4;
    case PROVINCIAL_MUNICIPAL = 5;
    case DISTRICT_MUNICIPAL = 6;
}
