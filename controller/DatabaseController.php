<?php

namespace Controller {

    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;

    class DatabaseController {

        public $em;

        public function __construct() {
            $paths = array(MODEL);
            $isDevMode = false;

            // the connection configuration
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => 'root',
                'password' => '1000koder',
                'dbname'   => 'trackit',
            );

            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $this->em = EntityManager::create($dbParams, $config);
        }
    }
}