<pre>
<?php

class Person {
    public $name;
    public $age;

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
}

$p1 = new Person("Morteza", 31);
echo $p1->sayHello();

?>
</pre>
