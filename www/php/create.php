<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

error_reporting(0);
header("Content-type: application/json");
require_once('service/Service.php');
require_once('Tools.php');
// $obj1 = array(
//     'entity'  => 'country',
//     'country' => array(
//         'code'     => 'fsd',
//         'idTrans'  => 1,
//         'idLocale' => 1
//     )
// );
// $obj2 = array(
//     'entity' => 'user',
//     'user'   => array(
//         'username'   => 'testuser',
//         'pass'       => 'a1234',
//         'email'      => 'test@user.com',
//         'name'       => 'Test',
//         'lastname'   => 'User Account',
//         'idCountry'  => 1,
//         'phone'      => '123654987',
//         'birthdate'  => '1991-10-20',
//         'idGender'   => 1,
//         'isMaster'   => TRUE,
//         'flagActive' => TRUE,
//         'flagStatus' => 1
//     )
// );
// $objects = array();
// array_push($objects, json_encode($obj1));
// array_push($objects, json_encode($obj2));
$entities = $_POST["entity"];
$service = new Service();
Tools::instance()->writeToFile("archivo.txt", $entities, "a+");
foreach ($entities as $value) {
    $query = new Query();
    $query->setJSONFields($value);
    $service->persist($query);
}
$service->close();
echo "{ 'result' : 'ok' }";