<?php

/*************************************
 * ----- INIT DATABASE CONNECTION -----
 *************************************/

function init_db()
{
    try {
        $host = '192.168.1.18';
        $dbname = 'codflix';
        $charset = 'utf8';
        $user = 'user';
        $password = '1234';
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password);
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());

    }

    return $db;
}