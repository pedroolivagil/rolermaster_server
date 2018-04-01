<?php
/**
 * Created by PhpStorm.
 * User: 0013856
 * Date: 05/02/2018
 * Time: 13:43
 */

abstract class DBManager {

    private $connection;
    private $problems;
    private $transaction;
    private $errorInfo;

    public function close() {
        if ($this->transaction && $this->problems == 0) {
            $this->commit();
        }
        $this->connection = NULL;
    }

    public function initialize($transactions = FALSE) {
        $this->transaction = $transactions;
        $this->problems = 0;
        try {
            $this->connection = NULL;
            $this->problems = 0;
            // Conectar
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DB, DB_USER, DB_PASSWORD, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';" ));
            // Establecer el nivel de errores a EXCEPTION
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->addProblem();
            error_log($e->getMessage());
        }
    }

    public function getProblems() {
        return $this->problems;
    }

    private function addProblem() {
        $this->problems++;
    }

    private function checkTransaction() {
        return $this->transaction === TRUE && !$this->connection->inTransaction();
    }

    private function check() {
        $retorno = FALSE;
        try {
            $retorno = $this->connection->query('SELECT 1;');
        } catch (PDOException $e) {
            $this->initialize();
        }
        return $retorno;
    }

    private function begin() {
        $retorno = FALSE;
        if ($this->check()) {
            try {
                if (!$this->checkTransaction()) {
                    $retorno = $this->connection->beginTransaction();
                } else {
                    $retorno = $this->connection->inTransaction();
                }
            } catch (PDOException $e) {
                $this->rollBack($e);
            }
        }
        return $retorno;
    }

    private function rollBack(PDOException $e = NULL) {
        $retorno = FALSE;
        $this->addProblem();
        if ($this->check()) {
            try {
                if ($e != NULL) {
                    error_log($e->getMessage());
                }
                $this->errorInfo = $this->connection->errorInfo();
                if ($this->transaction === TRUE && $this->connection->inTransaction()) {
                    $retorno = $this->connection->rollBack();
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
            }
        }
        return $retorno;
    }

    public function commit() {
        $retorno = FALSE;
        if ($this->check()) {
            try {
                if ($this->connection->inTransaction()) {
                    $retorno = $this->connection->commit();
                }
            } catch (PDOException $e) {
                $this->rollBack($e);
            }
        }
        return $retorno;
    }

    public function fetch($query = NULL) {
        $retorno = NULL;
        $this->begin();
        try {
            if ($query != NULL) {
                $sentencia = $this->connection->prepare($query);
                $sentencia->execute();
                $retorno = json_encode($sentencia->fetch(PDO::FETCH_ASSOC));
            } else {
                throw new PDOException("Query is null");
            }
        } catch (PDOException $e) {
            $this->rollBack($e);
        }
        $this->errorInfo = $this->connection->errorInfo();
        return $retorno;
    }

    public function fetchAll($query = NULL) {
        $retorno = NULL;
        $this->begin();
        try {
            if ($query != NULL) {
                $sentencia = $this->connection->prepare($query);
                $sentencia->execute();
                $retorno = json_encode($sentencia->fetchAll(PDO::FETCH_ASSOC));
            } else {
                throw new PDOException("Query is null");
            }
        } catch (PDOException $e) {
            $this->rollBack($e);
        }
        $this->errorInfo = $this->connection->errorInfo();
        return $retorno;
    }

    public function execute($query) {
        $retorno = FALSE;
        $this->begin();
        try {
            if ($query != NULL) {
                $sentencia = $this->connection->prepare($query);
                $sentencia->execute();
                $retorno = TRUE;
            } else {
                throw new PDOException("Query is null");
            }
        } catch (PDOException $e) {
            $this->rollBack($e);
        }
        $this->errorInfo = $this->connection->errorInfo();
        return $retorno;
    }

    public function logger($action = "", $coment = "", $user = "") {
        try {
            $sentencia = $this->connection->prepare("INSERT INTO " . TABLE_ERROR_LOG . "(accion, id_usuario, comentario) VALUES('$action','$user','$coment');");
            $sentencia->execute();
        } catch (PDOException $e) {
            $this->addProblem();
            error_log($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getErrorInfo() {
        return $this->errorInfo;
    }
}