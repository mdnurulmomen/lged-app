<?php

namespace App\Traits;

trait UserInfoCollector
{
    use ApiHeart;

    public function getUserDetails()
    {
        return session()->has('login') ? session('login')['user_info']['user'] : null;
    }

    public function getUserOfficesByDesignation()
    {
        return $this->checkLogin() ? session('login')['user_info']['office_info'] : [];
    }

    public function checkLogin(): bool
    {
        $login_session = session('login') ?: $this->setLogin();
        return (bool)$login_session;
    }

    public function setLogin()
    {
        $login_cookie = isset($_COOKIE['_ndoptor']) ? $_COOKIE['_ndoptor'] : null;
        if ($login_cookie) {
            $login_data_from_cookie = json_decode(gzuncompress(base64_decode($login_cookie)), true);
            if ($login_data_from_cookie && $login_data_from_cookie['status'] === 'success') {
                session()->put('login', $login_data_from_cookie);
                session()->save();
                return session('login');
            }
        }
        return null;
    }

    public function getUsername()
    {
        return $this->checkLogin() ? session('login')['user_info']['user']['username'] : null;
    }
}
