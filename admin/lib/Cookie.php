<?php

class Cookie
{
    /**
     * Cookie name - the name of the cookie.
     * @var bool
     */
    private $name = false;

    /**
     * Cookie value
     * @var string
     */
    private $value = "";

    /**
     * Cookie life time
     * @var DateTime
     */
    private $time;

    /**
     * Cookie domain
     * @var bool
     */
    private $domain = false;

    /**
     * Cookie path
     * @var bool
     */
    private $path = false;

    /**
     * Cookie secure
     * @var bool
     */
    private $secure = false;

    /**
     * Constructor
     */
    public function __construct() {
        
     }
    /**
     * @param $domain
     */
    public function setDomain($domain) {
        $this->domain = $domain;
    }

    /**
     * @return bool
     */
    public function getDomain() {
        return $this->domain;
    }

    /**
     * @param $id
     */
    public function setName($id) {
        $this->name = $id;
    }

    /**
     * @return bool
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param $secure
     */
    public function setSecure($secure) {
        $this->secure = $secure;
    }

    /**
     * @return bool
     */
    public function getSecure() {
        return $this->secure;
    }

    /**
     * @param $time
     */
    public function setTime($time) {

        $date = new DateTime();
        $date->modify($time);
        $this->time = $date->getTimestamp();
    }

    /**
     * @return bool|int
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param string $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }
}

?>