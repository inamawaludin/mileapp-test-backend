<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateShipmentRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
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
        } else {
            return [
                'customer_name' => 'sometimes|required|string|max:255',
                'customer_code' => 'sometimes|required|string|max:255',
                'transaction_amount' => 'sometimes|required|numeric',
                'transaction_discount' => 'sometimes|numeric',
                'transaction_payment_type' => 'sometimes|required|string|max:255',
                'transaction_state' => 'sometimes|required|string|max:255',
                'transaction_code' => 'sometimes|required|string|max:255',
                'transaction_order' => 'sometimes|required|integer',
                'location_id' => 'sometimes|required',
                'organization_id' => 'sometimes|required|integer',
                'transaction_payment_type_name' => 'sometimes|string|max:255',
                'transaction_cash_amount' => 'sometimes|numeric',
                'transaction_cash_change' => 'sometimes|numeric',
                'customer_attribute' => 'sometimes|array',
                'connote' => 'sometimes|array',
                'connote_id' => 'sometimes|uuid',
                'origin_data' => 'sometimes|array',
                'destination_data' => 'sometimes|array',
                'koli_data' => 'sometimes|array',
                'custom_field' => 'sometimes|array',
                'currentLocation' => 'sometimes|array',
            ];
        }
    }
}
