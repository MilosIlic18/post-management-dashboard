<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    
    protected function prepareForValidation(): void
    {
        $data = $this->all();

        if (isset($data['title'])) {
            $this->replace([$data]);
        }
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required', 'string', 'max:255'],
        ];
    }
}
