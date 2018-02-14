<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */
error_reporting(0);
header("Content-type: application/json");

$typeQuery = $_POST['typeQuery'];
$entity = $_POST['entity'];
$userId = $_POST['userId'];
$idEntity = $_POST['idEntity'];
$result = array(
    'country' => array(
        'idCountry' => 123,
        'code' => 'ES',
        'translation' => array(
            'idLocale' => 1,
            'text' => 'Español'
        )
    )
);
// sleep(10);
echo json_encode($result);