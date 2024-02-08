<?php
require_once('class.collection.php');

class Foo {
    private $_name;
    private $_number;

    public function __construct($name, $number) {
        $this->_name = $name;
        $this->_number = $number;
    }

    public function __toString() {
        return $this->_name . ' is number ' . $this->_number;
    }
}

$colFoo = new Collection();
$colFoo->addItem(new Foo("Steve", 14), "steve");
$colFoo->addItem(new Foo("Ed", 37), "ed");
$colFoo->addItem(new Foo("Bob", 49));

$objSteve = $colFoo->getItem("steve");

echo $objSteve; 
echo "<br>";

$colFoo->removeItem("steve"); 
echo "Removed: Steve<br>";

try {
    $objSteve = $colFoo->getItem("steve"); 
} catch (KeyInvalidException $kie) {
    echo "The collection doesn't contain anything called 'steve'";
}
