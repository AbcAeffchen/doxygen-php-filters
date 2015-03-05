<?php
/**
 * Project: doxygen-php-filters
 * Author:  Alex Schickedanz (AbcAeffchen)
 * Date:    05.03.2015
 * License: GPL v2.0
 */

// Get the input
$source = file_get_contents($argv[1]);

// removes the whole line
list($head,$tail) = preg_split('/.*if\(!class_exists\(.+/', $source, 2);

$openingBracePos = strpos($tail,'{');
$closingBracePos = strrpos($tail,'}');

if($openingBracePos !== false && $closingBracePos !== false)
    $source = $head . substr($tail,$openingBracePos+1,
                             $closingBracePos-$openingBracePos-1);

// Output
echo $source;