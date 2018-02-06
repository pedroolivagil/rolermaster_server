<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

require_once('DBConstants.php');
require_once('Query.php');
require_once('DBManager.php');

/*require_once('');*/

class Service extends DBManager {

    /**
     * Service constructor.
     * @param bool $transaction
     */
    public function __construct($transaction = FALSE) {
        parent::__construct($transaction);
    }
}