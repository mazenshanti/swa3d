<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\registerFormRequest;
use Illuminate\Auth\Events\Registered;

    class RegisterController extends Controller
    {
        /*
        |--------------------------------------------------------------------------
        | Register Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles the registration of new users as well as their
        | validation and creation. By default this controller uses a trait to
        | provide this functionality without requiring any additional code.
        |
        */

        use RegistersUsers;

        /**
         * Where to redirect users after registration.
         *
         * @var string
         */
        protected $redirectTo = '/step';

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            // Based on the workflow you need, you may update and customize the following lines.

            $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
        }

        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validator(array $data)
        {
            return Validator::make($data, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);
        }

        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array  $data
         * @return User
         */
        protected function create(array $data)
        {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'userType'=>$data['userType'],
            ]);
        }

        /**
         * Handle a registration request for the application.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function register(Request $request)
        {
            $this->validator($request->all())->validate();

            $user = $this->create($request->all());

            event(new Registered($user));

            $this->guard()->login($user);

            return $this->registered($request, $user)
                            ?: redirect($this->redirectPath());
        }
    }