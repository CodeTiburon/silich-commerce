<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ContactController extends Controller {

    public function getName() {

        $data ['first']= 'Sil';
        $data['last'] = 'Ant';
        return view('contacts.about', $data);
    }

}
