<?php
try{
        $bdd = new PDO('mysql:host=localhost;dbname=protut;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        //$bdd = new PDO('mysql:host=;dbname=;charset=utf8', '', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    }catch (Exception $e){
        die('Err : ' . $e->getMessage());
    }

?>
