<?php


function executeTableCreate(PDO $pdo)
{
    $sql = "CREATE TABLE IF NOT EXISTS pizza (
        id      INT PRIMARY KEY AUTO_INCREMENT,
        bodem   INT(2) NOT NULL,
        saus    VARCHAR(17) NOT NULL,
        topping VARCHAR(11),
        kruiden VARCHAR(255)
    )";
    $pdo->exec($sql);
}
