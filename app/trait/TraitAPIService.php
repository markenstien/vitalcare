<?php

/**
 * 
 */
trait TraitAPIService
{
    public $t_errors = '';

    public function apiGet($url , $data = [])
    {
        $response = api_call('GET' , $url , $data);

        if(!$response){
            $this->t_errors = "unable to process api call";
        }

        return $this->jsonDecoder($response);
    }

    public function jsonDecoder($data)
    {
        $retVal = '';
        if( ! is_array($data) ){
            $retVal = json_decode($data);
        }

        return $retVal;
    }

    public function jsonEncoder()
    {

    }
}
