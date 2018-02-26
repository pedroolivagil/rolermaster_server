<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */
error_reporting(0);
header("Content-type: application/json");
$typeQuery = $_POST[ 'typeQuery' ];
$entity = $_POST[ 'entity' ];
$userId = $_POST[ 'userId' ];
$idEntity = $_POST[ 'idEntity' ];
$result = array(
    'idCountry'     => 135,
    'idLocale'      => 1,
    'code'          => 'ES',
    'country_trans' => array(
        array(
            'idCountry' => 135,
            'idLocale'  => 1,
            'text'      => 'Español'
        ), array(
            'idCountry' => 135,
            'idLocale'  => 2,
            'text'      => 'Spain'
        )
    )
);
// sleep(10);
echo json_encode($result);