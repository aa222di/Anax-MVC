<?php
namespace Anax\Users;
 
/**
 * Model for Users.
 *
 */
class User extends \Anax\MVC\CDatabaseModel
{

 /**
 * Setup table for users.
 *
 * @return boolean true or false if saving went okey.
 */
public function setup()
{
	$this->db->dropTableIfExists('user')->execute();
    $this->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime'],
            'active' => ['datetime'],
        ]
    )->execute();

    // Insert two default users
    $now = date(DATE_RFC2822);

    $this->create([
        'acronym' => 'admin',
        'email' => 'admin@dbwebb.se',
        'name' => 'Administrator',
        'password' => password_hash('admin', PASSWORD_DEFAULT),
        'created' => $now,
        'active' => $now,
    ]);

    $this->create([
        'acronym' => 'doe',
        'email' => 'doe@dbwebb.se',
        'name' => 'John/Jane Doe',
        'password' => password_hash('doe', PASSWORD_DEFAULT),
        'created' => $now,
        'active' => $now,
    ]);

}
}