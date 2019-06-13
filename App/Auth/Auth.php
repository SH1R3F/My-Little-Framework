<?php 

namespace App\Auth;

use App\Models\User;
use Doctrine\ORM\EntityManager;
use App\Hashing\HasherInterface;
use App\Sessions\SessionInterface;

class Auth
{

    protected $db;
    protected $session;
    protected $hasher;

    public function __construct(EntityManager $db, SessionInterface $session, HasherInterface $hasher)
    {
        $this->db = $db;       
        $this->session = $session;       
        $this->hasher = $hasher;       
    }

    public function attempt($email, $password)
    {
        $user = $this->fetchUser($email);
        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        $this->setUserSession($user);

        return true;

    }

    public function fetchUser($email)
    {
        return $this->db->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
    }

    public function hasValidCredentials($user, $password)
    {
        return $this->hasher->check($password, $user->password);
    }

    public function setUserSession($user)
    {
        $this->session->set('id', $user->id);
    }

}