<?php
namespace Acme\controllers;

use duncan3dc\Laravel\BladeInstance;
use Acme\models\Page;
use Acme\Validation\Validator;

class AdminController extends BaseController
{

    /**
     * Saved edited page; called via ajax
     * @return string
     */
    public function postSavePage()
    {
        $page_id = $_REQUEST['page_id'];
        $page_content = $_REQUEST['thedata'];

        $page = Page::find($page_id);
        $page->page_content = $page_content;
        $page->save();
        echo "OK";
    }

}
