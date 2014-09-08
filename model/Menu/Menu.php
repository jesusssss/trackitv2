<?php

namespace Model\Menu {

    use Model\Cms\Cms;

    /**
     * @Entity @Table(name="Menu")
     **/

    class Menu {

        /** @OneToOne(targetEntity="Model\Cms\Cms")
         * @JoinColumn(name="id", referencedColumnName="selfref")
         **/
        protected $cms;

        /** @Id @Column(type="integer") @GeneratedValue **/
        protected $id;

        /** @Column(type="string") **/
        protected $link;

        /** @Column(type="string") **/
        protected $title;

        /** @Column(type="string") **/
        protected $plugin;

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
         * @param mixed $link
         */
        public function setLink($link)
        {
            $this->link = $link;
        }

        /**
         * @param mixed $title
         */
        public function setTitle($title)
        {
            $this->title = $title;
        }

        /**
         * @return mixed
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @return mixed
         */
        public function getLink()
        {
            return $this->link;
        }

        /**
         * @param mixed $plugin
         */
        public function setPlugin($plugin)
        {
            $this->plugin = $plugin;
        }

        /**
         * @return mixed
         */
        public function getPlugin()
        {
            return $this->plugin;
        }


    }
}