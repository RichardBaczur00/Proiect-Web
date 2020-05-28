<?php


class RecipeObject
{
    private $id;
    private $name;
    private $image;
    private $special;
    private $number_of_ingredients;

    /**
     * RecipeObject constructor.
     * @param $id
     * @param $name
     * @param $image
     * @param $special
     * @param $number_of_ingredients
     */
    function __construct($id, $name, $image, $special, $number_of_ingredients)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->number_of_ingredients = $number_of_ingredients;
        $this->special = $special;
    }

    /**
     * @return integer
     */
    function get_id() {
        return $this->id;
    }

    /**
     * @return string
     */
    function get_name() {
        return $this->name;
    }

    /**
     * @return string
     */
    function get_image() {
        return $this->image;
    }

    /**
     * @return string*
     */
    public function get_special()
    {
        return $this->special;
    }

    /**
     * @return integer
     */
    public function getNumberOfIngredients()
    {
        return $this->number_of_ingredients;
    }


}