<?php
namespace Acme\controllers;

use duncan3dc\Laravel\BladeInstance;
use Acme\models\Page;

class PageController extends BaseController
{

    public function getShowHomePage()
    {
        echo $this->blade->render("home");
    }

    public function getShowPage()
    {
        $browser_title = "";
        $page_content = "";

        // extract page name from the url
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $target = $uri[1];

        // find matching page in the db
        $page = Page::where('slug', '=', $target)->get();

        // look up page content
        foreach ($page as $item) {
            $browser_title = $item->browser_title;
            $page_content = $item->page_content;
        }

        // pass content to some blade template
        echo $this->blade->render('generic-page', [
            'browser_title' => $browser_title,
            'page_content' => $page_content,
        ]);
    }
}
