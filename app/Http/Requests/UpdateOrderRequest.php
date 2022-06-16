<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_id" => "required|integer",
            "customerName" => "required|string",
            "customerLastName" => "required|string",
            "customerEmail" => "required|string",
            "customerPhone" => "required|string",
            "customerAddress" => "required|string",
            "comment" => "nullable",
            "total" => "required|integer",
        ];
    }
}
