<?php
namespace Hash;
interface HashI{

    public static function verify($password, $hashedPassword);
    public static function generate($hashedPassword);
}