<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Me-sidan',   
            'url'   => '',  
            'title' => 'Me-sidan'
        ],
 
        // This is a menu item
        'report'  => [
            'text'  => 'Redovisning',   
            'url'   => 'report',   
            'title' => 'Redovisningar',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'Kmom01'  => [
                        'text'  => 'Kmom01',   
                        'url'   => 'report#1',  
                        'title' => 'Kmom01'
                    ],
                ],
            ],
        ],
 
        // This is a menu item
        'source' => [
            'text'  =>'Källkod', 
            'url'   =>'source',  
            'title' => 'Se Källkoden'
        ],
        // This is a menu item
        'dice' => [
            'text'  =>'Dice', 
            'url'   =>'dice',  
            'title' => 'Roll the dice',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'dicegame'  => [
                        'text'  => 'Dicegame',   
                        'url'   => 'dicegame',  
                        'title' => 'Play the dicegame'
                    ],
                ],
            ],
        ],

           // This is a menu item
        'calendar' => [
            'text'  =>'Kalender', 
            'url'   =>'calendar',  
            'title' => 'Se kalendern från kursen oophp'
        ],
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },

    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
];
