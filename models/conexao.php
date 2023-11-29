<?php

class Conexao
{
    public static function conectar(){

        $link = new PDO("mysql:host=localhost;dbname=admin_atelie",
                        "root",
                        "");
        $link->exec("set names utf8");

        return $link;
    }
}