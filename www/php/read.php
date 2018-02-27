<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */
/*error_reporting(0);*/
header("Content-type: application/json");
/*$typeQuery = $_POST['typeQuery'];
$entity = $_POST['entityQuery'];
$userId = $_POST['userId'];
$idEntity = $_POST['idEntity'];*/
/*$result = array( // para crear array asociativo
    $entity => array( // para crear array de lista de objetos
        array( // array asociativo de cada objeto devuelto
            '_persisted' => true,
            'idCountry' => 135,
            'locale' => array(
                '_persisted' => true,
                'idLocale' => 1,
                'codeISO' => 'ES',
                'translations' => array(
                    array(
                        'idTrans' => 1,
                        'idLocale' => 1,
                        'idLocaleGroup' => 1,
                        'text' => 'Español',
                        '_persisted' => true
                    ), array(
                        'idTrans' => 2,
                        'idLocale' => 2,
                        'idLocaleGroup' => 1,
                        'text' => 'Spain',
                        '_persisted' => true
                    )
                )
            ),
            'code' => 'ES',
            'translations' => array(
                array(
                    '_persisted' => true,
                    'idCountry' => 135,
                    'idTrans' => 3,
                    'idLocale' => 1,
                    'text' => 'Español'
                ),
                array(
                    '_persisted' => true,
                    'idCountry' => 135,
                    'idTrans' => 4,
                    'idLocale' => 2,
                    'text' => 'Spain'
                )
            )
        )
    )
);*/
/*echo json_encode($result);*/
//URL de prueba
/*http://localhost/rolermaster/www/php/read.php?entityQuery=locale&typeQuery=1&filter%5B0%5D=codeISO&filter%5B1%5D=idLocale&codeISO=ES&idLocale=142*/
require_once('service/Service.php');
require_once('Tools.php');
$typeQuery = $_REQUEST['typeQuery'];
$entity = $_REQUEST['entityQuery'];
$userId = $_REQUEST['userId'];
$filter = $_REQUEST['filter'];
$search = $_REQUEST[$filter[0]];
print_r($_REQUEST);
$params = array();
foreach ($filter as $key => $value) {
    $params = array_merge($params, array($value => $_REQUEST[$value]));
}

print_r($params);

$query = new Query();
$query->setTable($entity);
$query->setFields($params);
print $query->toFind();
$service = new Service();

$service->close();
echo "{ 'result' : 'ok' }";