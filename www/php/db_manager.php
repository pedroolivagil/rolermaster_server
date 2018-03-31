<?php
/**
 * Created by OliLogicStudios.
 * User: OlivaDevelop
 * Project: rolermaster
 * File: db_manager.php
 * Date: 26/03/2018 00:58
 */
error_reporting(0);
header("Content-type: application/json");
require_once('service/Service.php');
require_once('Tools.php');
$service = new Service();
$arrayQueries = $_POST[ "query" ];
foreach ($arrayQueries as $query) {
    $service->execute($query);
}
if ($service->getProblems() == 0) {
    $service->commit();
    $result = array(
        'result' => 200
    );
} else {
    $result = array(
        'result'  => 100,
        'message' => $service->getErrorInfo()
    );
}
$service->close();
print_r(json_encode($result));