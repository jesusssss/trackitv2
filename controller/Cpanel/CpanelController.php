<?php

namespace Controller\Cpanel {

    use Controller\BaseController;

    class CpanelController {

        public function render($page) {
            BaseController::get()->render($page);
        }

        public function getDomains() {
            $domains = BaseController::get()->em->createQuery("SELECT d FROM Model\\Domains\\Domains d");
            $result = $domains->getResult();

            if($result) {
                $return = array();
                foreach($result as $r) {
                    $return["domains"][] = array(
                        "id" => $r->getId(),
                        "uri" => $r->getUri(),
                        "dbname" => $r->getDbname(),
                        "theme" => $r->getTheme()
                    );
                }
                BaseController::get()->assign("domains", $return, true);
            } else {
                BaseController::get()->assign("config", array("msg" => "No Domain Was Found"), true);
            }
        }

        public function countDomains() {
            $domains = BaseController::get()->em->createQuery("SELECT COUNT(d) FROM Model\\Domains\\Domains d");
            $result = $domains->getSingleScalarResult();

            $return["total"] = $result;
            BaseController::get()->assign("domains", $return, true);
            return true;
        }

        public function createDomain() {
            $domainName         = BaseController::get()->pget("Domain-domainName");
            $domainDatabase     = BaseController::get()->pget("Domain-database");
            $databaseUser       = BaseController::get()->pget("Domain-databaseUser");
            $databasePassword   = BaseController::get()->pget("Domain-databasePassword");
            $databaseCopy       = BaseController::get()->pget("Domain-databaseCopy");
            $domainTheme        = BaseController::get()->pget("Domain-theme");

            $domain = new \Model\Domains\Domains();
            $domain->setUri($domainName);
            $domain->setDbname($domainDatabase);
            $domain->setDbpassword($databasePassword);
            $domain->setTheme($domainTheme);
            $domain->setDbuser($databaseUser);

            $this->createDatabase($databaseUser, $databasePassword ,$domainDatabase, $databaseCopy);

            BaseController::get()->em->persist($domain);
            BaseController::get()->em->flush();
            BaseController::get()->assign("config", array("msg" => "Domain has been created with success"), true);
        }

        public function deleteDomain() {
            $domainId = BaseController::get()->pget("id");

            $domain = BaseController::get()->em->find("Model\\Domains\\Domains", $domainId);
            $dataBase = $domain->getDbname();
            BaseController::get()->em->remove($domain);
            BaseController::get()->em->flush();

           if(!empty($dataBase)) {
                $this->deleteDatabase($dataBase);
           }

            BaseController::get()->redirect("/domains");
        }

        public function createDatabase($dbUser, $dbPass, $new, $copy) {

            $host = "localhost";

            $root = "root";
            $root_password = "1000koder";

            $templateFile = LIBS."sql/template_file.sql";

            $user = $dbUser;
            $pass = $dbPass;
            $db = $new;

            try {
                $dbh = new \PDO("mysql:host=$host", $root, $root_password);

                $dbh->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
                or die(print_r($dbh->errorInfo(), true));

            } catch (\PDOException $e) {
                die("DB ERROR: ". $e->getMessage());
            }

            $command="mysql -h {$host} -u '{$dbUser}' -p'{$dbPass}' '{$new}' < '{$templateFile}'";
            $output = shell_exec($command);

        }

        public function deleteDatabase($dbName) {
            //TODO Make this delete the database from $dbname as name
        }

    }

}