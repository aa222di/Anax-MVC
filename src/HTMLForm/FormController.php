<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class FormController
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Index action.
     *
     */
    public function indexAction()
    {
        $this->di->session(); // Will load the session service which also starts the session

        $form = $this->di->form->create([], [
            'name' => [
                'type'        => 'text',
                'label'       => 'Name of contact person:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'email' => [
                'type'        => 'text',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'phone' => [
                'type'        => 'text',
                'required'    => true,
                'validation'  => ['not_empty', 'numeric'],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmit'],
            ],
            'submit-fail' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmitFail'],
            ],
        ]);


     

        $this->di->theme->setTitle("Testing CForm with Anax");
        $this->di->views->add('default/page', [
            'title' => "Try out a form using CForm",
            'content' => $form->getHTML()
        ]);
    }

    /**
     * Form for adding user.
     *
     */
    public function userAddAction()
    {
      
        
        $form = $this->di->form->create([], [
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Username', 
                'required'    => true,
                'validation'  => ['not_empty',],
             
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Namn',  
                'required'    => true,
                'validation'  => ['not_empty',],
         
            ],
            'email' => [
                'type'        => 'text',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
       
            ],
            'password' => [
                'type'        => 'password',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
            'password-repeat' => [
                'type'        => 'password',
                'required'    => true,
                'validation'  => ['not_empty', 'match'=> 'password',],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmitUser'],
            ],
            'submit-fail' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmitFail'],
            ],
        ]);


           // Check the status of the form
        $form->check([$this, 'callbackSuccess'], [$this, 'callbackFail']);

        $this->di->theme->setTitle("Add new user");
        $this->di->views->add('me/page', [
            'content' => '<h1>Add new user</h1>' . $form->getHTML()
        ]);
    }

    /**
     * Form for editing user.
     * @param $values array
     *
     */
    public function userUpdateAction($values = [])
    {
        $default = [
        'acronym' => null,
        'name'    => null,
        'email'   => null,
        'id'      => null,  
        ];
        $values = array_merge($default, $values);
        
        $form = $this->di->form->create([], [
            'acronym' => [
                'type'        => 'text',
                'label'       => 'Username', 
                'required'    => true,
                'validation'  => ['not_empty',],
                'value'       => $values['acronym'],  
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Namn',  
                'required'    => true,
                'validation'  => ['not_empty',],
                'value'       => $values['name'], 
            ],
            'email' => [
                'type'        => 'text',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
                'value'       => $values['email'], 
            ],
              'id' => [
                'type'        => 'hidden',
                'value'       => $values['id'], 
            ],
    
            'submit' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmitUserEdit'],
            ],
            'submit-fail' => [
                'type'      => 'submit',
                'callback'  => [$this, 'callbackSubmitFail'],
            ],
        ]);


           // Check the status of the form
        $form->check([$this, 'callbackSuccess'], [$this, 'callbackFail']);

        $this->di->theme->setTitle("Update user with id " . $form->Value('id'));
        $this->di->views->add('me/page', [
            'content' => "<h1>Update user with id " . $form->Value('id') . "</h1>" . $form->getHTML(),
        ]);
    }


    /**
     * Form for commenting
     *
     */
    public function commentAction($values = [], $edit = false)
    {


        $default = [
        'web'          => null,
        'name'         => null,
        'email'        => null,
        'comment'      => null,  
        'id'           => null, 
        ];
        $values = array_merge($default, $values);
        $callback = $edit ? 'callbackSubmitCommentUpdate' : 'callbackSubmitComment';
        
        $form = $this->di->form->create(['class' => 'comment-form'], [
            'comment' => [
                'type'        => 'textarea',
                'label'       => 'Comment', 
                'required'    => true,
                'validation'  => ['not_empty',],
                'value'       => $values['comment'], 
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Name', 
                'required'    => true,
                'validation'  => ['not_empty',],
                'value'       => $values['name'], 
            ],
            'web' => [
                'type'        => 'text',
                'label'       => 'Website',  
                'required'    => true,
                'validation'  => ['not_empty',],
                'value'       => $values['web'], 
            ],
            'email' => [
                'type'        => 'text',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
                'value'       => $values['email'], 
            ],
            'pageId' => [
                'type'        => 'hidden',
                'value'       => $this->di->request->getCurrentUrl(), 
            ],
            'id' => [
                'type'        => 'hidden',
                'value'       => $values['id'], 
            ],
    
            'submit' => [
                'type'      => 'submit',
                'callback'  => [$this, $callback],
            ],
        ]);

           // Check the status of the form
        $form->check([$this, 'callbackSuccess'], [$this, 'callbackFail']);

        
        $this->di->views->add('me/page', [
            'content' =>  $form->getHTML(),
        ]);
    }


 /**
     * Callback for submit-button for adding user.
     *
     */
    public function callbackSubmitComment($form)
    {
        $form->saveInSession = true;

        $this->di->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'add',
        'params'     => [true,],
    ]);
    }

     /**
     * Callback for submit-button for adding user.
     *
     */
    public function callbackSubmitCommentUpdate($form)
    {
        $form->saveInSession = true;

        $this->di->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'update',
        'params'     => [$form->Value('id'), true,],
    ]);
    }

    /**
     * Callback for submit-button for editing user.
     *
     */
    public function callbackSubmitUserEdit($form)
    {
        $form->saveInSession = true;

        $this->di->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'update',
        'params'     => [$form->Value('id'), true,],
    ]);
    }

    /**
     * Callback for submit-button for adding user.
     *
     */
    public function callbackSubmitUser($form)
    {
        $form->saveInSession = true;

        $this->di->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'add',
        'params'     => [true,],
    ]);
    }

    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmit($form)
    {
        $form->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
        $form->AddOutput("<p><b>Name: " . $form->Value('name') . "</b></p>");
        $form->AddOutput("<p><b>Email: " . $form->Value('email') . "</b></p>");
        $form->AddOutput("<p><b>Phone: " . $form->Value('phone') . "</b></p>");
        $form->saveInSession = true;

        $this->di->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'add',
        'params'     => [true,],
    ]);

    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail($form)
    {
        $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
        return false;
    }



    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess($form)
    {
        $form->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $this->redirectTo();
    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail($form)
    {
        $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
        $this->redirectTo();
    }
}
