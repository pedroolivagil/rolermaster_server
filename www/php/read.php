<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */
error_reporting(E_ALL ^ E_NOTICE);
// header("Content-type: application/json");
require_once('service/Service.php');
require_once('Tools.php');
$service = new Service();
$results = $service->fetchAll($_POST[ "query" ]);
if ($results != NULL) {
    $result = array(
        'result'   => 200,
        'entities' => json_decode($results, TRUE)
    );
} else {
    $result = array(
        'result'  => 100,
        'message' => "Entity not fount"
    );
}
$service->close();
print_r(json_encode($result));
