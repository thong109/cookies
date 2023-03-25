<?php
/**
 * DataResponse
 * Format of data will return to client
 *
 * Process overview  : DataResponse
 * Created date      : 12/10/2022
 * Created by        : QuyPN <quypn@outfiz.vn>
 *
 * Updated date      :
 * Updated by        :
 * Update content    :
 *
 * @package Common
 * @copyright Copyright (c) outfiz.vn
 * @version 1.0.0
 */

namespace App\Commons;

use App\Commons\ResponseCode;

class DataResponse
{
	public $code;
	public $data;
	public $msgError;
	public $msgNo;
	public $dataError;

    /**
     * Init the value default for properies
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     */
	public function __construct() {
        $this->code 		= ResponseCode::OK;
        $this->data 		= [];
        $this->msgError 	= '';
        $this->msgNo 		= '';
        $this->dataError 	= [];
    }

    /**
     * Set data to return a exception
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     * @param \Exception $e Exception had throewed
     */
    public function SetException($e) {
    	$this->code 		= ResponseCode::SERVICE_ERROR;
    	$this->data 		= [];
        $this->msgError 	= $e->getMessage();
        $this->msgNo 		= 'E500';
        $this->dataError 	= [
            'instance'      => get_class($e),
            'line'          => $e->getLine(),
            'file'          => basename($e->getFile()),
            'code'          => $e->getCode()
        ];
    }

    /**
     * Get data to return to client follow common format
     * Created: 12/10/2022
     * @author QuyPN <quypn@outfiz.vn>
     */
    public function GetData() {
    	return [
    		'code' 		=> $this->code,
    		'data' 		=> $this->data,
            'msgNo' 	=> $this->msgNo,
    		'errors' 	=> [
    			'message'		=> $this->msgError,
    			'message_no'	=> $this->msgNo,
    			'data'			=> $this->dataError,
    		]
    	];
    }
}
