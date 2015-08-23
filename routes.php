<?php

$router->map('GET', '/', 'Acme\Controllers\PageController@getShowHomePage', 'home');

$router->map('GET', '/register', 'Acme\Controllers\RegisterController@getShowRegisterPage', 'register');

$router->map('POST', '/register', 'Acme\Controllers\RegisterController@postShowRegisterPage', 'register_post');

$router->map('GET', '/login', 'Acme\Controllers\RegisterController@getShowLoginPage', 'login');

$router->map('GET', '/slug', function(){
    $slug = new Cocur\Slugify\Slugify();
    echo $slug->slugify('About Acme');
});

$router->map('GET', '/[*]', 'Acme\Controllers\PageController@getShowPage', 'generic_page');
