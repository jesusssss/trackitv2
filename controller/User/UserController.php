<?php

namespace Controller\User {
    use Controller\BaseController;
    use Controller\Database\DatabaseController;

    class UserController {

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
            $user = $this->em->find("Model\\User\\User", $this->sget("user"));
            print_r($user);
            if($user) {
                return $user;
            } else {
                return null;
            }
        }

        public function logOut() {
            BaseController::get()->skill("user");
            BaseController::get()->redirect("/");
        }

        public function login() {
            $username = BaseController::get()->pget("User-username");
            $password = BaseController::get()->pget("User-password");

            //TODO - der kan logges ind kun med password
            $user = BaseController::get()->em->createQuery("SELECT u FROM Model\\User\\User u WHERE u.username = :username AND u.password = :password");
            $user->setParameters(array(
                "username" => $username,
                "password" => $password
            ));

            $result = $user->getSingleResult();


            if($result) {
                $_SESSION["user"] = $result->getId();
                BaseController::get()->redirect("/");
            } else {
                BaseController::get()->assign(
                    "error",
                    array(
                        "msg" => "Wrong information, please try again:"
                    )
                );
                return false;
            }
        }
    }
}