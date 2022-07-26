<?php

namespace App\Http\Requests;

use App\Rules\ExistingKeys;
use Illuminate\Foundation\Http\FormRequest;

class PageTextUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('page')->company_id === auth()->user()->company_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pageTexts' => [
                'array',
                new ExistingKeys('page_texts', $this->route('page')),
            ],
        ];
    }
}
