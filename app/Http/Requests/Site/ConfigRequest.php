<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'site.nome' => 'required',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'site.descricao' => 'nullable',
            'site.facebook' => 'nullable|url',
            'site.instagram' => 'nullable|url',
            'site.twitter' => 'nullable|url',
            'site.pinterest' => 'nullable|url',
            'site.linkedin' => 'nullable|url',
            'site.endereco' => 'required',
            'site.telefone' => 'required_without:site.celular',
            'site.email' => 'required|email',
            'site.whatsapp' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'site.nome.required' => 'É necessário preencher o nome do Site.',
            'logo.image' => 'O campo imagem logo precisa ser uma imagem válida.',
            'favicon.image' => 'O campo imagem favicon precisa ser uma imagem válida.',
            'site.facebook.url' => 'O campo Facebook precisa ser uma URL.',
            'site.instagram.url' => 'O campo Instagram precisa ser uma URL.',
            'site.twitter.url' => 'O campo Twitter precisa ser uma URL.',
            'site.pinterest.url' => 'O campo Pinterest precisa ser uma URL.',
            'site.linkedin.url' => 'O campo Linkedin precisa ser uma URL.',
            'site.endereco.required' => 'É necessário preencher o campo endereço.',
            'site.telefone.required_without' => 'É preciso preencher ao menos 1 número de telefone.',
            'site.email.required' => 'É necessário preencher um email para contato do site.',
            'site.email.email' => 'O campo e-mail precisar ser um e-mail válido.',
        ];
    }
}
