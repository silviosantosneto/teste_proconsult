<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'description' => 'required',
            'files.*'  => [
                'required',
                'image',
                'mimes:jpg,png'
            ]
        ] + ($this->route()->getName() === 'ticket.store' ? $this->ticket() : $this->reply());
    }

    public function ticket(): array
    {
        return [
            'title' => 'required|string|max:255'
        ];
    }

    public function reply(): array
    {
        return [
            'ticket_id' => 'required|integer'
        ];
    }
}
