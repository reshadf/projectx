<?php
class NavigationItem implements NavigationItemInterface {
	
	public $menu = null;
    public $menuItem = null;

    public function setMenuItem($items) {

        $this->menuItem = $items;
    }

    public function getMenuItem() {
        return $this->menuItem;
    }

    public function getClass() {

        if(isset($_GET['page']) and $_GET['page'] == $this->getMenuItem() . '.php')

        {
            $class = 'current';
        }
        else
        {
            $class = '';
        }

        return $class;
    }

    public function display() {

        
        return '<li><a class="' . $this->getClass() . '" href="index.php?page=' . $this->getMenuItem() . '.php">' . $this->getMenuItem() . '</a></li>';
        
    }

}
?>