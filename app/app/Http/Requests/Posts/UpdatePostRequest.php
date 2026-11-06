<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    
    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:posts,id'],
        ];
    }
}
