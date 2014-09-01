<?php

namespace Controller\Database {

    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;

    class DatabaseController {

        public $em;
        public $theme;
        public static $instance;

        private function __construct() {
            $paths = array(MODEL);
            $isDevMode = false;

            // the connection configuration
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => 'root',
                'password' => '1000koder',
                'dbname'   => 'baademedia_global',
            );

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $em = EntityManager::create($dbParams, $config);

            $domain = $em->createQuery("SELECT u FROM Model\\Domains\\Domains u WHERE u.uri = :uri");
            $domain->setParameter("uri", $_SERVER["SERVER_NAME"]);

            $result = $domain->getResult();

            if($result) {
                $this->getRealConnection($result[0]->getDbname());
                $this->theme = $result[0]->getTheme();
                $em->getConnection()->close();
            } else {
                $this->getRealConnection("null");
                $em->getConnection()->close();
            }


        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new DatabaseController();
            }
            return self::$instance;
        }


        /**
         * This function actually connects to the correct database after the __construct function
         * is finished figuring out what DB to access, from the URI params.
         * @param $dbName
         */
        protected function getRealConnection($dbName) {
            $paths = array(MODEL);
            $isDevMode = false;

            // the connection configuration
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => 'root',
                'password' => '1000koder',
                'dbname'   => $dbName,
            );

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $this->em = EntityManager::create($dbParams, $config);
        }
    }
}