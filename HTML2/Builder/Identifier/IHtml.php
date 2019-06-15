<?php


namespace App\Helpers\Table\HTML2\Builder\Identifier;


interface IHtml
{
    public function build();

    public function attribute(string $atr);

    public function child($bool = false);

    public function innerText(string $text);

    public function element($class = null, $innerText = "", $child = false);
}