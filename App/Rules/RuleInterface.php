<?php 

namespace App\Rules;

interface RuleInterface
{

    public function validate($field, $value, array $params, array $fields);

}