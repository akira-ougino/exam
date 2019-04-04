<?php

namespace App;

class Item
{
    public $list;
    public $title;
    public $price;
    public $quantity;

    public function __construct()
    {
        $this->list = static::setItem();
    }

    /**
     * @return array
     */
    private static function setItem(): Array
    {
        $set = array( array('title'=>'Amazon Web Services 業務システム設計・移行ガイド', 'price'=>3456, 'quantity'=>1),
                      array('title'=>'プログラマの数学第2版', 'price'=>2376, 'quantity'=>2),
        );

        return $set;
    }

    /**
     * @param string $title
     * @param int $price
     * @param int $quantity
     * @return bool
     */
    public static function conditions(string $title, int $price, int $quantity): bool
    {
        $q = (1 <= $quantity && $quantity <= 9) ? true : false;
        $p = (0 <= $price && $price <= 99999) ? true : false;
        $t = (1 <= mb_strlen($title) && mb_strlen($title) <= 255) ? true : false;

        if($q && $p && $t){
            return true;
        }

        return false;
    }
}
