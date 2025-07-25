<?php

namespace Modules\Process\Enums;

enum StateCandidateEnum: int
{
    case INADMISSIBLE = 3;
    case UNFAIR = 4;
    case ADMITTED = 2;
    case CROSS_OUT_IN_PROCESS = 6;
    case SIGNED_UP = 8;
    case CROSSED_OUT = 7;
    case EXCLUDED = 11;
    case APPEAL = 13;
    case RENUNCIATION = 15;
    case RETREAT = 16;
}
