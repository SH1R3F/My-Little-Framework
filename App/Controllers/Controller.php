<?php 

namespace App\Controllers;

use App\Views\View;
use Valitron\Validator;
use App\Exceptions\ValidationException;

abstract class Controller
{

    public function validate($request, array $rules)
    {
        $validator = new Validator($request->getParsedBody());

        $validator->mapFieldsRules($rules);

        if (!$validator->validate()) {
            throw new ValidationException($request, $validator->errors());
        }

        return $request->getParsedBody();
        
    }

}