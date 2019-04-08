<?php

namespace Tests;

use App\Cart;
use App\Element;
use App\Product;
use PHPUnit\Framework\TestCase;

class Example extends TestCase
{
    private $cart;

    public function __construct()
    {
        parent::__construct();
        $this->cart = new Cart();
    }

    /**
     * @test
     */
    public function view()
    {
        $expected = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected, $this->cart->show());

        $this->addProduct('Amazon Web Services 業務システム設計・移行ガイド', 3456, 1);
        $this->addProduct('プログラマの数学第2版', 2376, 2);

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1".PHP_EOL
            ."プログラマの数学第2版\t2376\t2".PHP_EOL
            ."小計 (3 点): \\8208";
        $this->assertEquals($expected, $this->cart->show());
    }

    /**
     * @param string $title
     * @param int $price
     * @param int $quantity
     */
    public function addProduct(string $title, int $price, int $quantity)
    {
        $product = new Product($title, $price);
        $element = new Element($product, $quantity);
        $this->cart->add($element);
    }
}
