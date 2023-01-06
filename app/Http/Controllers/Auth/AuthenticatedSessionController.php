<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Entry;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\Smstrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    use Smstrait;

    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function sendCode(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'mobile' => 'required|regex:/(09)[0-9]/|size:11',
        ]);
        if ($validate->fails()) return $this->sendError(['step' => '0'], $validate->errors()->messages());

        $mobile = $request->mobile;
        $name = $request->name;
        $user = User::where('mobile', $mobile)->first();

        if (!$user && !$name) return $this->sendTrue(['step' => '1'], ['name' => 'نام خود را وارد کنید']);
        elseif (!$user && $name) {
            $user = User::create([
                'mobile' => $mobile,
                'name' => $name
            ]);
        }
        $code = mt_rand(1000, 9999);
        $entry = Entry::where('user_id',$user->id);
        if ($entry){
            $entry->code = $code;
            $entry->save();
        }else{
            $entry = Entry::create([
                'user_id'=>$user->id,
                'code'=> $code
            ]);
        }
//        $this->Sendsms($mobile,'authSeo',$code);
        return $this->sendTrue(['step'=>'2'],['name' => 'کد ارسال شد']);
    }

    public function authCode(Request $request){
        $validate = Validator::make($request->all(), [
            'mobile' => 'required|regex:/(09)[0-9]/|size:11',
            'code' => 'required|numeric|size:4',
        ]);
        if ($validate->fails()) return $this->sendError(['step' => '0'], $validate->errors()->messages());

    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
