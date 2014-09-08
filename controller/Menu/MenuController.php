<?php

namespace Controller\Menu {
    use Controller\BaseController;
    use Model\Menu\Menu;

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

        public function create() {
            $title = BaseController::get()->pget("Menu-pageTitle");
            $link  = BaseController::get()->pget("Menu-pageLink");

            $exists = BaseController::get()->em->getRepository("Model\\Menu\\Menu")->findOneBy(array("link" => $link));
            if($exists) {
                BaseController::get()->assign("config", array("msg" => "Page allready exists"), true);
            } else {
                $menu = new Menu();
                $menu->setTitle($title);
                $menu->setLink($link);
                $menu->setPlugin("Cms");

                BaseController::get()->em->persist($menu);
                BaseController::get()->em->flush();

                BaseController::get()->assign("config", array("msg" => "Page has been created"), true);
            }
        }

    }
}