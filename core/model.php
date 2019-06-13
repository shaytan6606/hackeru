<?php

abstract class Model
{
    public static $db;

    public function __construct()
    {
        self::$db = Db::getInstance();
    }
}