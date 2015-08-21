<?php
namespace Acme\controllers;

use duncan3dc\Laravel\BladeInstance;

class PageController extends BaseController
{

    public function getShowHomePage()
    {
        echo $this->blade->render("home");
    }

    public function getShowPage()
    {
        echo "foo!";
    }
}
