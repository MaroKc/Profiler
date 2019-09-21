<?php

define("JS_FILE", true);

include('profiler/main.php');

define("JS_FILE", true);

echo json_encode(analizzaSezioni($_GET['url'], true));