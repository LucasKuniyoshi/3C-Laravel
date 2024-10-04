<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateExplorer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'latitude' => 'required|min:3|max:255',
            'longitude' => [
                'required',
                'min:3',
                'max:10000'
            ]
        ];
        if($this->method() === 'PUT'){
            $rules['latitude'] = [
                'required',
                'min:3',
                'max:255',
                // "unique:supports,subject,{$this->id},id",
                Rule::unique('explorers')->ignore($this->id), //aceita quando o campo é o mesmo que fique igual (no edit), se for o mesmo usuário
            ];
            $rules['longitude'] = [
                'required',
                'min:3',
                'max:255',
                // "unique:supports,subject,{$this->id},id",
                Rule::unique('explorers')->ignore($this->id), //aceita quando o campo é o mesmo que fique igual (no edit), se for o mesmo usuário
            ];
        }

        return $rules;
    }
}
