<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'name'      => 'required|min:3|max:100',
            'company'   => 'nullable|min:3',
            'birthday'  => 'nullable',
            'image'     => 'nullable|string'
        ];

        $rules += $this->updateOrCreate();

        return $rules;
    }

    protected function updateOrCreate()
    {
        if ($this->getMethod() == 'POST') {
           return [
                'phone'         => 'required|unique:notebooks,phone',
                'email'         => 'required|email|max:255|unique:notebooks,email',
            ];
        } else {
            return [
                'phone'         => 'required|unique:notebooks,phone,' . $this->notebook->id,
                'email'         => 'required|email|max:255|unique:notebooks,email,' . $this->notebook->id,
            ];
        }
    }
}
