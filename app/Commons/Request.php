<?php
/**
 * Request
 * Setting some config common for check validate data
 *
 * Process overview  : Request
 * Created date      : 12/10/2022
 * Created by        : QuyPN <quypn@outfiz.vn>
 *
 * Updated date      :
 * Updated by        :
 * Update content    :
 *
 * @package System
 * @copyright Copyright (c) outfiz.vn
 * @version 1.0.0
 */
namespace App\Commons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

abstract class Request extends FormRequest
{
    /**
     * Get error validate and return follow format json
     * Created: 2021/05/26
     * @param  Validator $validator  Validation information
     * @return DataResponse List Item error
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new DataResponse();
        $response->code = ResponseCode::INVALID_DATA;
        $response->msgError = 'Data invalid';
        $response->msgNo = 'E' . ResponseCode::INVALID_DATA;
        $response->dataError = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json($response->GetData(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * custom messages validation
     * @return array
     */
    public function messages(){
        return [
            'required'              => 'E001',
            'max'                   => 'E005',
            'mimes'                 => 'E021'
        ];
    }

    /**
     * Get default value if not have in request of client.
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param  Array $dataDeffautls Array have default values
     * @param  Array $data Dataa need to set default values
     * @return Array Data after have default values
     */
    public function setDeffaultValues($dataDeffautls, $data)
    {
        try {
            foreach($dataDeffautls as $key => $value) {
                if(!isset($data[$key]) || $data[$key] == null) {
                    $data[$key] = $value;
                }
            }
            foreach($data as $key => $value) {
                if(isset($data[$key]) && gettype($data[$key]) == 'string') {
                    $data[$key] = Helper::SqlEscString($data[$key]);
                }
            }
            return $data;
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance();
    }
}
