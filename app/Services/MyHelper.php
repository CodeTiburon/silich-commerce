<?php namespace App\Services;

class MyHelper {

    /**
     *  Render a category list
     * @param $node
     * @return string
     */
    public function renderNode($node) {

        if( $node->isLeaf() ) {
            return '<li class="list-group-item" data-id="'. $node->id .'""><h5>' . $node->name . '</h5><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-remove"></span> Remove
        </button></li>';
        } else {
            $html = '<li class="list-group-item" data-id="'. $node->id .'""><h5>' . $node->name . '</h5><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-remove"></span> Remove
        </button>';

            $html .= '<ul class="list-group">';

            foreach($node->children as $child)
                $html .= $this->renderNode($child);

            $html .= '</ul>';

            $html .= '</li>';
        }

        return $html;
    }

    /**
     * Encrypts a token to
     * @return mixed
     */
    public function tokenEncrypt()
    {
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return $encrypted_token;
    }

    public function test()
    {
        return "One Hello";
    }

    public function filterLeaf($categories)
    {
        foreach($categories as $category) {
            if($category->isLeaf()){
                echo '<option value="'.$category->id. '">' . $category->name. '</option>';
            }
        }
    }
}