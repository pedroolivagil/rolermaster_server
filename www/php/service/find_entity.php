<?php
error_reporting(0);
header("Content-type: application/json");
$typeQuery = $_POST[ 'typeQuery' ];
$entity = $_POST[ 'entity' ];
$userId = $_POST[ 'userId' ];
$idEntity = $_POST[ 'idEntity' ];
$result = array(
    'TestEntity' => array(
        array(
            'key'  => 1234,
            'text' => 'Test texto de prueba para el usuario'
        )
    )
);
// sleep(10);
echo json_encode($result);