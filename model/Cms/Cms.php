<?php

namespace Model\Cms {

    /**
     * @Entity @Table(name="Cms")
     **/

    class Cms {

        /** @Id @Column(type="integer") @GeneratedValue **/
        protected $id;

        /** @Column(type="string") **/
        protected $content;

        /** @Column(type="string") **/
        protected $timestamp;

        /**
         * @param mixed $content
         */
        public function setContent($content)
        {
            $this->content = $content;
        }

        /**
         * @return mixed
         */
        public function getContent()
        {
            return $this->content;
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
         * @param mixed $timestamp
         */
        public function setTimestamp($timestamp)
        {
            $this->timestamp = $timestamp;
        }

        /**
         * @return mixed
         */
        public function getTimestamp()
        {
            return $this->timestamp;
        }


    }
}