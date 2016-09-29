<?php
/**
 * Project: doxygen-php-filters
 * User:    Alex Schickedanz (AbcAeffchen)
 * Date:    29.09.2015
 * License: GPL v2.0
 */

// Get the input
$source = file_get_contents($argv[1]);

$regexp = '#(\/\*\*[\s\S]*?\*\/\s*)?(\\\\?Cron\s*::\s*add\()(\'|")([^,\']+)(\'|")(\s*,\s*[^,]+\s*,\s*)(\/\*\*[\s\S]*?\*\/\s*)?function\s*\(\s*\)#';
$replace = '$1$7public function $4()';
$source = preg_replace($regexp, $replace, $source);

// Output
echo $source;