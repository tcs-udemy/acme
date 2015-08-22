<?php
namespace Acme\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    public function testimonials()
    {
        return $this->hasMany('Acme\models\Testimonial');
    }
}
