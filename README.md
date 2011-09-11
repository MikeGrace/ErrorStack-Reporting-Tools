PHP ErrorStack Reporting
========================

[ErrorStack](http://www.errorstack.com/) is a web service which collects
errors from web based, server, mobile, and desktop applications and allows
you to analyze the error data.

This repository contains an open source PHP class that makes calling the
ErrorStack service simpler and handles setting ErrorStack as the uncaught
exception handler. The code contained in this repository is licensed under
the Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0.html)

Usage
-----

Simplest usage is just including the file. Uncaught exceptions will be
reported to ErrorStack.

    include("errorstack.php");
    
After including the ErrorStack file you can send a log message to
ErrorStack's rotating log.

    ErrorStack::log("I just thought you should know...");
    
Reporting a caught exception is as easy as

    ErrorStack::report($e);