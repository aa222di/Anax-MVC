<?php
require __DIR__.'/config_with_app.php'; 
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Set link style
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);





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
        'params'     => [],
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
        'params'     => [],
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

$app->router->add('theme', function() use ($app) {
    $app->theme->configure(ANAX_APP_PATH . 'config/theme_eden.php');
     $app->theme->addStylesheet('css/eden/style.php');
     $app->theme->addJavaScript('js/menu.js');

     $app->theme->setTitle("Eden debug");
     $app->theme->setVariable('themeclass','debug');


    // Lorem ipsum
    $lorem  = $app->fileContent->get('loremipsum.md');
    $lorem = $app->textFilter->doFilter($lorem, 'shortcode, markdown');

   

    $app->views->addString('<p>Flash 1</p>', 'flash')
               ->addString('<p>featured-1</p>', 'featured-1')
               ->addString('<p>featured-2</p>', 'featured-2')
               ->addString('<p>featured-3</p>', 'featured-3')
               ->addString('<p>Flash 2</p>', 'flash-2')
               ->addString('<p>main</p>', 'main')
               ->addString('<p>sidebar</p>', 'sidebar')
               ->addString('<p>triptych-1</p>', 'triptych-1')
               ->addString('<p>triptych-2</p>', 'triptych-2')
               ->addString('<p>triptych-3</p>', 'triptych-3')
               ->addString('<p>Flash 3</p>', 'flash-3')
               ->addString('Footer', 'footer');

});

$app->router->add('theme/example', function() use ($app) {
    $app->theme->configure(ANAX_APP_PATH . 'config/theme_eden.php');
     $app->theme->addStylesheet('css/eden/style.php');
     $app->theme->addJavaScript('js/menu.js');

     $app->theme->setTitle("Eden example");
     $app->theme->setVariable('themeclass','example');


    // Lorem ipsum
    $lorem  = $app->fileContent->get('loremipsum.md');
    $lorem = $app->textFilter->doFilter($lorem, 'shortcode, markdown');

   

    $app->views->addString('<img src="../img/blue.jpg">', 'flash')
               ->addString('<i class="fa fa-camera-retro fa-5x"></i>', 'featured-1')
               ->addString('<i class="fa fa-bug fa-5x"></i>', 'featured-2')
               ->addString('<i class="fa fa-leaf fa-5x"></i>', 'featured-3')
               ->addString('<h1>Lorem ipsum dolor sit amet</hi>', 'flash-2')
               ->addString('<article>' . $lorem . '</article>', 'triptych-1')
               ->addString('<article>' . $lorem . '</article>', 'triptych-2')
               ->addString('<article>' . $lorem . '</article>', 'triptych-3')
               ->addString('<i class="fa fa-heart fa-1x"></i>', 'footer');

});


// Route to roll dice and show results



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
    
    $cal = new \eden\Calendar\CCalendar($app);

    $app->theme->addStylesheet('css/calendar.css');
    $app->theme->setTitle("Kalender");

    
      $app->views->add('calendar/calendar', [
        'calendar' => $cal->getCalendar(),
    ]);

   
 
});

$app->router->handle();
$app->theme->render();
echo $app->logger->renderLog();