<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Hash;
    use Auth;
    use Laravel\Socialite\Facades\Socialite;
    use App\Models\User;
    use Illuminate\Support\Str;

    class AuthController extends Controller
    {
        //
        public function index(){
            return view('login');
        }

        public function profile()
        {
            $user = auth()->user(); 
            return view('profile', compact('user'));
        }

        // public function redirectToGoogle()
        // {
        //     return Socialite::driver('google')->redirect();
        // }

        // public function handleGoogleCallback()
        // {
        //     try {
        //         $googleUser = Socialite::driver('google')->stateless()->user();

        //         $user = User::firstOrCreate(
        //             ['email' => $googleUser->getEmail()],
        //             [
        //                 'name' => $googleUser->getName(),
        //                 'password' => bcrypt(Str::random(24)),
        //             ]
        //         );

        //         Auth::login($user);
        //         return redirect()->intended('/admin');
        //     } catch (\Exception $e) {
        //         return redirect()->route('login')->withErrors('Gagal login dengan Google.');
        //     }
        // }


        public function verify(Request $request){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
        
            if ($validator->fails()) {
                return redirect(route('index'))->withErrors($validator)->withInput();
            }
        
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->intended('/admin')->with('pesan', 'Login berhasil! Selamat datang.');
            } else {
                return redirect(route('login'))->with('pesan', 'Kombinasi email dan password salah');
            }
        }

        public function logout(){
            if(Auth::check()){
                Auth::logout();
            }        
            return redirect(route('login'))->with('pesan', 'anda telah Log Out');
        }

        public function formResetPassword() {
        return view('reset-password', ['title' => 'Reset Password']);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak cocok']);
        }

        $user->update([
            'password' => Hash::make($request->password_baru),
        ]);

        return redirect()->route('admin.resetPassword')->with('success', 'Password berhasil diubah!');
    }
    }
