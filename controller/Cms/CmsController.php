<?php

namespace Controller\Cms {

    use Controller\BaseController;

    class CmsController {

        public function __construct() {

        }

        public function getPage() {
            $url = BaseController::get()->getUrlAndRequests();
            $menu = BaseController::get()->em->getRepository("Model\\Menu\\Menu")->findOneBy(array("link" => $url[0]));
            if($menu) {
                $cms = $menu->getCms();
                BaseController::get()->assign("page", array(
                    "id" => $cms->getId(),
                    "content" => $cms->getContent()
               ));
                return true;
            } else {
                BaseController::get()->assign("page", array(
                    "id" => null,
                    "content" => "404 error - page not found"
                ));
                return false;
            }
        }
    }

}