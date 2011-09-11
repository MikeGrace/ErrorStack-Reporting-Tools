<?php

// Including the errorstack class and functions which will also set 
// ErrorStack to handle all uncaught exceptions thrown in this file.
include("errorstack.php");

// Log example log message to errorstack's rotating debug log
ErrorStack::log("I just thought you should know...");

// Log() can also handle objects that can be json encoded
ErrorStack::log(array("name" => "Mike"));

try {
	throw new Exception('how did that happen?');
} catch (Exception $e) {
	ErrorStack::report($e);
	echo "Gracefully handled exception and reported to ErrorStack.";
}

// uncaught exception will be sent to the errorstack class but the
// application will die after and the following echo statement will
// not be executed.
throw new Exception('Doh! Runaway exception');

echo "You'll never get to see this awesome echo statement printed out : (";

?>