<?php

// write to daily log files
Illuminate\Support\Facades\Log::useDailyFiles(
	storage_path().'/logs/'.php_sapi_name().'.log'
);

// filters file
require app_path().'/filters.php';

// https://github.com/anlutro/laravel-4-smart-errors
require app_path().'/error.php';
