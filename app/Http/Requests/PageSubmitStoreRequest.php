<?php

namespace App\Http\Requests;

use App\Rules\ExistingKeys;
use Illuminate\Foundation\Http\FormRequest;

class PageSubmitStoreRequest extends FormRequest
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
        return [
            'formData' => [
                'array',
                new ExistingKeys('page_keys', $this->route('page')),
            ],
        ];
    }
}
