<?php

namespace Controller\Database {

    use Controller\BaseController;
    use \Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;

    class DatabaseController {

        /** @var  $em \Doctrine\ORM\EntityManager */
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

            $result = $domain->getOneOrNullResult();
            $em->getConnection()->close();
            if($result) {
                $this->getRealConnection($result->getDbname(), $result->getDbUser(), $result->getDbpassword());
                $this->theme = $result->getTheme();
            } else {
                $this->theme = "_noTheme";
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
        protected function getRealConnection($dbName, $dbUser, $dbPassword) {
            $paths = array(MODEL);
            $isDevMode = false;

            // the connection configuration
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => $dbUser,
                'password' => $dbPassword,
                'dbname'   => $dbName,
            );

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $this->em = EntityManager::create($dbParams, $config);
        }
    }
}