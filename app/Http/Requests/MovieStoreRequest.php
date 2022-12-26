<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class MovieStoreRequest extends FormRequest
{
    /**
     * Custom validator
     */
    public function __construct()
    {
        parent::__construct();

        Validator::extend('valid_actors', function ($attribute, $value) {
            $rules = ['actor_id' => ['exists:App\Models\Actor,id']];

            foreach ($value as $actorId) {
                $data = ['actor_id' => $actorId];
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    return false;
                }
            }
            return true;
        });
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'genre_id' => ['required', 'exists:App\Models\Genre,id'],
            'actors' => ['required', 'valid_actors'],
        ];
    }
}
