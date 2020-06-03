<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
		
		$this->middleware('guest:admin')->except('logout');
		$this->middleware('guest:customer')->except('logout');
		$this->middleware('guest:support')->except('logout');
		$this->middleware('guest:marketing')->except('logout');
    }
	
	public function showAdminLoginForm()
	{
		return view('auth.login', ['url' => 'admin']);
	}
	 
	public function adminLogin(Request $request)
	{
		$this->validate($request, [
			'email'   => 'required|email',
			'password' => 'required|min:6'
		]);
	 
		if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
	 		$user = Auth::guard('admin')->user();
			Session::put('username', $user->name);
			Session::put('email', $user->email);
			return redirect()->intended('/admin');
		}
		return back()->withInput($request->only('email', 'remember'));
	}
	
	public function showCustomerLoginForm()
	{
		return view('auth.login', ['url' => 'customer']);
	}
	 
	public function customerLogin(Request $request)
	{
		$this->validate($request, [
			'email'   => 'required|email',
			'password' => 'required|min:6'
		]);
	 
		if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
	 		$user = Auth::guard('customer')->user();
			Session::put('username', $user->name);
			Session::put('email', $user->email);
			return redirect()->intended('/customer');
		}
		return back()->withInput($request->only('email', 'remember'));
	}
	
	public function showSupportLoginForm()
	{
		return view('auth.login', ['url' => 'support']);
	}
	 
	public function supportLogin(Request $request)
	{
		$this->validate($request, [
			'email'   => 'required|email',
			'password' => 'required|min:6'
		]);
	 
		if (Auth::guard('support')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
	 		$user = Auth::guard('support')->user();
			Session::put('username', $user->name);
			Session::put('email', $user->email);
			return redirect()->intended('/support');
		}
		return back()->withInput($request->only('email', 'remember'));
	}
	
	public function showMarketingLoginForm()
	{
		return view('auth.login', ['url' => 'marketing']);
	}
	 
	public function marketingLogin(Request $request)
	{
		$this->validate($request, [
			'email'   => 'required|email',
			'password' => 'required|min:6'
		]);
	 
		if (Auth::guard('marketing')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
	 		$user = Auth::guard('marketing')->user();
			Session::put('username', $user->name);
			Session::put('email', $user->email);
			return redirect()->intended('/marketing');
		}
		return back()->withInput($request->only('email', 'remember'));
	}
	
}
