<?php
require __DIR__.'/config_with_app.php'; 
$app->theme->configure(ANAX_APP_PATH . 'config/theme_eden.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Set link style
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
     $app->theme->setVariable('themeclass','example');


    // Lorem ipsum
    $lorem  = $app->fileContent->get('loremipsum.md');
    $lorem = $app->textFilter->doFilter($lorem, 'shortcode, markdown');

   

    $app->views->addString('<img src="img/blue.jpg">', 'flash')
               ->addString('<i class="fa fa-camera-retro fa-5x"></i>', 'featured-1')
               ->addString('<i class="fa fa-bug fa-5x"></i>', 'featured-2')
               ->addString('<i class="fa fa-leaf fa-5x"></i>', 'featured-3')
               ->addString('<h1>Lorem ipsum dolor sit amet</hi>', 'flash-2')
               ->addString('<article>' . $lorem . '</article>', 'triptych-1')
               ->addString('<article>' . $lorem . '</article>', 'triptych-2')
               ->addString('<article>' . $lorem . '</article>', 'triptych-3')
               ->addString('<i class="fa fa-heart fa-1x"></i>', 'footer');

});
 

$app->router->handle();
$app->theme->render();