<?php 

namespace App\Auth;

use Exception;
use App\Models\User;
use Doctrine\ORM\EntityManager;
use App\Hashing\HasherInterface;
use App\Sessions\SessionInterface;

class Auth
{

    private $db;
    private $session;
    private $hasher;
    private $user;

    public function __construct(EntityManager $db, SessionInterface $session, HasherInterface $hasher)
    {
        $this->db = $db;       
        $this->session = $session;       
        $this->hasher = $hasher;       
    }

    public function attempt($email, $password)
    {
        $user = $this->fetchUserByEmail($email);
        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        if ($this->hasher->needsRehash($user->password)) {
            $this->rehashPassword($user, $password);
        }

        $this->setUserSession($user);

        return true;

    }

    private function rehashPassword($user, $password)
    {
        $this->db->getRepository(User::class)->find($user->id)->update([
            'password' => $this->hasher->create($password)
        ]);
        $this->db->flush();
    }

    private function fetchUserByEmail($email)
    {
        return $this->db->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
    }

    private function fetchUserById($id)
    {
        return $this->db->getRepository(User::class)->find($id);
    }

    private function hasValidCredentials($user, $password)
    {
        return $this->hasher->check($password, $user->password);
    }

    private function setUserSession($user)
    {
        $this->session->set($this->key(), $user->id);
    }

    public function check()
    {
        return $this->hasUserInSession();
    }

    public function hasUserInSession()
    {
        return $this->session->exists($this->key());
    }
    
    public function setUserFromSession()
    {
        $user = $this->fetchUserById($this->session->get($this->key()));
        if (!$user) {
            throw new Exception();
        }
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }

    private function key()
    {
        return 'id';
    }
}