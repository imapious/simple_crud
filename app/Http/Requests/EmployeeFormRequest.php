<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeFormRequest extends FormRequest
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
        $now = Carbon::now();
        $before = $now->subYears(18)->format('Y-m-d');

        return [
            'full_name' => 'required|max:255',
            'birthdate' => 'required|date|before:' . $before,
            'department' => 'required'
        ];
    }

    public function messages()
	{
		return [
			'birthdate.before' => "Minimum Age Requirment is 18",
		];
	}
}
