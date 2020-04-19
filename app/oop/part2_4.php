<?php
//declare(strict_types = 1);

class User {
    public string $username;
    public static int $minPassLength = 6;

    public static function validatePass($pass): void {
        if(strlen($pass) >= self::$minPassLength) {
            echo "Password is valid.";
        } else {
            echo "<p style='color: red'>Password is invalid</p>";
        }
    }
}

$psw = "Hello";
User::validatePass($psw);