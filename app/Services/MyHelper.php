<?php namespace App\Services;

class MyHelper {

    public function renderNode($node) {

        if( $node->isLeaf() ) {
            return '<li data-id="'. $node->id .'""><h5>' . $node->name . '</h5><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-remove"></span> Remove
        </button></li>';
        } else {
            $html = '<li data-id="'. $node->id .'""><h5>' . $node->name . '</h5><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-remove"></span> Remove
        </button>';

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