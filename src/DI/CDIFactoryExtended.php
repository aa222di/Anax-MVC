<?php

namespace Anax\DI;

/**
 * Anax base class implementing Dependency Injection / Service Locator 
 * of the services used by the framework, using lazy loading.
 *
 */
class CDIFactoryExtended extends CDIFactoryDefault
{
	/**
     * Construct.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->setShared('db', function() {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
            $db->connect();
            return $db;
        });

         $this->setShared('form', function () {
            $form = new \Mos\HTMLForm\CForm();
            $this->session;
            //$form->saveInSession = true;
            return $form;
        });

         // Set controllers
        $this->set('CommentController', function() {
            $controller = new \Phpmvc\Comment\CommentController();
            $controller->setDI($this);
            return $controller;
        });
        $this->set('UsersController', function() {
            $controller = new \Anax\Users\UsersController();
            $controller->setDI($this);
            return $controller;
        });
        $this->set('FormController', function() {
            $controller = new \Anax\HTMLForm\FormController();
            $controller->setDI($this);
            return $controller;
        });

        $this->set('logger', function() {
            $logger = new \Eden\Log\Clog();
            //$controller->setDI($logger);
            return $logger;
        });
    }

}