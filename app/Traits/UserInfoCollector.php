<?php

namespace App\Traits;

trait UserInfoCollector
{
    use ApiHeart;

    public function getUserDetails()
    {
        return session()->has('login') ? session('login')['data']['user'] : null;
    }

    function getDeskInformation($cdesk)
    {
        return [
            'office_id' => $cdesk['office_id'],
            'office_unit_id' => $cdesk['office_unit_id'],
            'designation_id' => $cdesk['office_unit_organogram_id'],
            'officer_id' => $cdesk['employee_record_id'],
            'user_id' => $cdesk['user_id'],
            'office' => $cdesk['office_name_bn'],
            'office_unit' => $cdesk['unit_name_en'],
            'designation' => $cdesk['designation'],
            'officer' => $cdesk['officer_name'],
            'officer_grade' => $cdesk['employee_grade'],
            'designation_level' => $cdesk['designation_level'],
            'designation_sequence' => $cdesk['designation_sequence'],
            'email' => $cdesk['email'],
            'phone' => $cdesk['phone'],
        ];
    }

    function current_desk(): array
    {
        return [
            'office_id' => $this->current_office_id(),
            'office_unit_id' => $this->current_office_unit_id(),
            'designation_id' => $this->current_designation_id(),
            'officer_id' => $this->getOfficerId(),
            'user_id' => $this->getUsername(),
            'office' => $this->current_office()['office_name_en'],
            'office_unit' => $this->current_office()['unit_name_en'],
            'designation' => $this->current_office()['designation_en'],
            'officer' => $this->getEmployeeInfo()['name_eng'],
            'designation_level' => $this->current_office()['designation_level'],
            'designation_sequence' => $this->current_office()['designation_sequence'],
            'officer_grade' => $this->getEmployeeInfo()['employee_grade'],
            'email' => $this->getEmployeeInfo()['personal_email'],
            'phone' => $this->getEmployeeInfo()['personal_mobile'],
        ];
    }

    public function current_office_id()
    {
        return session('_office_id') ?: $this->getUserOffices()[0]['office_id'];
    }

    public function getUserOffices()
    {
        return $this->checkLogin() ? session('login')['data']['office_info'] : [];
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
            $login_cag_bee = $this->loginIntoCagBee($login_cookie);
            $login_data_from_cookie = json_decode(gzuncompress(base64_decode($login_cookie)), true);
            if ($login_cag_bee && $login_cag_bee['status'] === 'success') {
                return session('login');
            }
//            if ($login_data_from_cookie && $login_data_from_cookie['status'] === 'success') {
//                session()->put('login', $login_data_from_cookie);
//                session()->save();
//                return session('login');
//            }
        }
        return null;
    }

    public function loginIntoCagBee($data)
    {
        return session('login') ?: $this->loginIntoCagBeeCore($data);
    }

    public function current_office_unit_id()
    {
        return session('_office_unit_id') ?: $this->getUserOffices()[0]['office_unit_id'];
    }

    public function current_designation_id()
    {
        return session('_designation_id') ?: $this->getUserOffices()[0]['office_unit_organogram_id'];
    }

    public function getOfficerId()
    {
        return $this->checkLogin() ? session('login')['data']['user']['employee_record_id'] : null;
    }

    public function getUsername()
    {
        return $this->checkLogin() ? session('login')['data']['user']['username'] : null;
    }

    public function current_office()
    {
        return session('_current_office') ?: $this->getUserOffices()[0];
    }

    public function getEmployeeInfo()
    {
        return session()->has('login') ? session('login')['data']['employee_info'] : null;
    }

    public function forceLogout()
    {
        session()->forget('login');
        unset($_COOKIE['_ndoptor']);
        $return_url = url('/login');
        return redirect(config('jisf.logout_sso_url') . '?referer=' . base64_encode($return_url));
    }
}
