<?php
namespace Acme\controllers;

use duncan3dc\Laravel\BladeInstance;
use Kunststube\CSRFP\SignatureGenerator;

class BaseController
{

    protected $blade;
    protected $signer;

    public function __construct()
    {
        $this->signer = new SignatureGenerator(getenv('CSRF_SECRET'));
        $this->blade = new BladeInstance("/vagrant/views", "/vagrant/cache/views");
    }

}
