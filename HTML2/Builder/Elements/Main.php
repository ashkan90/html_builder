<?php


namespace App\Helpers\Table\HTML2\Builder\Elements;


use App\Helpers\Table\HTML2\Builder\Grammar\TypeRegression;
use App\Helpers\Table\HTML2\Builder\Identifier\Element;
use App\Helpers\Table\HTML2\Builder\Identifier\IHtml;
use App\Helpers\Table\HTML2\Builder\Resolver\ElementResolver;

abstract class Main extends Element implements IHtml
{

    /**
     * @return $this
     * @throws \App\Helpers\Table\HTML2\Builder\Grammar\SyntaxErrorException
     */
    public function build()
    {
        ElementResolver::make($this);

        return $this;
    }

    public function attribute(string $atr)
    {
        $this->setAttributes($atr);

        return $this;
    }

    public function child($bool = false)
    {
        // Bu hata da alt kademeye taşınacak.
        if (true === $this->isChild()) {
            TypeRegression::cantBe('overridden');
        }
        $this->setChild(!$bool ?? true);

        return $this;
    }

    public function innerText(string $text)
    {
        // Bu hatalar alt kademeye taşınacak.
        if (! empty($this->getInnerText())) {
            TypeRegression::cantBe('overridden for Inner Text property', 'This');
        }

        if (! $this->isChild() && ! empty($this->getInnerText())) {
            TypeRegression::cantBe('or have a "inner text"', 'Root/Parent');
        }

        $this->setInnerText($text);

        return $this;
    }

    /**
     * @param null $class
     * @param string $innerText
     * @param bool $child
     * @return $this
     */
    public function element($class = null, $innerText = "", $child = false)
    {
        $this->innerText($innerText);
        $this->setClass($class);
        $this->setChild($child);

        return $this;
    }

    public function __get($name)
    {
        if (property_exists($this, $name))
            return $this->{$name};
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name))
            $this->{$name} = $value;
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method))
            return call_user_func_array(array(&$this, $method), $arguments);
    }
}