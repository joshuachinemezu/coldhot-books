<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use \Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'code' => ['required', 'string', 'max:255', 'unique:accounts'],
            'phone_no' => ['required', 'string', 'regex:/(0)[0-9]/', 'size:11'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $__data = $request->only('code', 'phone_no');

        //Validates data
        // $request->validated();
        $validator = $this->validator($__data);

        if ($validator->fails()) {
            return JSON(CODE_VALIDATION_ERROR, ['errors' => $validator->errors()], "Validation Error");
        }


        if (!Account::valid_code(request()->agent_code)) {
            return JSON(CODE_BAD_REQUEST, [], "Sorry code is invalid, Please try again");
        }

        try {

            //Create account
            $account = Account::create([
                'uuid' => Str::orderedUuid()
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
