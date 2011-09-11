<?php
/**
 * LICENSE:
 *
 * This is free software: you can redistribute it and/or modify it under the terms of the Apache License,
 * Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0.html)
 *
 * This is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the Apache License, Version 2.0
 * (http://www.apache.org/licenses/LICENSE-2.0.html) for more details.
 *
 * @author Michael Grace <michael[at]michaelgrace[dot]org>
 * @license http://www.apache.org/licenses/LICENSE-2.0.html
 */


/**
 * ErrorStack class object used to report errors to errorstack.com
 *
 * You will need an errorstack key in order for the error reporting
 * to work. You can get a key by signing up at {@link http://www.errorstack.com/}.
 * For examples on how to use the ErrorStack class see example.php
 */
class ErrorStack {
	
	/**
	 * Your errorstack key goes here.
	 * Example: public static $key = "c162a320c89b7c7165oe7u8i9cf878";
	 */
	public static $key = [your errorstack key goes here];
	
	/**
	 * Reports errors to errorstack
	 *
	 * @param $error	exception object thrown by error or caught by catch block
	 */
	function report($error) {
		$params = array(
			"_s" => ErrorStack::$key,
			"_r" => "json",
			"Msg" => $error->getMessage(),
			"File" => $error->getFile(),
			"Line" => $error->getLine()
			
		);
		ErrorStack::send($params);
	}
	
	/**
	 * Logs message or object to errorstack's rotating log for debugging
	 *
	 * @param $input	string or object that can be json encoded for rotating log
	 */
	function log($input) {
		$type = "text";
		if (!is_string($input)) {
			$input = json_encode($input);
			$type = "json";
		}
		$params = array(
			"_s" => ErrorStack::$key,
			"_r" => "json",
			"_t" => $type,
			"_msg" => $input
			
		);
		ErrorStack::send($params, "http://www.errorstack.com/log");
	}
	
	/**
	 * Sends error report or log request to errorstack using curl and 
	 * throws away response
	 */
	function send($params, $url="http://www.errorstack.com/submit") {
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
		curl_setopt($ch	, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
	}
}

/**
 * Sets the default exception handler if an exception is not caught
 * within a try/catch block. Execution will stop after the
 * exception_handler is called so don't use this as an excuse
 * to not use try catch blocks in your code.
 */
set_exception_handler("ErrorStack::report");

?>