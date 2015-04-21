<?php namespace App\Http\Controllers;

use App\User_data;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Security\Core\User\User;

;

class UserController extends Controller {

    public function index() {

        $users = User_data::latest('name')->get();

        return view('user.info', compact('users'));

    }

    public function show($id) {

        $users = User_data::findOrFail($id);


        return view('user.show', compact('users'));


    }

    public function create() {

        return view('user.create');

    }

    public function store(Request $request) {

        $this->validate($request, ['name' => 'required', 'email' => 'required']);

        User_data::create($request->all());



        return redirect('user');

    }

    public function edit($id) {

        $user = User_data::findOrFail($id);

        return view('user.edit', compact('user'));

    }

    public function update($id, UserRequest $request) {

        $user = User_data::findOrFail($id);

        $user->update($request->all());

        return redirect('user');

    }

}
