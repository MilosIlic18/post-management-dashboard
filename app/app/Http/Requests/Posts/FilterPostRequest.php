<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class FilterPostRequest extends FormRequest
{

    public function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->input('status'),
            'sort'   => $this->input('sort', 'asc'),
            'limit'  => $this->input('limit', 10),
        ]);
    }

    public function rules(): array
    {
        
        return [
            'status' => ['nullable', 'in:complete,pending'],
            'sort'   => ['required', 'in:asc,desc'],
            'limit'  => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }
}
