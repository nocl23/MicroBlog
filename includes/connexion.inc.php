<?php
$pdo = new PDO('mysql:host=localhost;dbname=dbname', 'pseudo', 'passwd', $arrExtraParam);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
