<?php
class Navigation implements navigationInterface{

    public $menu = null;
    public $name = null;
    public $items = null;

    public function __construct($name) {

        $this->name = $name;

    }

    public function addChild(NavigationItem $item)
    {
        $this->items[] = $item;
    }

    public function getName() {
        return $this->name;
    }

    public function display() {

        $menu = '<nav class="' . $this->getName() . '"><ul>';
        
        foreach ($this->items as $item) {
            
           $menu.= $item->display();

        }

        $menu .= '</ul></nav>';

        return $menu;

    }
}
?>