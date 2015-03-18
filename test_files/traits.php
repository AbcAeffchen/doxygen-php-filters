<?php
/**
 * @copyright 2015 doxygen-php-filters
 * @author Alexander Schickedanz (AbcAeffchen) <abcaeffchen@gmail.com>
 */

trait Trait1
{
    public function traitFunction1()
    {
        return;
    }
}

trait Trait2
{
    public function traitFunction2()
    {
        return;
    }
}

class ParentClass
{
    public function parentFunction()
    {
        return;
    }
}

interface MyInterface
{
    public function interfaceFunction();
}

class TraitTest
{
    use Trait1;

    public function function1()
    {
        return;
    }
}

class MultiTraitTest
{
    use Trait1, Trait2;

    public function function1() {
        return;
    }
}


class MultiTraitTestWithExtends extends ParentClass
{
    use Trait1, Trait2;

    public function function1() {
        return;
    }
}

class MultiTraitTestWithImplements implements MyInterface
{
    use Trait1, Trait2;

    public function function1() {
        return;
    }

    public function interfaceFunction() {
        return;
    }
}

class MultiTraitTestWithExtendsAndImplements extends ParentClass implements MyInterface
{
    use Trait1, Trait2;

    public function function1() {
        return;
    }

    public function interfaceFunction() {
        return;
    }
}