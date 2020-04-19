<pre>
<?php

class Person {
    private $name;
    private $age;

    public function __construct($name, $age) {
        echo 'Class' . __CLASS__ . ' instantiated...';
        echo '<br>';
        $this->name = $name;
        $this->age = $age;
    }

    public function sayHello() {
        return $this->name.' says hello! <br>';
    }

    public function __destruct() {
        echo "Destruct the object... <br>";
    }

//    public function getName() {
//        return $this->name;
//    }
//    public function setName($name) {
//        $this->name = $name;
//    }

    public function __get($property) {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if(property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
}

$p1 = new Person("Morteza", 31);

echo $p1->__get('name');

$p1->__set('age', 33);

echo "<br><br>";

print_r($p1);
?>
</pre>
