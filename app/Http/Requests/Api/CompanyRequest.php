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
            'status_id' => 'required',
            'customer_type_id' => 'required',
            'size_code_id' => 'required',
        ];
    }
    public function attributes()
    {
        return [
          'company_name' => 'Firma Adı',
          'company_address' => 'Firma Adresi',
          'company_main_country' => 'Firma Ana Ülke',
          'company_country' => 'Firma Ülke',
          'company_city' => 'Firma Şehir',
          'company_district' => 'Firma Mahalle',
          'company_phone' => 'Firma Telefon',
          'company_author' => 'Firma Yetkilisi',
          'company_web_site' => 'Firma Web Sitesi',
          'tax_number' => 'Firma Vergi Numarası',
          'sector' => 'Firma Sektör',
          'is_active' => 'Durum',
          'user_id' => 'Firma Kayıt Sahibi',
          'status_id' => 'Firma Durumu',
          'customer_type_id' => 'Firma Müşteri Tipi',
          'size_code_id' => 'Firma Boyut Kodu',
        ];
    }
}
