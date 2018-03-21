<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

final class Tools {
    private static $tools;

    private function __construct() {

    }

    public static function instance() {
        if (self::$tools == null) {
            self::$tools = new Tools();
        }
        return self::$tools;
    }

    public function writeToFile($fileName, $arrayText, $flagsOpen = "w") {
        $file = fopen($fileName, $flagsOpen);
        foreach ($arrayText as $key => $value) {
            fwrite($file, "[" . date("YYYY-MM-DD") . "] [$key]" . $value . PHP_EOL);
        }
        fclose($file);
    }
}