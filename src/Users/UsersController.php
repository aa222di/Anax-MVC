<?php

namespace Anax\Users;
 
/**
 * A controller for users and admin related events.
 *
 */
class UsersController extends \Anax\MVC\CControllerBasic
{


    // Properties
    public $users;
/**
 * Initialize the controller.
 *
 * @return void
 */
public function initialize()
{
    $this->users = new \Anax\Users\User();
    $this->users->setDI($this->di);
}

/**
 * List all users.
 *
 * @return void
 */
public function indexAction()
{
    $this->listAction();
}

/**
 * Set up standard table with 2 default users.
 *
 * @return void
 */
public function setupAction()
{
   $this->users->setup();
   $url = $this->url->create('users/list/');
   $this->response->redirect($url);

}

/**
 * List all users.
 *
 * @return void
 */
public function listAction()
{
 
    $all = $this->users->findAll();
 
    $this->theme->setTitle("List all users");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "View all users",
    ]);
}

/**
 * List user with id.
 *
 * @param int $id of user to display
 *
 * @return void
 */
public function idAction($id = null)
{ 
    $user = $this->users->find($id);
 
    $this->theme->setTitle("View user with id");
    $this->views->add('users/list-one', [
        'title' => "View user with id " . $id ,
        'user' => $user,
    ]);
}
 

/**
 * Add new user.
 *
 * @param string $acronym of user to add.
 *
 * @return void
 */
public function addAction($submit = false)
{
     // Get form
    if ($submit == false) {
    $this->dispatcher->forward([
        'controller' => 'form',
        'action'     => 'userAdd',
        'params'     => [],
    ]);
    }
    elseif ($submit == true) {
    $now = date(DATE_RFC2822);
    $res = $this->users->save([
        'acronym'  => $this->form->Value('acronym'),
        'email'    => $this->form->Value('email'),
        'name'     => $this->form->Value('name'),
        'password' => password_hash($this->form->Value('password'), PASSWORD_DEFAULT),
        'created'  => $now,
        'active'   => $now,
    ]);
    if ($res == true) {
        $url = $this->url->create('users/list/');
        $this->form->AddOutput("<p>User with id " . $this->users->id . " was successfully added to the database</p>");
        $this->form->AddOutput("<p><a href='" . $url . "' title='list all users'>List all users</a></p>");
    }
        $this->redirectTo();
    }

}




/**
 * Update user.
 *
 * @param int id user
 *
 * @return void
 */
public function updateAction($id = null, $submit = false)
{
    if (!isset($id)) {
     die("Missing id");
    }
    $user = $this->users->find($id);
      // Get form
    if ($submit == false) {
    $this->dispatcher->forward([
        'controller' => 'form',
        'action'     => 'userUpdate',
        'params'     => [['acronym' => $user->acronym, 'name' => $user->name, 'email' => $user->email, 'id' => $id,],],
    ]);
   }
    elseif ($submit == true) {
    $now = date(DATE_RFC2822);
 
    $res = $this->users->save([
        'updated' => $now,
        'id'      => $id,
        'acronym' => $this->form->Value('acronym'),
        'email'   => $this->form->Value('email'),
        'name'    => $this->form->Value('name'),
    ]);
 
     if ($res == true) {
        $url = $this->url->create('users/list/');
        $this->form->AddOutput("<p>User with id " . $id . " was successfully updated</p>");
        $this->form->AddOutput("<p><a href='" . $url . "' title='list all users'>List all users</a></p>");
    }
        $this->redirectTo();
    }
}

/**
 * Delete user.
 *
 * @param integer $id of user to delete.
 *
 * @return void
 */
public function deleteAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
 
    $res = $this->users->delete($id);
 
    $url = $this->url->create('users/trashcan');
    $this->response->redirect($url);
}

/**
 * Delete (soft) user.
 *
 * @param integer $id of user to delete.
 *
 * @return void
 */
public function softDeleteAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
 
    $now = date(DATE_RFC2822);
 
    $user = $this->users->find($id);
    
    $user->active = null;
    $user->deleted = $now;
    $user->save();
 
    $url = $this->url->create('users/');
    $this->response->redirect($url);
}

/**
 * Reactivate user.
 *
 * @param integer $id of user to reactivate.
 *
 * @return void
 */
public function activateAction($id = null)
{
    if (!isset($id)) {
        die("Missing id");
    }
 
    $now = date(DATE_RFC2822);
 
    $user = $this->users->find($id);
    
    $user->active = $now;
    $user->deleted = null;
    $user->save();
 
    $url = $this->url->create('users/trashcan');
    $this->response->redirect($url);
}

/**
 * List all active and not deleted users.
 *
 * @return void
 */
public function activeAction()
{
    $all = $this->users->query()
        ->where('active IS NOT NULL')
        ->andWhere('deleted is NULL')
        ->execute();
 
    $this->theme->setTitle("Users that are active");
    $this->views->add('users/list-all', [
        'users' => $all,
        'title' => "Users that are active",
    ]);
}


/**
 * List all deleted users.
 *
 * @return void
 */
public function trashcanAction()
{
    $all = $this->users->query()
        ->where('active is NULL')
        ->andWhere('deleted IS NOT NULL')
        ->execute();
 
    $this->theme->setTitle("Users that are deleted");
    $this->views->add('users/trash', [
        'users' => $all,
        'title' => "Users that are deleted",
    ]);
}
}