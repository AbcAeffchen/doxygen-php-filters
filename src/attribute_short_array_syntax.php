<?php
/**
 * Project: doxygen-php-filters
 * User:    Alex Schickedanz (AbcAeffchen)
 * Date:    05.03.2015
 * License: GPL v2.0
 */

// Get the input
$source = file_get_contents($argv[1]);

/**
 * Look for code that looks like
 * `public $varname = [ ... ];`
 * and change it into
 * `public $varname = array( ... );`
 */
$regexp = '#((var|public|protected|private)(\s+static)?)\s+(\$[^\s;=]+)\s+\=\s+\[([\s\S]*?)\]\;#';
$replace = '$1 $4 = array( $5 );';
$source = preg_replace($regexp, $replace, $source);

// Output
echo $source;