<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task' => ['required']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
