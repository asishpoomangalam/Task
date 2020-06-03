<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Support;
use App\Models\Marketing;

use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
		$this->middleware('guest:admin');
		$this->middleware('guest:customer');
		$this->middleware('guest:support');
		$this->middleware('guest:marketing');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
//    protected function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
//    }

	public function showAdminRegisterForm()
	{
		return view('auth.register', ['url' => 'admin']);
	}
	 
	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	protected function createAdmin(Request $request)
	{
		$this->validator($request->all())->validate();
		Admin::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);
		return redirect()->intended('login/admin');
	}
	
	public function showCustomerRegisterForm()
	{
		return view('auth.register', ['url' => 'customer']);
	}
	 
	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	protected function createCustomer(Request $request)
	{
		$this->validator($request->all())->validate();
		Customer::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);
		return redirect()->intended('login/customer');
	}
	
	public function showMarketingRegisterForm()
	{
		return view('auth.register', ['url' => 'marketing']);
	}
	 
	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	protected function createMarketing(Request $request)
	{
		$this->validator($request->all())->validate();
		Marketing::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);
		return redirect()->intended('login/marketing');
	}
	
	public function showSupportRegisterForm()
	{
		return view('auth.register', ['url' => 'support']);
	}
	 
	/**
	 * @param Request $request
	 *
	 * @return RedirectResponse
	 */
	protected function createSupport(Request $request)
	{
		$this->validator($request->all())->validate();
		Support::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);
		return redirect()->intended('login/support');
	}
	
}