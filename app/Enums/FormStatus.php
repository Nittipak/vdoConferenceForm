<?php

namespace App\Enums;

enum FormStatus: int
{
    case INPROCESS = 1;
    case DONE = 2;
    case CANCELLED = 3;

    public function color(): string
    {
        return match ($this) {
            FormStatus::INPROCESS => 'primary',
            FormStatus::DONE => 'success',
            FormStatus::CANCELLED => 'danger',
        };
    }
}
