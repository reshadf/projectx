<?php
class Navigation implements navigationInterface{

    public $name = null;
    public $klasse = null;

    public function __construct(NavigationItem $navItem, $name, $klasse) {

        $this->navItem = $navItem;
        $this->name = $name;
        $this->klasse = $klasse;

    }

    public function getName() {
        return $this->name;
    }

    public function getClass() {
        return $this->klasse;
    }

    public function display() {

    $menu = '<nav class="' . $this->getName() . '"><ul>';
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


    $menu .= '</ul></nav>';

    return $menu;

    }
}
?>