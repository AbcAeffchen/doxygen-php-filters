<?php
/**
 * @copyright 2015 doxygen-php-filters
 * @author Alexander Schickedanz (AbcAeffchen) <abcaeffchen@gmail.com>
 * @licence GPL v2.0
 */

// Get the input
$source = file_get_contents($argv[1]);

$count = 0;

do {
    $source = preg_replace('#(private|public|protected)(\s*[^$]*)(\$[^,;]+),#',
                           "$2 $1 $3;\n$1 ", $source, -1, $count);
} while($count > 0);

// Output
echo $source;