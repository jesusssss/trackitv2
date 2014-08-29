<?php

namespace Controller {
    class UserController extends BaseController {

        private $user;

        public function getUserById($id) {
            $user = $this->em->find("Model\\User", $id);
            if($user) {
                $this->user = $user;
                return true;
            } else {
                throw new \Exception("Cannot find user with id: ".$id);
            }
        }

        public function getCurrentUser() {
            if($this->sget("user")) {
                $user = $this->em->find("Model\\User", $this->sget("user"));
                return $user;
            } else {
                return false;
            }
        }

        public function logOut() {
            $this->skill("user");
            $this->redirect("/");
        }
    }
}