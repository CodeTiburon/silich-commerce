<?php namespace App\Services;

class MyHelper {

    public function renderNode($node) {

        if( $node->isLeaf() ) {
            return '<li data-id="'. $node->id .'"">' . $node->name . '</li>';
        } else {
            $html = '<li data-id="'. $node->id .'"">' . $node->name;

            $html .= '<ul>';

            foreach($node->children as $child)
                $html .= $this->renderNode($child);

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }

    public function test()
    {
        return "One Hello";
    }

}