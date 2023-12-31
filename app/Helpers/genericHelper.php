<?php

if (!function_exists('___')) {
    function ___($translation_text)
    {
        return trans($translation_text);
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 8): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('hash_equals')) {
    function hash_equals($str1, $str2)
    {
        if (strlen($str1) != strlen($str2)) {
            return false;
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            $length = strlen($res);
            for ($i = $length - 1; $i >= 0; $i--) {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}

if (!function_exists('groupByField')) {
    function groupByField($group_array, $group_by_field)
    {
        $arr = array();
        foreach ($group_array as $key => $item) {
            $arr[$item[$group_by_field]][$key] = $item;
        }
        ksort($arr, SORT_NUMERIC);
        return $arr;
    }
}

if (!function_exists('get_file_type')) {

    function get_file_type($file_path)
    {
        switch (strtolower(pathinfo($file_path, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                return 'image/jpeg';
            case 'png':
                return 'image/png';
            case 'gif':
                return 'image/gif';
            case 'bmp':
                return 'image/bmp';
            case 'pdf':
                return 'application/pdf';
            case 'doc':
                return 'application/msword';
            case 'docx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            case 'xls':
                return 'application/vnd.ms-excel';
            case 'xlsx':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            case 'ppt':
                return 'application/vnd.ms-powerpoint';
            case 'pptx':
                return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
            default:
                return 'application/octet-stream';
        }
    }
}

if (!function_exists('bnToen')) {

    function bnToen($value)
    {
        $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
        return $output = str_replace($bn_digits, range(0, 9), $value);
    }
}
if (!function_exists('enTobn')) {

    function enTobn($value)
    {
        $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        return str_replace($en, $bn, $value);
    }
}
if (!function_exists('getTokenValue')) {

    function getTokenValue($length)
    {
        $token = "";
        $codeAlphabet = "012345678901234567890123456789";

        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[rand(0, $max)];
        }
        return $token;
    }
}

if (!function_exists('getIP')) {
    function getIP()
    {
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
if (!function_exists('json2Array')) {
    function json2Array($data)
    {
        return json_decode($data, true);
    }
}

if (!function_exists('getBrowser')) {
    function getBrowser(): array
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern,
        );
    }
}

if (!function_exists('responseFormat')) {
    function responseFormat($status = 'error', $data = '', $options = []): array
    {
        $response = [''];
        if (!empty($status)) {
            if ($status == 'success') {
                $response = [
                    'status' => $status,
                    'data' => $data,
                ];
            } elseif ($status == 'error') {
                $response = [
                    'status' => $status,
                    'message' => $data,
                ];
                if (!empty($options) && !empty($options['details'])) {
                    $response['details'] = $options['details'];
                }
                if (!empty($options) && !empty($options['reason'])) {
                    $response['reason'] = $options['reason'];
                }
            }
            if (!empty($options) && !empty($options['code'])) {
                $response['code'] = $options['code'];
            }
        }
        return $response;
    }
}

if (!function_exists('formatRequestHeader')) {
    function formatRequestHeader($header)
    {
        $response = [];
        if (!empty($header)) {
            foreach ($header as $key => $val) {
                $response[] = $key . ': ' . $val;
            }
        }
        return $response;
    }
}

if (!function_exists('toJson')) {
    function toJson($context, $response, $code = 200, $options = [])
    {
        return $context->withStatus($code)
            ->withType('application/json')
            ->withStringBody(json_encode($response, JSON_UNESCAPED_UNICODE));
    }
}

if (!function_exists('isSuccess')) {
    function isSuccess($arr, $key = 'status', $val = 'success'): bool
    {
        if ((array_key_exists('status', $arr)) && ($arr[$key] == $val)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('singleDataToArr')) {
    function singleDataToArr($data): array
    {
        return is_array($data) ? $data : [$data];
    }
}

if (!function_exists('setAPIVersionError')) {
    function setAPIVersionError(): \Illuminate\Http\JsonResponse
    {
        return response()->json(responseFormat('error', 'API version not found.'));
    }
}

if (!function_exists('setCustomAttachmentName')) {
    function setCustomAttachmentName($file_name, $custom_file_name = '')
    {
        if (!empty($file_name)) {
            $explode_name = explode('.', $file_name);
            if (!empty($explode_name) && isset($explode_name[1])) {
                //extension and main name separated
                if (!empty($custom_file_name)) {
                    // as custom name is present no need to show real file name in response
                    $file_name = $custom_file_name . '.' . $explode_name[1];
                } else {
                    // hacker can guess file path from file name. setting date time as file name
                    $file_name = 'CAG-' . Date('Y-m-d-H-i-s') . '.' . $explode_name[1];
                }
            }
        }
        return $file_name;
    }
}

if (!function_exists('isJson')) {
    function isJson($string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('json_encode_unicode')) {
    function json_encode_unicode($string)
    {
        return json_encode($string, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('json_encode_escaped')) {
    function json_encode_escaped($string)
    {
        return json_encode($string, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (!function_exists('explodeAndMakeArray')) {
    function explodeAndMakeArray($data, $expect = 'string')
    {
        if (!empty($data)) {
            $data = explode(",", $data);
            if ($expect == 'int') {
                $data = array_map(function ($id) {
                    return (int)$id;
                }, $data);
            } else {
                $data = array_map(function ($id) {
                    return $id;
                }, $data);
            }

        }
        return $data;
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $lang = 'en', $separator = '/')
    {
		date_default_timezone_set('Asia/Dhaka');
        if (!empty($date) || $date != '') {
            $date = bnToen($date);
            if ($lang == 'bn') {
                $date = enToBn(date('d' . $separator . 'm' . $separator . 'Y', strtotime($date)));
            } else {
                $date = date('d' . $separator . 'm' . $separator . 'Y', strtotime($date));
            }
        }
        return $date;
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($date_time, $lang = 'en', $separator = '/')
    {
        date_default_timezone_set('Asia/Dhaka');
        if (!empty($date_time) || $date_time != '') {
            $date_time = bnToen($date_time);
            if ($lang == 'bn') {
                $date_time = enToBn(date('d' . $separator . 'm' . $separator . 'Y g:i A', strtotime($date_time)));
            } else {
                $date_time = date('d' . $separator . 'm' . $separator . 'Y g:i A', strtotime($date_time));
            }
        }
        return $date_time;
    }
}

function base64_url_encode($val): string
{
    return strtr(base64_encode($val), '+/=', '-_,');
}

function base64_url_decode($val): string
{
    return base64_decode(strtr($val, '-_,', '+/='));
}

if (!function_exists('makeEncryptedData')) {
    function makeEncryptedData($string = '', $options = []): string
    {
        if (is_object($string)) {
            print_r($string);
            die;
        }
        try {
            $cipher = !empty($options['method']) ? $options['method'] : 'AES-128-CBC';
            $key = !empty($options['key']) ? $options['key'] : config('cag_amms_config.secret_key');
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $ciphertext_raw = openssl_encrypt($string, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
            $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
            $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
            return $ciphertext;
        } catch (\Exception $ex) {
        }
        return '';
    }
}
if (!function_exists('getDecryptedData')) {
    function getDecryptedData($encrypt_string = '', $options = [])
    {
        try {
            $cipher = !empty($options['method']) ? $options['method'] : 'AES-128-CBC';
            $key = !empty($options['key']) ? $options['key'] : config('cag_amms_config.secret_key');
            $c = base64_decode($encrypt_string);
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = substr($c, 0, $ivlen);
            $hmac = substr($c, $ivlen, $sha2len = 32);
            $ciphertext_raw = substr($c, $ivlen + $sha2len);
            $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
            if (hash_equals($hmac, $calcmac)) {
                return $original_plaintext;
            }
        } catch (\Exception $ex) {
        }

        return '';
    }
}

if (!function_exists('numberConvertToBnWord')) {
    function numberConvertToBnWord($number): string
    {
        $number_convert = new \App\Helpers\NumberConversionToBn();
        return $number_convert->numToWord($number);
    }
}

if (!function_exists('readableFileSize')) {
    function readableFileSize($bytes): string
    {
        $units = ['B', 'KiB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}

if (!function_exists('arryAortAsc')) {
    function arryAortAsc($a,$b)
    {
        return ($a['employee_grade'] > $b['employee_grade']);
    }
}

if (!function_exists('arryAortDesc')) {
    function arryAortDesc($a,$b)
    {
        return ($a['employee_grade'] < $b['employee_grade']);
    }
}

/********************** CURRENCY FORMAT START **********************/
if (!function_exists('currency_format')) {
    function currency_format($input)
    {
        switch ('##,###.##') {
            case '##,###.##':
                return _currency_2_3_style($input,1);
                break;
            case '##,##.##':
                return _currency_2_2_style($input);
                break;
            case "###,###.##":
                return _currency_3_3_style($input);
                break;
            default:
                return $input;
        }
    }
}

if (!function_exists('_currency_2_3_style')) {
    function _currency_2_3_style($num,$has_decimal_place=0)
    {
        $decimal_places = 2;

        $pos = strpos((string)$num, ".");
        if ($pos === false) {
            $decimalpart = null;
        } else {
            $decimalpart = substr($num, $pos + 1, $decimal_places);
            $num = substr($num, 0, $pos);
        }

        if (strlen($num) > 3) {
            $last3digits = substr($num, -3);
            $numexceptlastdigits = substr($num, 0, -3 );
            $formatted = _currency_2_3_style_makecomma($numexceptlastdigits);

            if ($has_decimal_place == 1){
                if ($decimalpart){
                    $stringtoreturn = $formatted . "," . $last3digits . "." . $decimalpart ;
                }else{
                    $stringtoreturn = $formatted . "," . $last3digits;
                }
            }else{
                $stringtoreturn = $formatted . "," . $last3digits;
            }
        } elseif (strlen($num) <= 3) {
            if ($has_decimal_place == 1){
                if ($decimalpart){
                    $stringtoreturn = $num . "." . $decimalpart;
                }else{
                    $stringtoreturn = $num;
                }
            }else{
                $stringtoreturn = $num;
            }
        }

        if (substr($stringtoreturn, 0, 2) == "-,") {
            $stringtoreturn = "-" . substr($stringtoreturn, 2);
        }
        return $stringtoreturn;
    }
}

if (!function_exists('_currency_2_3_style_makecomma')) {
    function _currency_2_3_style_makecomma($input)
    {
        if (strlen($input) <= 2) {
            return $input;
        }
        $length = substr($input, 0, strlen($input) - 2);
        $formatted_input = _currency_2_3_style_makecomma($length) . "," . substr($input, -2);
        return $formatted_input;
    }
}


/********************** ##,##.## FORMAT **********************/

if (!function_exists('_currency_2_2_style')) {
    function _currency_2_2_style($num)
    {
        $decimal_places = 2;

        $pos = strpos((string)$num, ".");
        if ($pos === false) {
            if ($decimal_places == 2) {
                $decimalpart = "00";
            } else {
                $decimalpart = "000";
            }
        } else {
            $decimalpart = substr($num, $pos + 1, $decimal_places);
            $num = substr($num, 0, $pos);
        }

        if (strlen($num) > 2) {
            $last2digits = substr($num, -2);
            $numexceptlastdigits = substr($num, 0, -2);
            $formatted = _currency_2_2_style_makecomma($numexceptlastdigits);
            $stringtoreturn = $formatted . "," . $last2digits . "." . $decimalpart;
        } elseif (strlen($num) <= 2) {
            $stringtoreturn = $num . "." . $decimalpart ;
        }

        if (substr($stringtoreturn, 0, 2) == "-,") {
            $stringtoreturn = "-" . substr($stringtoreturn, 2);
        }
        return $stringtoreturn;
    }
}

if (!function_exists('_currency_2_2_style_makecomma')) {
    function _currency_2_2_style_makecomma($input)
    {
        if (strlen($input) <= 2) {
            return $input;
        }
        $length = substr($input, 0, strlen($input) - 2);
        $formatted_input = _currency_2_2_style_makecomma($length) . "," . substr($input, -2);
        return $formatted_input;
    }
}


/********************** ###,###.## FORMAT **********************/
if (!function_exists('_currency_3_3_style')) {
    function _currency_3_3_style($num)
    {
        $decimal_places = 0;
        return number_format($num, $decimal_places, '.', ',');
    }
}

/********************** CURRENCY FORMAT END **********************/

/********************** GET WORKING DAYS **********************/
if (!function_exists('getWorkingDays')) {
    function getWorkingDays($startDate, $endDate, $holidays)
    {
        // do strtotime calculations just once
        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);


        //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
        //We add one to inlude both dates in the interval.
        $days = ($endDate - $startDate) / 86400 + 1;

        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);

        //It will return 1 if it's Monday,.. ,7 for Sunday
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);

        //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
        //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        } else {
            // (edit by Tokes to fix an edge case where the start day was a Sunday
            // and the end day was NOT a Saturday)

            // the day of the week for start is later than the day of the week for end
            if ($the_first_day_of_week == 7) {
                // if the start date is a Sunday, then we definitely subtract 1 day
                $no_remaining_days--;

                if ($the_last_day_of_week == 6) {
                    // if the end date is a Saturday, then we subtract another day
                    $no_remaining_days--;
                }
            } else {
                // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
                // so we skip an entire weekend and subtract 2 days
                $no_remaining_days -= 2;
            }
        }

        //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
        $workingDays = $no_full_weeks * 5;
        if ($no_remaining_days > 0) {
            $workingDays += $no_remaining_days;
        }

        //We subtract the holidays
        foreach ($holidays as $holiday) {
            $time_stamp = strtotime($holiday);
            //If the holiday doesn't fall in weekend
            if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N", $time_stamp) != 6 && date("N", $time_stamp) != 7)
                $workingDays--;
        }

        return $workingDays;
    }
}

if (!function_exists('getWorkingDates')) {
    function getWorkingDates($startDate, $total_day, $holidays=[]){
        $weekend = array('Fri','Sat');
        $date = new DateTime("$startDate");
        $nextDay = clone $date;
        $i = 0; // We have 0 future dates to start with
        $nextDates = array(); // Empty array to hold the next 3 dates
        while ($i < $total_day)
        {
            $nextDay->add(new DateInterval('P1D')); // Add 1 day
            if (in_array($nextDay->format('m-d'), $holidays)) continue; // Don't include year to ensure the check is year independent
            // Note that you may need to do more complicated things for special holidays that don't use specific dates like "the last Friday of this month"
            if (in_array($nextDay->format('D'), $weekend)) continue;
            // These next lines will only execute if continue isn't called for this iteration
            $i++;
            $nextDates[] = $nextDay->format('Y-m-d');
        }
        return $nextDates;
    }

}
