<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuildingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:256',
            'architect_id' => 'required',
            'style_id' => 'required',
            'description' => 'nullable',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',     
        ];
    }

    public function messages(): array
{
 return [
    'required' => 'Поле ":attribute" обязательно',
    'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
    'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
    'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
    'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
    'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
    'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
    ];
}
public function attributes(): array
{
    return [
    'name' => 'Имя',
    'architect_id' => 'Архитектор',
    'style_id' => 'Стиль',
    'description' => 'Описание',
    'year' => 'Год',
    'image' => 'Картинка',
    'display' => 'Построено',
    ];
}
}
