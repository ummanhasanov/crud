<?php

try {
    $db = new PDO("mysql::host=localhost;dbname=performans_db;charset=UTF8","root","");
} catch (PDOException $e) {
    echo $e->getMessage();
}
