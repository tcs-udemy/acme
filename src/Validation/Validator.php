<?php
namespace Acme\Validation;

use Respect\Validation\Validator as Valid;

class Validator
{
    public function isValid($validation_data)
    {

        $errors = [];

        foreach ($validation_data as $name => $value) {
            if (isset($_REQUEST[$name])) {
                $exploded = explode(":", $value);

                switch ($exploded[0]) {
                    case 'min':
                        $min = $exploded[1];
                        if (Valid::string()->length($min)->Validate($_REQUEST[$name]) == false) {
                            $errors[] = $name . " must be at least " . $min . " characters long!";
                        }
                        break;

                    case 'email':
                        if (Valid::email()->Validate($_REQUEST[$name]) == false){
                            $errors[] = $name . " must be a valid email!";
                        }
                        break;

                    case 'equalTo':
                        if (Valid::equals($_REQUEST[$name])->Validate($_REQUEST[$exploded[1]]) == false) {
                            $errors[] = "Value does not match verification value!";
                        }
                        break;

                    default:
                        // do nothing
                }
            } else {
                $errors[] = "No value found!";
            }
        }
        return $errors;

    }
}
