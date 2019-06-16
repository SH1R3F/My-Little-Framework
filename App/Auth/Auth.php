<?php 

namespace App\Auth;

use Exception;
use App\Models\User;
use App\Cookies\Cookie;
use App\Auth\RememberMe;
use App\Hashing\HasherInterface;
use App\Sessions\SessionInterface;

class Auth
{

    private $session;
    private $hasher;
    private $user;
    private $rememberme;
    private $cookie;

    public function __construct(SessionInterface $session, HasherInterface $hasher, RememberMe $rememberme, Cookie $cookie)
    {
        $this->session = $session;       
        $this->hasher = $hasher;       
        $this->rememberme = $rememberme;       
        $this->cookie = $cookie;
    }

    public function attempt($email, $password, $rememberme = false)
    {
        $user = User::where('email', $email)->first();
        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        if ($this->hasher->needsRehash($user->password)) {
            $this->rehashPassword($user, $password);
        }

        $this->setUserSession($user);


        if ($rememberme) {
            $this->rememberUser($user);
        }

        return true;

    }

    private function rememberUser($user)
    {
        // Set tokens inside cookies
        list($identifier, $token) = $this->rememberme->generate();
        $this->cookie->set('rememberme', $this->rememberme->cookieValue($identifier, $token));
        
        User::find($user->id)->update([
            'remember_token' => hash('sha256', $token),
            'remember_identifier' => $identifier
        ]);
    }

    public function isRemembered()
    {
        return $this->cookie->exists('rememberme');
    }

    public function setUserFromCookies()
    {
        list($identifier, $token) = $this->rememberme->separate($this->cookie->get('rememberme'));
        $user = User::where('remember_identifier', $identifier)->first();

        if (!$user) {
            $this->cookie->clear('rememberme');
            return;
        }

        if (!$this->rememberme->validateToken($user->remember_token, $token)) {

            $this->clearUserRememberMe($user);

            return; 

        }

        $this->setUserSession($user);
    }

    public function logout()
    {
        $this->clearUserTokens($this->user);
        $this->cookie->clear('rememberme');
        $this->session->clear($this->key());
    }

    private function clearUserTokens($user)
    {
        User::find($user->id)->update([
            'remember_identifier' => null,
            'remember_token' => null
        ]);
        $this->cookie->clear('rememberme');
    }

    private function rehashPassword($user, $password)
    {
        User::find($user->id)->update([
            'password' => $this->hasher->create($password)
        ]);
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
        $user = User::find($this->session->get($this->key()));
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