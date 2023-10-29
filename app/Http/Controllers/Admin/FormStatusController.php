<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FormStatus;
use App\Http\Controllers\Controller;
use App\Models\Form;

class FormStatusController extends Controller
{
    public function getStatusWithCount()
    {
        $cases = FormStatus::cases();

        return collect($cases)->map(function ($status) {
            return [
                'name' => $status->name,
                'value' => $status->value,
                'count' => Form::where('status', $status->value)->count(),
                'color' => FormStatus::from($status->value)->color(),
            ];
        });
    }
}