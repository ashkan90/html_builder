<?php


namespace App\Helpers\Table\HTML2\Booter;

use App\Helpers\Table\HTML2\Helpers\Str;

abstract class BootProcess
{

    /**
     * Take only root elements from $this elements
     *
     * @param array $elements
     * @param $roots
     */
    public function loadRoots(array $elements, &$roots)
    {
        foreach ($elements as $key => $element) {
            if (! is_null($element->getRoot()))
                $roots[] = $element->getRoot();
        }
    }

    /**
     * Load related elements to root's compiled field.
     *
     * @param array $elements
     */
    public function makeRelationsToCompiled(array & $elements)
    {
        $root = null;

        $i = -1;
        foreach ($elements as $key => $element) {
            $i++;
            if (! $element->isChild()) {
                $root = $element;
            }

            $next = $elements[$i];

            // Append child ones to its root.
            if ($next->isChild()) {
                $root->compiled = Str::replaceLast('><', $next->compiled, $root->compiled, 1);
            }
        }
    }
}