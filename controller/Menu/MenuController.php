<?php

namespace Controller\Menu {
    use Controller\BaseController;

    class MenuController {

        public function __construct() {

        }

        public function getMenu() {
            $menu = BaseController::get()->em->getRepository("Model\\Menu\\Menu")->findAll();

            $result = array();
            foreach($menu as $point) {
                $result[] = array(
                    "id" => $point->getId(),
                    "link" => $point->getLink(),
                    "title" => $point->getTitle(),
                    "plugin" => $point->getPlugin()
                );
            }

            BaseController::get()->assign("menu", $result);
        }

    }
}