<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name' => 'required|max:30',
            'company_phone' => 'required|min:11|max:30',
            'company_author' => 'required|max:30',
            'company_web_site' => 'required|max:100',
        ];
    }
    public function attributes()
    {
        return [
          'company_name' => 'Firma Adı',
          'company_phone' => 'Firma Telefon',
          'company_author' => 'Firma Yetkilisi',
          'company_web_site' => 'Firma Web Sitesi',
        ];
    }
}
