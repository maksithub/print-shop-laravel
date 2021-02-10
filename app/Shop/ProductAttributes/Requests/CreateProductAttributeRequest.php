<?php

namespace App\Shop\ProductAttributes\Requests;

use App\Shop\Base\BaseFormRequest;

class CreateProductAttributeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => ['required']
        ];
    }
}
