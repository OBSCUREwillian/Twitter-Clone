<?php
    namespace MF\Controller;
    abstract class Action {

        protected $view;

        public function __construct() {
            $this->view = new \stdClass();
        }

        protected function render($view, $layout) {
            $this->view->page = $view;

            if(file_exists("../App/Views/". $layout .".phtml") ){
                require_once "../App/Views/". $layout .".phtml";

            }else {
                $this->content();
            }
    
        }

        protected function content() {
            $nomeClass = get_class($this);
            $nomeClass = str_replace('App\\Controllers\\', '', $nomeClass);
            $nomeClass = strtolower(str_replace('Controller', '', $nomeClass));
    
            require_once "../App/Views/". $nomeClass ."/". $this->view->page .".phtml";
        }
    }

?>