<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task' => ['required'],
            'is_completed' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
