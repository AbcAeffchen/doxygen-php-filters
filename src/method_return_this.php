<?php
/**
 * Project: doxygen-php-filters
 * Author:  Alex Schickedanz (AbcAeffchen)
 * Date:    05.03.2015
 * License: GPL v2.0
 */

// Get the input
$source = file_get_contents($argv[1]);

$tokens = token_get_all($source);
$classes = [];
foreach($tokens as $key => $token)
{
    if($token[0] == T_CLASS)
        $classes[] = $tokens[$key+2][1];
}

if(!empty($classes))
{
    list($source, $tail) = explode('class ' . $classes[0], $source, 2);
    $class_code = '';
    for($i = 1; $i < count($classes); $i++)
    {
        list($class_code, $tail) = explode('class ' . $classes[$i], $tail, 2);
        $class_code = str_replace('@return $this', '@return ' . $classes[$i-1], $class_code);
        $source .= 'class ' . $classes[$i-1] . $class_code;
    }
    $class_code = str_replace('@return $this', '@return ' . $classes[count($classes)-1], $tail);
    $source .= 'class ' . $classes[count($classes)-1] . $class_code;
}

// Output
echo $source;