<?php

namespace Controller\Menu {
    use Controller\BaseController;
    use Model\Cms\Cms;
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

                $cms = new Cms();

                $menu = new Menu();
                $menu->setTitle($title);
                $menu->setLink($link);
                $menu->setPlugin("Cms");
                $menu->setCms($cms);




                BaseController::get()->em->persist($menu);
                BaseController::get()->em->persist($cms);
                BaseController::get()->em->flush();

                BaseController::get()->assign("config", array("msg" => "Page has been created"), true);
            }
        }

        public function delete() {
            $id = BaseController::get()->pget("id");

            $menu = BaseController::get()->em->find("Model\\Menu\\Menu", $id);
            $cms = $menu->getCms();

            BaseController::get()->em->remove($menu);
            BaseController::get()->em->remove($cms);

            BaseController::get()->em->flush();

            BaseController::get()->redirect("/admin/pages");

        }

        public function edit() {
            return true;
        }

    }
}