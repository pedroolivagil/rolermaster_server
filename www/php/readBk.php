<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */
error_reporting(E_ALL ^ E_NOTICE);
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
//http://localhost/rolermaster/www/php/read.php?entityQuery=locale&filter[0]=codeISO&filter[1]=idLocale&filter[2]=join&join[0][entityParent]=locale&join[0][entityJoin]=locale_trans&join[0][pkParent]=idLocale&join[0][pkJoin]=idLocaleGroup&join[0][restrict]=0&codeISO=ES&idLocale=45
require_once('service/Service.php');
require_once('Tools.php');
$entity = $_REQUEST[ 'entityQuery' ];
$filter = $_REQUEST[ 'filter' ];
$params = array();
$joins = array();
foreach ($filter as $key => $value) {
    if ($value != "join") {
        $params = array_merge($params, array( $value => $_REQUEST[ $value ] ));
    } else {
        $joins = array_merge($joins, array( $value => $_REQUEST[ $value ] ));
    }
}
$arrayJoins = array();
foreach ($joins as $join) {
    foreach ($join as $value) {
        array_push($arrayJoins, new Join($value));
        Tools::instance()->writeToFile("text.txt", $value, "a+");
    }
}
$service = new Service();
$query = new Query();
$query->setTable($entity);
$query->setJoins($arrayJoins);
$query->setFields($params);
$results = $service->executeFind($query);
if ($results != NULL) {
    $result = array(
        'result'   => 200,
        'entities' => $results
        // ,"query"      => $query->toFind()
    );
} else {
    $result = array(
        'result'  => 100,
        'message' => json_last_error_msg()
    );
}
print_r(json_encode($result));
$service->close();
