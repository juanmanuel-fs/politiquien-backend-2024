<?php

namespace Modules\Politician\Enums;

enum TypePropertyEnum: string
{
    case SHARE = 'Acciones';
    case PARTICIPATION = 'Participaciones';
    case OTHER = 'Otros';
}
