<?php

/**
* PHP implementation of BulkSMS Service
* Client
* Service Provider http://bulksms-service.com
*
* @package BulkSMS
* @author Rakesh Kumar Shardiwal <rakesh.shardiwal@gmail.com>
* @dependency JSON-RPC 2.0
*/

class BulkSMS {

    /**
     * Some URL constants
     */
	const BASE_URL              = 'http://ht.bulksms-service.com/api/';
    const SMS_URL               = '/web2sms.php';
    const DELIVERY_STATUS_URL   = '/status.php';
    const BALANCE_CHECK_URL     = '/credits.php';

    /**
     * Some service properties
     *
     * @var string
     * @access public
     */
    public $_client, $_api_url, $_api_key, $_senderId;

    /**
     * Set some values for BulkSMS::properties
     *
     * @param array $args
     */
	public function __construct($args)
	{
        if ( !$args ) {
            throw new Exception(
                'Error: Not enough parameters (
                    Constructor array("api_key" => "xyz123", "senderId" => "OPD")
                ) !!!\n'); 
        }

        //include once the class file
        include_once('JsonRpcClient.php');
        //request the instance
		$this->_client   = new JsonRpcClient();

		$this->_api_url  = BulkSMS::BASE_URL;
        $this->_api_key  = $args['api_key'];
        $this->_password = $args['password'];
        $this->_senderId = $args['senderId'];

	}

	public function balance()
	{
		$account = new stdClass;
		$account->url = array(BulkSMS::BALANCE_CHECK_URL);
		$account->params = array(
            'workingkey' => $this->_username
        );
		return $this->api( $this->buildURL($account) );
	}    

	public function send_sms( $mobile_no, $message )
	{
		$sms = new stdClass;
		$sms->url = array(BulkSMS::SMS_URL);
		$sms->params = array(
            'workingkey'    => $this->_api_key,
            'sender'        => $this->senderId,
            'message'       => $message,
            'to'            => $mobile_no
        );
		return $this->api( $this->buildURL($sms) );
	}

	private function api($url, $post = false, $postData = array())
	{
		$this->_client->setURL($url);
		$result = $this->_client->rawcall($postData, $post);
        return $result;
	}

	private function buildURL($requestData)
	{
		$url = $this->_api_url;
		if (isset($requestData->url)) {
			$url .= implode('/', $requestData->url);
		}

		if (isset($requestData->params)) {
			$url .= "?";
			$extraParam = array();

			foreach ($requestData->params as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $val) {
						$extraParam[] = $key . "=" . $val;
					}
				}
				else {
					$extraParam[] = $key . "=" . $value;
				}
			}

			$url .= implode("&", $extraParam);
		}

		return $url;
	}

    private function throwException($message = null,$code = null) {
        echo "Error $code: $message";
        die();
    }

}
