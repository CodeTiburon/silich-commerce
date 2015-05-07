<?php namespace App\Http\Controllers\Authorise;

use App\Http\Controllers\Controller;
use App\Main_user;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
//use Illuminate\Support\Facades\Request;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

//use App\Http\Requests\CreateNewUserRequest;
//use App\Main_user;
//use App\Http\Requests;
class AuthoriseController extends Controller {



    use AuthenticatesAndRegistersUsers;

    public function __construct(Guard $auth, Registrar $registrar) {

        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }


    /**
     * @return \Illuminate\View\View
     */
    public function authorize() {

        return view('authorise.main');

    }

    /**
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {

        return view('authorise.register');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postRegister(Request $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails()) {
            return response()->json([
            'fail' => 'true',
            'errors' => $validator->getMessageBag()->toArray()
        ]);
        }
        else if($validator->passes()) {
            $this->auth->login($this->registrar->create($request->all()));
            return response()->json([
                'success' => 'true',
                'redirectTo' => '../home'
            ]);
        };
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('authorise.login');

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required', 'password' => 'required',
        ]);
        $credentials = $request->only('name', 'password');

        $this->auth->attempt($credentials, $request->has('remember'));

        return response()->json([
            'success' => 'true',
            'redirectTo' => '../home'
        ]);
    }

//    public function login() {
//
//
//        return view('authorise.login');
//    }
//
//    public function register() {
//
//        return view('authorise.register');
//
//    }
//
//    public function tryLogin(Request $request) {
//
//        return $request->all();
//    }
//
//    public function tryRegister(CreateNewUserRequest $userRequest) {
//
//        Main_user::create($userRequest->all());
//
//        return 'Welcome ' . $userRequest->name;
//
//    }

}
