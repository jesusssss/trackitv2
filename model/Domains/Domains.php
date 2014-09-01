<?php

namespace Model\Domains {

    /**
     * @Entity @Table(name="domains")
     **/

    class Domains {

        /** @Id @Column(type="integer") @GeneratedValue **/
        protected $id;

        /** @Column(type="string") **/
        protected $uri;

        /** @Column(type="string") **/
        protected $dbname;

        /** @Column(type="string") **/
        protected $dbpassword;

        /** @Column(type="string") **/
        protected $theme;

        /**
         * @param mixed $dbname
         */
        public function setDbname($dbname)
        {
            $this->dbname = $dbname;
        }

        /**
         * @return mixed
         */
        public function getDbname()
        {
            return $this->dbname;
        }

        /**
         * @param mixed $dbpassword
         */
        public function setDbpassword($dbpassword)
        {
            $this->dbpassword = $dbpassword;
        }

        /**
         * @return mixed
         */
        public function getDbpassword()
        {
            return $this->dbpassword;
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
         * @param mixed $uri
         */
        public function setUri($uri)
        {
            $this->uri = $uri;
        }

        /**
         * @return mixed
         */
        public function getUri()
        {
            return $this->uri;
        }

        /**
         * @param mixed $theme
         */
        public function setTheme($theme)
        {
            $this->theme = $theme;
        }

        /**
         * @return mixed
         */
        public function getTheme()
        {
            return $this->theme;
        }
    }
}