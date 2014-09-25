<?php
require __DIR__.'/config_with_app.php'; 
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Get better links
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Set comment controller
$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});



// Get pages
 
$app->router->add('', function() use ($app) {
     $app->theme->addStylesheet('css/comments.css');
     $app->theme->addJavaScript('js/toggle.js');

     $app->theme->setTitle("Om Amanda");

     // Get content
     $content = $app->fileContent->get('me.md');
     $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    // Set byline
    $byline  = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

     // Inject content
     $app->views->add('me/page', [
        'content'   => $content,
        'byline'    => $byline,
    ]);

    // Include comments
    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
        'params'     => ['',],
    ]);
 
});
 
$app->router->add('report', function() use ($app) {
    $app->theme->addStylesheet('css/comments.css');
    $app->theme->addJavaScript('js/toggle.js');
    $app->theme->setTitle("Redovisning");

    // Get content
    $content = $app->fileContent->get('report.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    // Set byline
    $byline  = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    // Inject content together with view
    $app->views->add('me/page', [
        'content'   => $content,
        'byline'    => $byline,
    ]);
 
       $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
        'params'     => ['report',],
    ]);

});
 
$app->router->add('source', function() use ($app) {
 
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
 
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);
 
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
 
});

$app->router->add('dice', function() use ($app) {
 
    
    $app->theme->setTitle("Dice");
 
    $app->views->add('dice/index');
 
});


 
// Route to roll dice and show results
$app->router->add('dice/roll', function() use ($app) {

    $app->theme->addStylesheet('css/dice.css');

     // Check how many rolls to do
    $roll = $app->request->getGet('roll', 1);
    $app->validate->check($roll, ['int', 'range' => [1, 100]])
        or die("Roll out of bounds");
 
    // Make roll and prepare reply
    $dice = new \Mos\Dice\CDice();
    $dice->roll($roll);
 
    $app->views->add('dice/index', [
        'roll'      => $dice->getNumOfRolls(),
        'results'   => $dice->getResults(),
        'total'     => $dice->getTotal(),
    ]);
 
    $app->theme->setTitle("Rolled a dice");
 
});

$app->router->add('dicegame', function() use ($app) {
    
    $gameboard = new \eden\Gameboard\CGameboard(1);

    $reset = $app->request->getPost('reset');

    if($reset){
     unset($_SESSION['CGame']);
    }
    if(!$app->session->has('CGame')){
      $app->session->set('CGame', $gameboard);
    }

    $gameboard = $app->session->get('CGame')->getGameboard();

    $app->theme->addStylesheet('css/dicegame.css');
    $app->theme->setTitle("Dicegame");

    
      $app->views->add('dice/game', [
        'gameboard' => $gameboard,
    ]);

   
 
});

$app->router->add('calendar', function() use ($app) {
    
    $cal = new \eden\Calendar\CCalendar();

    $app->theme->addStylesheet('css/calendar.css');
    $app->theme->setTitle("Kalender");

    
      $app->views->add('calendar/calendar', [
        'calendar' => $cal->getCalendar(),
    ]);

   
 
});

$app->router->handle();
$app->theme->render();