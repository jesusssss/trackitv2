<?php

namespace Model\Menu {

    use Model\Cms\Cms;

    /**
     * @Entity @Table(name="Menu")
     **/

    class Menu {

        /** @Id @Column(type="integer") @GeneratedValue **/
        protected $id;

        /** @Column(type="integer") **/
        protected $cmsId;

        /** @Column(type="string") **/
        protected $link;

        /** @Column(type="string") **/
        protected $title;

        /** @Column(type="string") **/
        protected $plugin;


        /** @OneToOne(targetEntity="Model\Cms\Cms")
         * @JoinColumn(name="cmsId", referencedColumnName="id")
         **/
        protected $cms;

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
         * @param mixed $cmsId
         */
        public function setCmsId($cmsId)
        {
            $this->cmsId = $cmsId;
        }

        /**
         * @return mixed
         */
        public function getCmsId()
        {
            return $this->cmsId;
        }

        /**
         * @param mixed $cms
         */
        public function setCms(Cms $cms)
        {
            $this->cms = $cms;
        }

        /**
         * @return mixed
         */
        public function getCms()
        {
            return $this->cms;
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