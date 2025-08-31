<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:250',
            //'cpf_cnpj' => ['required', new CpfOuCnpj],
            'cidade' => 'max:200',
            'nome_contato' => 'max:250'
            //'email' => ['max:255', Rule::unique('clientes')->ignore($cliente ? $cliente->id : null)],
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 250 caracteres.',
            'cidade.max' => 'O campo :attribute não pode ultrapassar 200 caracteres.',
            'nome_contato.max' => 'O campo :attribute não pode ultrapassar 250 caracteres.'
            //'email.max' => 'O campo email não pode ultrapassar 255 caracteres.',
            //'email.email' => 'O campo email deve ser do tipo Email.',
        ];
    }
}
