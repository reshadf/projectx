<?php
class Timer
{
    /**
     * $time holds the start time
     */
    private $time = false;

    function __construct()
    {
        $this->time = $this->time();  
    }    

    private function time()
    {
        list($usec, $sec) = explode(" ", microtime());
        
        return (float) $usec + (float) $sec;
    }        
    
    public function display($dec = 6)
    {       
        return (float) round(($this->time() - $this->time), $dec);
    }
}
?>