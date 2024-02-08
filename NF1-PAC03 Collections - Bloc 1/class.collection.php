<?php
class KeyInUseException extends Exception {}

class KeyInvalidException extends Exception {}

class Collection {
    private $_members = array();    

    public function addItem($obj, $key = null) {
        if ($key !== null) {
            if ($this->exists($key)) {
                throw new KeyInUseException("Key \"$key\" already in use!");
            } else {
                $this->_members[$key] = $obj;
            }
        } else {
            $this->_members[] = $obj;
        }
    }

    public function removeItem($key) {
        if ($this->exists($key)) {
            unset($this->_members[$key]);
        } else {
            throw new KeyInvalidException("Invalid key \"$key\"!");
        }  
    }

    public function getItem($key) {
        if ($this->exists($key)) {
            return $this->_members[$key];
        } else {
            throw new KeyInvalidException("Invalid key \"$key\"!");
        }
    }

    public function keys() {
        return array_keys($this->_members);
    }

    public function length() {
        return count($this->_members);
    }

    public function exists($key) {
        return array_key_exists($key, $this->_members);
    }

    public function __toString() {
        $result = "Mostrant tots els elements de la col·lecció:\n";
        foreach ($this->_members as $item) {
            $result .= $item . "\n";  
        }
        return $result;
    }
}

class Pattern {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function __toString() {
        return "Nom del patró: " . $this->name;
    }
}

class PatternCollection extends Collection {
    public function addPattern(Pattern $obj = null, $key = null) {
        $this->addItem($obj, $key);
    }
}

$patternCollection = new PatternCollection();
$patternCollection->addPattern(new Pattern("Patron 1"));
$patternCollection->addPattern(new Pattern("Patron 2"));
$patternCollection->addPattern(new Pattern("Patron 3"));

$pattern1 = $patternCollection->getItem(0);
echo $pattern1; 
echo "<br>";

$patternCollection->removeItem(0); 
echo "Eliminado: Patron 1<br>";

try {
    $pattern1 = $patternCollection->getItem(0); 
} catch (KeyInvalidException $kie) {
    echo "La colección no contiene un elemento en la posición 0";
}

echo "<br><br>";
echo $patternCollection; 
?>

