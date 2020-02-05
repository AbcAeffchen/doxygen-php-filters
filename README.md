# doxygen-php-filters
[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/AbcAeffchen/doxygen-php-filters?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

Filters to get [Doxygen](http://doxygen.nl/) ([Doxygen on GitHub](https://github.com/doxygen/doxygen)) work better with PHP code.

## How to use
1. Choose your filter and download the `.php` file. If you want to use more than one filter, 
you can combine them to one file or if you want to use all filters, you can use `all_filters.php`.
2. Set the [`INPUT_FILTER`](http://doxygen.nl/manual/config.html#cfg_input_filter) to `php filter_file_name.php`.  
If PHP is not included in your PATH variable, you have to use `/path/to/php filter_file_name.php`
instead.

## The Filters
### Short array syntax (`attribute_short_array_syntax.php`)
This filter adds support for the short array syntax introduced with 
[PHP 5.4](https://www.php.net/manual/en/migration54.new-features.php).
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
[this Stackoverflow answer](https://stackoverflow.com/a/8472180/3440545) by Goran Rakic.  
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

### Support/Workaround for traits (`traits.php`)
Since PHP does not support inheritance from multiple classes, you maybe want to use [traits](https://www.php.net/manual/en/language.oop5.traits.php).
But doxygen does not support this at all.

This filter converts a trait into a class and transforms all usages of a trait into an inheritance.
So

    class MyClass{
        use MyTrait1, MyTrait2;
        
        ...
    }

becomes

    class MyClass extends MyTrait, MyTrait2{
        ...
    }

This is not valid PHP, but doxygen documents it as a multiple inheritance and you can see the methods
of the traits in you class.

**Notice**: This filter doesn't support [conflict resolution](https://www.php.net/manual/en/language.oop5.traits.php#language.oop5.traits.conflict).
So 

    class MyClass {
        use MyTrait1, MyTrait2 {
            MyTrait2::traitFunction1 insteadof MyTrait1;
            MyTrait1::traitFunction2 insteadof MyTrait2;
        }
    }
    
will not work.

### Support class attributes grouped by visibility  (`attribute_grouped_visibility.php`)
This filter supports declarations like

    class Foo
    {
        private
            /// the blue color
            $blue,
            /// the red color
            $red;
            
        ...
    }
    
by iteratively copying the keywords `private`, `protected` and `public` to the attributes.

### Laravel Cron Documentation (`laravel_cron.php`)
Documentation like

    /**
     * Docs
     */
    \Cron::add('jobName', '* * * * *', function() 
    {
        ...
    });
    
gets lost because the documentation comment is not followed by a function declaration. It also 
not works if you move the documentation comment right in front of the `function()`, because doxygen
is missing a function name. The filter is moving the documentation comment to the right place,
removes the `Cron::add(...,...,` part and copies the name to the `function()` so it looks like this:

    /**
     * Docs
     */
    public function jobName() 
    {
        ...
    });

This also works if the documentation comment is already in the right place.

Since this filter is very special to some users of Laravel, it is not included in the *all_filters* file.

## Credits
Thanks to [Goran Rakic](https://stackoverflow.com/users/276152) for providing the class member hint filter in [this Stackoverflow answer](https://stackoverflow.com/a/8472180/3440545). 
This gave me the first push to write more filters.  
Thanks to [Lorenz Meyer](https://stackoverflow.com/users/1951708) for improving the traits filter.  
Thanks to [madankundu](https://stackoverflow.com/users/1627702) for testing the laravel_cron filter.
## License
Licensed under the GPL v2.0 License.
