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

}
?>