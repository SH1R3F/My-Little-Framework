<?php 

namespace App\Rules;

use App\Rules\RuleInterface;
use Doctrine\ORM\EntityManager;

class ExistsRule implements RuleInterface
{

    private $db;

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    public function validate($field, $value, array $params, array $fields)
    {
        $user = $this->db->getRepository($params[0])->findOneBy([
            $field => $value
        ]);
        return $user === null;
    }
}