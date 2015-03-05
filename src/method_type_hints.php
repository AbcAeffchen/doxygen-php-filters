<?php
/**
 * Project: doxygen-php-filters
 * Author:  Alex Schickedanz (AbcAeffchen)
 * Date:    05.03.2015
 * License: GPL v2.0
 */

// Get the input
$source = file_get_contents($argv[1]);

$regexp = '#(\/\*\*[\s\S]*?@return\s+([^\s]*)[\s\S]*?\*\/[\s\S]*?)((public|protected|private)(\s+static)?)\s+function\s+([\S]*?)\s*?\(#';
$replace = '$1 $3 $2 function $6(';
$source = preg_replace($regexp, $replace, $source);

// Output
echo $source;