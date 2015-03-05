<?php
/**
 * Project: doxygen-php-filters
 * Author:  Goran Rakic, Alex Schickedanz (AbcAeffchen)
 * Date:    05.03.2015
 * License: GPL v2.0
 */

// Get the input
$source = file_get_contents($argv[1]);

/**
 * Look for code that looks like
 * ```
 *  \**
 *  * @var int Some documentation text
 *  *\
 *  private $var = 1;
 * ```
 * and change it into
 * ```
 *  \**
 *  * Some documentation text
 *  *\
 *  private $var = 1;
 * ```
 */
$regexp = '#\@(var|type)\s+([^\s]+)([^/]+)/\s+(var|public|protected|private)(\s+static)?)\s+(\$[^\s;=]+)#';
$replace = '$3 */ $4 $5 $2 $6';
$source = preg_replace($regexp, $replace, $source);

// Output
echo $source;