<?php namespace App\Services;

class MyHelper {

    /**
     *  Render a category list
     * @param $node
     * @return string
     */
    public function renderNode($node)
    {

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
     * Encrypts a token
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


    /**
     * Display select list in categories
     * @param $category
     * @return string
     */
    public function filterLeaf($category)
    {
        $depthMeter = '&rarr;';

        if ($category->isLeaf()) {
            return '<option value="' . $category->id . '">' . str_repeat($depthMeter,$category->depth) . $category->name . '</option>';
        } else {
            $html = '<optgroup label="' . str_repeat($depthMeter,$category->depth) . $category->name . '" >' . $category->depth ;

            foreach($category->children as $child)
                $html .= $this->filterLeaf($child);

            $html .= '</optgroup>';
        }

        return $html;

    }


    /**
     *  Currently selected categories
     * @param $categories
     * @param $currentCategories
     */
    public function editFilterLeaf($category, $currentCategories)
    {
        $depthMeter = '&rarr;';

        if ($category->isLeaf()) {

            if (in_array($category->name, $currentCategories)) {
                return '<option value="' . $category->id . '" selected>' . str_repeat($depthMeter, $category->depth) . $category->name . '</option>';
            } else {
                return '<option value="' . $category->id . '">' . str_repeat($depthMeter, $category->depth) . $category->name . '</option>';
            }

        } else {
            $html = '<optgroup label="' . str_repeat($depthMeter,$category->depth) . $category->name . '" >' . $category->depth ;

            foreach ($category->children as $child)
                $html .= $this->editFilterLeaf($child, $currentCategories);

            $html .= '</optgroup>';
        }

        return $html;
    }


}