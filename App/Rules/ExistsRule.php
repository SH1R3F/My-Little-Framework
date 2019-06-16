<?php 

namespace App\Rules;

use App\Models\User;
use App\Rules\RuleInterface;

class ExistsRule implements RuleInterface
{
    public function validate($field, $value, array $params, array $fields)
    {
        return $params[0]::where($field, $value)->first() === null;
    }
}