<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait UserInfoCollector
{
    use ApiHeart;

    public function getUserDetails()
    {
        return session()->has('login') ? session('login')['data']['user'] : null;
    }

    public function getDesignationRole()
    {
        $designation_role = $this->initDoptorHttp()->post(config('cag_doptor_api.designation_role'), ['designation_id' => $this->current_designation_id()])->json();
        if (isSuccess($designation_role)) {
            Session::put('_designation_role', json_encode($designation_role['data']));
        }
    }

    public function current_designation_id()
    {
        return session('_designation_id') ?: $this->getUserOffices()[0]['office_unit_organogram_id'];
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
            $this->getDesignationRole();
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

    function getDeskInformation($cdesk)
    {
        return [
            'office_id' => $cdesk['office_id'],
            'office_unit_id' => $cdesk['office_unit_id'],
            'designation_id' => $cdesk['office_unit_organogram_id'],
            'officer_id' => $cdesk['employee_record_id'],
            'user_primary_id' => $cdesk['user_primary_id'],
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
            'is_office_admin' => json_decode($this->current_designation_role())->is_office_admin ?? false,
            'is_office_head' => json_decode($this->current_designation_role())->is_office_head ?? false,
            'is_unit_head' => json_decode($this->current_designation_role())->is_unit_head ?? false,
            'is_unit_admin' => json_decode($this->current_designation_role())->is_unit_admin ?? false,
            'designation_id' => $this->current_designation_id(),
            'master_designation_id' => $this->current_office()['ref_master_designation_info_id'],
            'officer_id' => $this->getOfficerId(),
            'user_primary_id' => $this->getUserId(),
            'user_id' => $this->getUsername(),
            'office_name_en' => $this->current_office()['office_name_en'],
            'office_name_bn' => $this->current_office()['office_name_bn'],
            'office_unit_en' => $this->current_office()['unit_name_en'],
            'office_unit_bn' => $this->current_office()['unit_name_bn'],
            'designation_en' => $this->current_office()['designation_en'],
            'designation_bn' => $this->current_office()['designation'],
            'officer_en' => $this->getEmployeeInfo()['name_eng'],
            'officer_bn' => $this->getEmployeeInfo()['name_bng'],
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

    public function current_office_unit_id()
    {
        return session('_office_unit_id') ?: $this->getUserOffices()[0]['office_unit_id'];
    }

    public function current_designation_role()
    {
        return session('_designation_role') ?: json_encode([]);
    }

    public function current_office()
    {
        return session('_current_office') ?: $this->getUserOffices()[0];
    }

    public function getOfficerId()
    {
        return $this->checkLogin() ? session('login')['data']['user']['employee_record_id'] : null;
    }

    public function getUserId()
    {
        return $this->checkLogin() ? session('login')['data']['user']['id'] : null;
    }

    public function getUsername()
    {
        return $this->checkLogin() ? session('login')['data']['user']['username'] : null;
    }

    public function getEmployeeInfo()
    {
        return session()->has('login') ? session('login')['data']['employee_info'] : null;
    }

    public function current_office_domain()
    {
        return $this->current_office()['office_domain_url'];
    }

    public function employee_signature()
    {
        return session()->has('login') ? session('login')['data']['signature'] : null;
    }

    public function forceLogout()
    {
        session()->forget('login');
        unset($_COOKIE['_ndoptor']);
        $return_url = url('/login');
        return redirect(config('jisf.logout_sso_url') . '?referer=' . base64_encode($return_url));
    }
}
