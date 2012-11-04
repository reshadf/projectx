<?php
class NavigationItem implements NavigationItemInterface {
	
	public $menu = null;

	public function __construct() {

	}

    public function setMenuItem($items) {

        $this->menuItem = $items;
    }

    public function getMenuItem($menu) {
        return $menu;
    }

    public function display() {

    	if(is_array($this->menuItem))
        {
        foreach($this->menuItem as $val)
        {
        $menu .= '<li><a class="' . $this->getClass() . '" href="index.php?page=' . $this->getMenuItem($val) . '.php">' . $this->getMenuItem($val) . '</a></li>';
        }
        }
        else{
            $menu .= '<li><a class="' . $this->getClass() . '" href="index.php?page=' . $this->getMenuItem($this->menuItem) . '.php">' . $this->getMenuItem($this->menuItem) . '</a></li>';

        }

        return $menu;
    }

}
?>