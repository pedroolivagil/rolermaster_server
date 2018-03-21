<?php
error_reporting(0);
header("Content-type: application/json");
$typeQuery = $_POST[ 'typeQuery' ];
$entity = $_POST[ 'entity' ];
$userId = $_POST[ 'userId' ];
$idEntity = $_POST[ 'idEntity' ];
$result = array(
    'user' => array(
        array(
            'key'  => 1234,
            'text' => 'Test texto de prueba para el usuario'
        )
    )
);
// sleep(10);
echo json_encode($result);

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
$entity = $_POST['entityQuery'];
$userId = $_POST['userId'];
$idEntity = $_POST['idEntity'];
$result = array( // para crear array asociativo
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
);
// sleep(10);
echo json_encode($result);
