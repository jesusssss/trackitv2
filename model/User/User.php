<?php

namespace Model\User {

    /**
     * @Entity @Table(name="Users")
     **/

    class User {

        /** @Id @Column(type="integer") @GeneratedValue **/
        protected $id;

        /** @Column(type="string") **/
        protected $username;

        /** @Column(type="string") **/
        protected $password;

        /** @Column(type="string") **/
        protected $firstname;

        /** @Column(type="string") **/
        protected $lastname;

        /** @Column(type="string") **/
        protected $email;

        /** @Column(type="integer") **/
        protected $admin;

        /**
         * @param mixed $admin
         */
        public function setAdmin($admin)
        {
            $this->admin = $admin;
        }

        /**
         * @return mixed
         */
        public function getAdmin()
        {
            return $this->admin;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $firstname
         */
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;
        }

        /**
         * @return mixed
         */
        public function getFirstname()
        {
            return $this->firstname;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $lastname
         */
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
        }

        /**
         * @return mixed
         */
        public function getLastname()
        {
            return $this->lastname;
        }

        /**
         * @param mixed $password
         */
        public function setPassword($password)
        {
            $this->password = $password;
        }

        /**
         * @return mixed
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * @param mixed $username
         */
        public function setUsername($username)
        {
            $this->username = $username;
        }

        /**
         * @return mixed
         */
        public function getUsername()
        {
            return $this->username;
        }



    }
}