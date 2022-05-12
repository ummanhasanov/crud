<?php

try {
    $db = new PDO("mysql::host=localhost;dbname=crud;charset=UTF8","root","");
} catch (PDOException $e) {
    echo $e->getMessage();
}
