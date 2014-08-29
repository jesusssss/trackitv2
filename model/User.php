<?php

namespace Model {

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
        protected $time;

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
         * @param mixed $time
         */
        public function setTime($time)
        {
            $this->time = $time;
        }

        /**
         * @return mixed
         */
        public function getTime()
        {
            return $this->time;
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