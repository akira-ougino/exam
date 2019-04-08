<?php

namespace App;

class Cart
{
    protected $elements = [];

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add(Element $element)
    {
        $this->elements[] = $element;
    }

    public function show()
    {
        if (empty($this->elements)) {
            return 'お客様のショッピングカートに商品はありません。';
        }

        $result = $this->showText();

        return $result;
    }

    /**
     * @return string
     */
    public function showText(): string
    {
        $text = '';
        $amount = 0;
        $totalQuantity = 0;

        foreach ($this->elements as $element) {
            $title = $element->getProduct()->getTitle();
            $price = $element->getProduct()->getPrice();
            $quantity = $element->getQuantity();

            $text .= $title . "\t" . $price . "\t" . $quantity . "\r\n";
            $amount += $price * $quantity;
            $totalQuantity += $quantity;
        }

        if ($totalQuantity) {
            $text .= '小計 ('.$totalQuantity.' 点): \\'.$amount;
        } else {
            $text = 'お客様のショッピングカートに商品はありません。';
        }

        return $text;
    }
}
