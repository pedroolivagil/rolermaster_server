<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

class Query {

    private $table;
    private $fields;
    private $joins;
    private $flags;

    /**
     * Query constructor.
     */
    public function __construct($flags = NULL) {
        $this->flags = $flags;
    }

    /**
     * @return mixed
     */
    public function getTable() {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table) {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields) {
        $this->fields = $fields;
    }

    /**
     * @param mixed $fields
     */
    public function setJSONFields($json) {
        $array = json_decode($json, TRUE);
        $this->table = $array[ENTITY];
        $this->fields = $array[$this->table];
    }

    /**
     * @return mixed
     */
    public function getJoins() {
        return $this->joins;
    }

    /**
     * @param mixed $joins
     */
    public function setJoins($joins) {
        $this->joins = $joins;
    }

    function getColumns($t = NULL) {
        if ($t == NULL) {
            $t = $this->table;
        }
        $query = "SHOW COLUMNS FROM $t;\n";
        return $query;
    }

    function toFind() {
        $properties = array_keys($this->fields);
        $values = array_values($this->fields);
        $where = array();
        foreach ($properties as $key => $property) {
            $val = "'" . $values[$key] . "'";
            if (is_numeric($values[$key])) {
                $val = $values[$key];
            }
            array_push($where, "$this->table.$property = $val");
            array_push($where, "$this->table.$property = $val");
        }
        $condition = implode(' AND ', $where);
        $tmpJoins = array();
        $cols = array();
        $service = new Service();
        array_push($cols, implode(',', $service->getColumns($this, $this->table, $this->table)));
        $count = 2;
        foreach ($this->joins as $join) {
            $colsTmp = $service->getColumns($this, $join->getTableJoin(), $join->getAliasTableJoin());
            array_push($cols, implode(',', $colsTmp));

            array_push($tmpJoins, $join->getJoinMySQL());
            $count++;
        }
        $service->close();
        $joinTable = implode(" ", $tmpJoins);
        $columns = implode(',', $cols);
        $finalCols = array();
        foreach (explode(',', $columns) as $column) {
            array_push($finalCols, $column . " AS \"" . $column . "\"");
        }
        $columns = implode(',', $finalCols);

        $query = "SELECT $columns FROM $this->table $this->table $joinTable WHERE $condition;\n";
        return $query;
    }

    function toPersist() {
        $properties = $this->arrayToString(array_keys($this->fields), FALSE);
        $values = $this->arrayToString(array_values($this->fields));
        $query = "INSERT INTO $this->table ($properties) VALUES ($values);\n";
        return $query;
    }

    function toMerge() {

    }

    function toRemove() {

    }

    function arrayToString($array, $quotes = TRUE) {
        $arr = array();
        $count = 0;
        foreach ($array as $item) {
            $val = NULL;
            if (!is_numeric($item)) {
                if ($quotes) {
                    $val = "'" . $item . "'";
                } else {
                    $val = $item;
                }
            } else {
                $val = $item;
            }
            array_push($arr, $val);
            $count++;
        }
        return implode(',', $arr);
    }

}