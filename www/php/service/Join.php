<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

class Join {

    private $table;
    private $alias;
    private $pk;
    private $tableJoin;
    private $aliasTableJoin;
    private $pkTableJoin;
    private $restrict;

    /**
     * Join constructor.
     * @param $table            String
     * @param $tableJoin        String
     * @param $alias            String
     * @param $aliasTableJoin   String
     * @param $pk               String
     * @param $pkTableJoin      String
     * @param $restrict         Boolean
     */
    public function __construct($joinArray) {
        $this->table = $joinArray[ 'entityParent' ];
        $this->tableJoin = $joinArray[ 'entityJoin' ];
        $this->alias = $joinArray[ 'entityParent' ];
        $this->aliasTableJoin = $joinArray[ 'entityJoin' ];
        $this->pk = $joinArray[ 'pkParent' ];
        $this->pkTableJoin = $joinArray[ 'pkJoin' ];
        $this->restrict = $joinArray[ 'restrict' ];
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
    public function getTableJoin() {
        return $this->tableJoin;
    }

    /**
     * @param mixed $tableJoin
     */
    public function setTableJoin($tableJoin) {
        $this->tableJoin = $tableJoin;
    }

    /**
     * @return mixed
     */
    public function getAlias() {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias) {
        $this->alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getAliasTableJoin() {
        return $this->aliasTableJoin;
    }

    /**
     * @param mixed $aliasTableJoin
     */
    public function setAliasTableJoin($aliasTableJoin) {
        $this->aliasTableJoin = $aliasTableJoin;
    }

    /**
     * @return mixed
     */
    public function getPk() {
        return $this->pk;
    }

    /**
     * @param mixed $pk
     */
    public function setPk($pk) {
        $this->pk = $pk;
    }

    /**
     * @return mixed
     */
    public function getPkTableJoin() {
        return $this->pkTableJoin;
    }

    /**
     * @param mixed $pkTableJoin
     */
    public function setPkTableJoin($pkTableJoin) {
        $this->pkTableJoin = $pkTableJoin;
    }

    /**
     * @return boolean
     */
    public function getRestrict() {
        return $this->restrict;
    }

    /**
     * @param boolean $restrict
     */
    public function setRestrict($restrict) {
        $this->restrict = $restrict;
    }

    function getJoinMySQL() {
        $condition = "LEFT JOIN";
        if ($this->restrict) {
            $condition = "INNER JOIN";
        }
        $condition .= " $this->tableJoin $this->aliasTableJoin";
        $condition .= " ON $this->alias.$this->pk = $this->aliasTableJoin.$this->pkTableJoin";
        return $condition;
    }
}