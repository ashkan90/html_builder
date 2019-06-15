<?php


namespace App\Helpers\Table\HTML2;

use App\Helpers\Table\HTML2\Booter\BootProcess as Booter;
use App\Helpers\Table\HTML2\Builder\Grammar\TypeRegression;
use App\Helpers\Table\HTML2\Builder\Identifier\Element;
use App\Helpers\Table\HTML2\Helpers\Str;

class Fact extends Booter
{
    /**
     * @var \App\Helpers\Table\HTML2\Builder\Identifier\Element|array|object
     */
    public $elements;

    /**
     * @var \App\Helpers\Table\HTML2\Builder\Identifier\Element|array|object
     */
    public $roots;

    /**
     * @var string
     */
    public $page;

    /**
     * Send added element to $this elements
     *
     * @param Element $element
     * @return $this
     */
    public function element(Element $element)
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * Boot real compiled field.
     * Append children to parent-root.
     */
    public function create()
    {
        // Load only root elements.
        $this->loadRoots($this->elements, $this->roots);

        // Make sure that first element isn't child. If child then throw a exception about that.
        if ($this->elements[0]->isChild())
            TypeRegression::cantBe('child', 'First');

        // Set elements compiled field with relations
        $this->makeRelationsToCompiled($this->elements);
        
        // After append process by root-child then compile all stuffs into 'page' field.
        foreach ($this->roots as $key => $element) {
            
            $this->page .= $element->compiled;
        }
    }
}