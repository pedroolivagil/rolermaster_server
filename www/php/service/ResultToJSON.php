<?php
/**
 * Created by OliLogicStudios.
 * User: OlivaDevelop
 * Project: rolermaster
 * File: ResultToJSON.php
 * Date: 21/03/2018 19:32
 */

class ResultToJSON {

    private $resultJSON;

    /**
     * ResultToJSON constructor.
     * @param $result
     */
    public function __construct($result) {
        $this->parse($result);
    }

    /**
     * Devuelve el resultado en formato JSON a partir del mapa de las entidades
     *
     * @param $result
     */
    private function parse($result) {
        if ($result != NULL) {

        }
    }

    public function getResult() {
        return $this->resultJSON;
    }
}