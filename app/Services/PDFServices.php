<?php

namespace App\Services;

use App\Traits\ApiHeart;

class PDFServices
{
    use ApiHeart;

    public function generatePDF($params)
    {
        $response = $this->initPDFHttp()->post(config('cag_pdf.generate-pdf'),$params)->json();
        if ($response['status'] == 'success'){
            $response = json_decode(base64_decode($response['data']),true);
            $data['status'] = 'success';
            $data['file_path'] = $response['file_dir'].''.$response['file_name'];
            return $data;
        }
        else{
            $data['status'] = 'error';
            $data['file_path'] = '';
            return $data;
        }
    }
}
