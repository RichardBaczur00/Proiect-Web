<?php


class InventoryItem
{
    private $name;
    private $quantity;

    function __construct($name, $quantity) {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    function get_name() {
        return $this->name;
    }

    function get_quantity() {
        return $this->quantity;
    }
}