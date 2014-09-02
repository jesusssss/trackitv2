<?php

namespace Controller\User {
    use Controller\BaseController;
    use Controller\Database\DatabaseController;

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
            $user = $this->em->find("Model\\User\\User", $this->sget("user"));
            print_r($user);
            if($user) {
                return $user;
            } else {
                return null;
            }
        }

        public function logOut() {
            $this->skill("user");
            $this->redirect("/");
        }

        public function login() {
            $username = $this->pget("User-username");
            $password = $this->pget("User-password");

            $user = $this->em->createQuery("SELECT u FROM Model\\User\\User u WHERE u.username = :username AND u.password = :password");
            $user->setParameter("username" , $username);
            $user->setParameter("password", $password);

            $result = $user->getResult();

            if($result) {
                print_r($result);
                $_SESSION["user"] = $result[0]->getId();
                $this->redirect("/");
            } else {
                return false;
            }

        }
    }
}