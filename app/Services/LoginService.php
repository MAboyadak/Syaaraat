<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{

    private $loginType;

    public function login($data)
    {
        $this->setLoginType($data['username']);

        $credentials = [
            $this->loginType    => $data['username'],
            'password'          => $data['password']
        ];

        if (Auth::attempt($credentials)) {
            return true;
        }else{
            return false;
        }
    }

    private function setLoginType($username){
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $this->loginType = 'phone';
        } else {
            $this->loginType = 'email';
        }
    }
    

}

?>