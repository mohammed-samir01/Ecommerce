<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCouponRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'code'              => 'required|unique:product_coupons',
                    'type'              => 'required',
                    'value'             => 'required',
                    'description'       => 'nullable',
                    'use_times'         => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d',
                    'expire_date'       => 'required_with:start_date|date_format:Y-m-d',
                    'greater_than'      => 'nullable|numeric',
                    'status'            => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'code'              => 'required|unique:product_coupons,code,'.$this->route()->product_coupon->id,
                    'type'              => 'required',
                    'value'             => 'required',
                    'description'       => 'nullable',
                    'use_times'         => 'required|numeric',
                    'start_date'        => 'nullable|date_format:Y-m-d',
                    'expire_date'       => 'required_with:start_date|date_format:Y-m-d',
                    'greater_than'      => 'nullable|numeric',
                    'status'            => 'required',
                ];
            }
            default: break;
        }
    }
}
