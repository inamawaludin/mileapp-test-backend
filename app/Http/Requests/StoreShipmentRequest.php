<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreShipmentRequest extends FormRequest
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

    protected $stopOnFirstFailure = false;

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
            ], 422));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_code' => 'required|string|max:255',
            'transaction_amount' => 'required|numeric',
            'transaction_discount' => 'numeric',
            'transaction_payment_type' => 'required|string|max:255',
            'transaction_state' => 'required|string|max:255',
            'transaction_code' => 'required|string|max:255',
            'transaction_order' => 'required|integer',
            'location_id' => 'required',
            'organization_id' => 'required|integer',
            'transaction_payment_type_name' => 'string|max:255',
            'transaction_cash_amount' => 'numeric',
            'transaction_cash_change' => 'numeric',
            'customer_attribute' => 'array',
            'connote' => 'array',
            'connote_id' => 'uuid',
            'origin_data' => 'array',
            'destination_data' => 'array',
            'koli_data' => 'array',
            'custom_field' => 'array',
            'currentLocation' => 'array',
        ];
    }
}
