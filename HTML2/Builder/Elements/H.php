<?php


namespace App\Helpers\Table\HTML2\Builder\Elements;


class H extends Main
{
    protected $header_number = 1;

    public function __construct($which = 1)
    {
        $this->header_number = $which;
    }

    public function build()
    {
        return parent::build();
    }

    public function attribute(string $atr)
    {
        return parent::attribute($atr);
    }

    public function child($bool = false)
    {
        return parent::child($bool);
    }

    public function innerText(string $text)
    {
        return parent::innerText($text);
    }

    public function element($class = null, $innerText = "", $child = false)
    {
        return parent::element($class, $innerText, $child);
    }
}