<?php

namespace App\Http\Requests;

use App\Rules\OrderStringRule;
use Illuminate\Foundation\Http\FormRequest;

class MovieOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'order' => ['nullable', 'max:12', new OrderStringRule()],
        ];
    }
}
