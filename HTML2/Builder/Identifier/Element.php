<?php


namespace App\Helpers\Table\HTML2\Builder\Identifier;


use App\Helpers\Table\HTML2\Builder\Grammar\Rules\TagRules;

abstract class Element extends TagRules
{
    protected $child = false;

    protected $attributes;

    protected $class;

    protected $innerText;

    protected $element;

    public $compiled;

    protected  $root;

    protected function isRelational(): bool
    {
        return $this->getRoot() == $this;
    }

    public function isChild(): bool
    {
        return $this->child;
    }

    protected function setChild($bool): void
    {
        $this->child = $bool;
    }

    protected function setElement($element)
    {
        $this->element = $element;
    }

    public function getElement()
    {
        return $this->element;
    }

    public function getCompiled()
    {
        return $this->compiled;
    }

    protected function setCompiled($compiled)
    {
        $this->compiled = $compiled;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    protected function setAttributes($attribute)
    {
        $this->attributes = $attribute;
    }

    protected function getRoot()
    {
        return $this->root;
    }

    public function setRoot($root)
    {
        $this->root = $root;
    }

    protected function getInnerText()
    {
        return $this->innerText;
    }

    protected function setInnerText($text)
    {
        $this->innerText = $text;
    }

    protected function setClass(string $class)
    {
        $this->class = $class;
    }

    protected function getClass()
    {
        return $this->class;
    }
}