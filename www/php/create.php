<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

require_once('service/Service.php');

$query = new Query();
$query->setFields(array(
    'username' => 'testuser',
    'pass' => '1234',
    'email' => 'test@user.com',
    'name' => 'Test',
    'lastname' => 'User Account',
    'idCountry' => 1,
    'phone' => '123654987',
    'birthdate' => '1991-10-20',
    'idGender' => 1,
    'isMaster' => true,
    'flagActive' => true,
    'flagStatus' => 1,
));
$query->setTable("user");

$service = new Service();
$service->persist($query);