<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
class ResetController extends Controller
{
    public function showReset(){
        return view('/email');
    }

    public function sendEmail(Request $request){
        $credentials = ['email' => $request->email];
        $response = Password::sendResetLink($credentials, function(Message $message){
            $message->subject($this->getEmailSubject());
        }); 
    

       switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));
             break;
            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

   

    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your password reset link';
    }
    
    public function getReset($token = null)
    {
        if(is_null($token)){
            throw new NotFoundHttpException;
        }
        return view('reset')->with('token', $token);
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');
        $response = Password::reset($credentials, function($user,$password){
            $this->resetPassword($user,$password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect()->route('login');
                break;
            
            default:
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['email' => trans($response)]);
                break;
        }
    }

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
        Auth::login($user);
    }
}
