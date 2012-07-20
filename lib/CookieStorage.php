<?php

interface StorageInterface
{
    public function set(Cookie $cookie);
    public function get(Cookie $cookie);
    public function update(Cookie $cookie);
    public function delete(Cookie $cookie);
}

class CookieStorage implements StorageInterface
{


    /**
     * constructor
     */
    public function __construct() {

    }

    /**
     * Create cookie.
     */
    public function set(Cookie $cookie) {
        return setcookie(   
                            $cookie->getName(),
                            $cookie->getValue(),
                            $cookie->getTime(), 
                            $cookie->getPath(), 
                            $cookie->getDomain(), 
                            $cookie->getSecure(), true 
                        );
    }

    /**
     * Get cookie.
     */
    public function get(Cookie $cookie) {
        return $_COOKIE[$cookie->getName()];

    }

    /**
     * Update cookie.
     */
    public function update(Cookie $cookie) {
        return $cookie->update();
    }


    public function delete(Cookie $cookie) {
        
        return $cookie->delete();
    }
}

?>