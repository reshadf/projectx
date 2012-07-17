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
                            $this->getName(),
                            $this->getValue(),
                            $this->getTime(), 
                            $this->getPath(), 
                            $this->getDomain(), 
                            $this->getSecure(), true 
                        );
    }

    /**
     * Get cookie.
     */
    public function get(Cookie $cookie) {
        return $_COOKIE[$this->getName()];

    }

    /**
     * Update cookie.
     */
    public function update(Cookie $cookie) {
        return $this->update();
    }


    public function delete(Cookie $cookie) {
        
        return $this->delete();
    }
}

?>