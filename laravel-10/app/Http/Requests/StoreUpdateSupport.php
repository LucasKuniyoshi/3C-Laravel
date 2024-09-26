<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        //unique:supports => unico na tabela support
        //os dois abaixo sao definições de condições de variáveis só q com jeitos diferentes, mas são iguais.
        $rules = [
            'subject' => 'required|min:3|max:255|unique:supports',
            'body' => [
                'required',
                'min:3',
                'max:100000',
            ],
        ];

        //PERMITE ALTERAR UM CAMPO SEM PRECISAR ALTERAR O OUTRO
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules['subject'] = [
                'required', // 'nullable',
                'min:3',
                'max:255',
                // "unique:supports,subject,{$this->id},id", //QUANDO O USUÁRIO COM O MESMO ID DONO DESSE CAMPO ALTERAR SOMENTE UM CAMPO, ELE IRÁ PERMITIR E N MANDARÁ A MSG Q O CAMPO JÁ EXISTE
                Rule::unique('supports')->ignore($this->support ?? $this->id), //MESMA COISA Q O DE CIMA; É UNICA, MAS IGNORA QUANDO O ID É O MESMO.
            ];
        }

        return $rules;
    }
}
