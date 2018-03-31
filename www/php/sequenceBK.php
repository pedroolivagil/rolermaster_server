<?php
/**
 * Created by OliLogicStudios.
 * User: OlivaDevelop
 * Project: rolermaster
 * File: sequence.php
 * Date: 24/02/2018 15:56
 */

error_reporting(0);
header("Content-type: application/json");
require_once('service/Service.php');
require_once('Tools.php');
$service = new Service();
$nameSequence = $_REQUEST[ "nameSequence" ];
$newSeq = $service->preparedToJSON("SELECT nextval('$nameSequence') as sequence;");
$service->commit();
echo $newSeq;