<?php

session_start();

date_default_timezone_set('Europe/Vatican');

include('db.php');
include('fn.php');

if(!defined("JS_FILE"))
    controllaSessione();