# doxygen-php-filters

[![Join the chat at https://gitter.im/AbcAeffchen/doxygen-php-filters](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/AbcAeffchen/doxygen-php-filters?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
Filters to get [Doxygen](http://www.stack.nl/~dimitri/doxygen/) ([Doxygen on GitHub](https://github.com/doxygen/doxygen)) work better with PHP code.

## How to use
1. Choose your filter and download the `.php` file. If you want to use more than one filter, 
you can combine them to one file or if you want to use all filters, you can use `all_filters.php`.
2. Set the [`INPUT_FILTER`](http://www.stack.nl/~dimitri/doxygen/manual/config.html#cfg_input_filter) to `php filter_file_name.php`.  
If PHP is not included in your PATH variable, you have to use `/path/to/php filter_file_name.php`
instead.

## The Filters
### Short array syntax (`attribute_short_array_syntax.php`)
This filter adds support for the short array syntax introduced with 
[PHP 5.4](http://php.net/manual/de/migration54.new-features.php).
If you have a multiline default value for a class member like this

    private $arr = [ 0 => [ ... ],
                     2 => [ ... ] ];

doxygen only adds the first line to the documentation.
The filter converts this code to 

    private $arr = array( 0 => [ ... ],
                          2 => [ ... ] );

so doxygen can understand the array syntax right.

### Class member type hints (`attribute_type_hints.php`)
There seems to be a [bug](https://bugzilla.gnome.org/show_bug.cgi?id=626105) that prevents
doxygen from documenting class members with `@var`. The filter is a slight improvement from 
[this Stackoverflow answer](http://stackoverflow.com/a/8472180/3440545) by Goran Rakic.  
**Notice**: The documentation string must not contain a slash (`/`).

### Support for `@return $this` (`method_return_this.php`)
Sometimes you want to return `$this`, but then doxygen does not link the return type to the class.
This filter fixes this by looking for the right class name `$this` belongs to and replaces `$this`
by the class name.

### Class method type hints (`method_type_hints.php`)
If you have some trouble with type hints of class methods, this filter could be helpful.

### Support `class_exists()` checks (`class_exists_support.php`)
If you use `if(!class_exists('className')){ ... }` to prevent defining a class multiple times,
doxygen could get confused. This filter removes the if-statement for doxygen.  
**Notice**: If you must not define more than one class in a file that uses `if(!class_exists())`
and you have to use the string `if(!class_exists(` to get this filter work. The whole line, 
that contains this string gets removed.

## License
Licensed under the GPL v2.0 License.
