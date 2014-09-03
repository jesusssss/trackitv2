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
                    $return[] = array(
                        "id" => $r->getId(),
                        "uri" => $r->getUri(),
                        "dbname" => $r->getDbname()
                    );
                }
                BaseController::get()->assign("domains", $return);
            } else {
                BaseController::get()->assign("error",
                    array("msg" => "No Domain Was Found")
                );
            }
        }

    }

}