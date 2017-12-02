<?php
    define('DB_PATH', $_SERVER['DOCUMENT_ROOT'] . '/idCardApp/database/idcards.db');
    class connectDB{
        private static $instance=null;
        private $dbh;
        private $db_path=DB_PATH;

        private function __construct()
        {
            $this->dbh = new PDO('sqlite:' . $this->db_path);
            $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public static function getInstance(){
            if(!self::$instance){
                self::$instance = new connectDB();
            }
            return self::$instance;
        }

        public function getConnection(){
            return $this->dbh;
        }

    }
?>