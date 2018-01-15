<?php

class RestApi
{

    private $method;
    private $respondType; // 1 = array | 0 = object
    private $url;

    function __construct($vars = [])
    {
         $this->method = ( isset( $vars['method']) && $vars['method'] != "" ) ?   $vars['method'] : 'GET';
         $this->respondType = ( isset( $vars['respondType'] ) && $vars['respondType'] != "" ) ?   $vars['respondType'] : 1;

           $this->url = ( isset( $vars['url'] ) && $vars['url'] != "" ) ? $vars['url'] : 'http://register-monuments.cobweb.biz/restapi';
           //$this->url = ( isset( $vars['url'] ) && $vars['url'] != "" ) ? $vars['url'] : 'http://172.16.100.10/register.sofiahistorymuseum.bg/web/public/restapi';
           //$this->url = ( isset( $vars['url'] ) && $vars['url'] != "" ) ? $vars['url'] : 'http://172.16.100.5/projects/web/register.sofiahistorymuseum.bg/web/public/restapi';

    }

    function request( $data = array(), $options = array()){


        if( $this->method == 'POST' ){
            $result = $this->curl_post( $this->url, $data, $options = array() );
        } else {
            $result = $this->curl_get( $this->url, $data, $options = array() );
        }

        return $result;

    }


    /**
* Send a POST requst using cURL
* @param string $url to request
* @param array $data values to send
* @param array $options for cURL
* @return string
*/

    function curl_post( $url, $data, $options = array() )
    {

        $defaults = array(
            CURLOPT_POST            => 1,
            CURLOPT_HEADER          => 0,
            CURLOPT_URL             => $url,
            CURLOPT_FRESH_CONNECT   => 1,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_FORBID_REUSE    => 1,
            CURLOPT_TIMEOUT         => 4,
            CURLOPT_POSTFIELDS      => http_build_query( $data )
        );

        $ch = curl_init();
        curl_setopt_array( $ch, ( $options + $defaults ) );

        if( !$result = curl_exec( $ch ) )
        {
            trigger_error(curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }


    /**
    * Send a GET requst using cURL
    * @param string $url to request
    * @param array $data values to send
    * @param array $options for cURL
    * @return string
    */
    function curl_get( $url, $data, $options = array() )
    {
        $result = array();

        $defaults = array(
            CURLOPT_URL             => $url . ( strpos( $url, '?' ) === FALSE ? '?' : '' ) . http_build_query( $data ),
            CURLOPT_HEADER          => 0,
            CURLOPT_RETURNTRANSFER  => TRUE,
            CURLOPT_FOLLOWLOCATION  => TRUE,
            CURLOPT_TIMEOUT         => 4
        );

        $ch = curl_init();
        curl_setopt_array( $ch, ( $options + $defaults ) );

        $_result = curl_exec( $ch );
        $info = curl_getinfo( $ch );

        if( $info['http_code'] == 200 ){

            $result = json_decode( $_result, $this->respondType );

        } else {

            $result['status']       = $info['http_code'];
            $result['status_txt']   = $this->_requestStatus( $info['http_code'] );
            $result['data']         = "";

        }

        curl_close( $ch );

        return $result;
    }


    private function _requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }


}