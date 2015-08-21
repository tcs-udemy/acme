<?php
namespace Acme\controllers;

use duncan3dc\Laravel\BladeInstance;

class BaseController
{

    /* protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->loader = new \Twig_Loader_Filesystem(__DIR__ . "/../../views");
        $this->twig = new \Twig_Environment($this->loader,[
            'cache' => false, 'debug' => true
        ]);
    } */

    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeInstance("/vagrant/views", "/vagrant/cache/views");
    }

}
