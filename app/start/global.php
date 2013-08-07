<?php

// write to daily log files
$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

// filters file
require app_path().'/filters.php';

// https://github.com/anlutro/laravel-4-smart-errors
require app_path().'/error.php';