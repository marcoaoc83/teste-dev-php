<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CarroRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'marca_id' => 'required|integer',
            'modelo' => 'required|string|max:191',
            'ano' => 'required|string|max:4',
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'marca_id' => 'required|integer',
            'modelo' => 'required|string|max:191',
            'ano' => 'required|string|max:4',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = collect($validator->errors())->collapse()->toArray();
        $errors = implode(' | ', $error);
        throw new HttpResponseException(response()->json(
            ['response' => ['status' => false, 'message' => $errors]],
            Response::HTTP_OK));
    }


    public function messages($id = '')
    {
        return [
            'marca_id.required'        =>'Marca é obrigatório',
            'marca_id.integer'           =>'Marca inválido',

            'modelo.required'          =>'Modelo é obrigatório',
            'modelo.max'               =>'Máximo 191 caracteres',

            'ano.required'       =>'Ano é obrigatório',
            'ano.max'            =>'Ano é de no Máximo 4 caracteres',


        ];
    }
}
