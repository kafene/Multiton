<?php

class parentClass {
    use Multiton;
    function sayName() {
        $class = preg_split('/(?=[A-Z])/', get_called_class());
        $class = basename(array_shift($class));
        return "I am the $class class";
    }
}

class childClass extends parentClass {}

list($parent, $child) = [new parentClass, new childClass];

# Print/eval helper.
$p = function($code) use($parent, $child) {
    print "<h1>$code</h1>";
    eval("var_dump($code);");
};

$p('parentClass::getInstance(), childClass::getInstance()');
$p('$parent, $child');
$p('$parent->sayName(), $child->sayName()');
$p('parentClass::getInstance("bob")');
$p('childClass::getInstance("tommy")');
$p('childClass::getInstance() !== childClass::getInstance("yaya")');
$p('childClass::getInstance() === childClass::getInstance()');
$p('childClass::getInstance() !== parentClass::getInstance()');
$p('parentClass::getInstance() === parentClass::getInstance()');

