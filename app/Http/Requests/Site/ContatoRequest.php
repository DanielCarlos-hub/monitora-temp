<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required',
            'email' => 'required|email',
            'cep' => 'nullable|string|min:8|max:9',
            'cidade' => 'nullable|string|max:155',
            'estado' => 'nullable|string|max:155',
            'mensagem' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'É necessário preencher um nome',
            'email.required' => 'É necessário preencher um email',
            'email.email' => 'O email precisa ser válido',
            'cep.min' => 'O Cep deve possuir um minimo de 8 caracteres',
            'cep.max' => 'O Cep deve possuir no máximo 9 caracteres.',
            'cidade.max' => 'O campo cidade deve possuir no máximo 155 caracteres',
            'estado.max' => 'O campo estado deve possuir no máximo 155 caracteres',
            'mensagem.required' => 'Esperamos receber uma mensagem no campo de preenchimento de mensagem.',
            'g-recaptcha-response.required' => 'Você precisar verificar o reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Error de Captcha! tente novamente ou contate o administrador do Site.',
        ];
    }
}
