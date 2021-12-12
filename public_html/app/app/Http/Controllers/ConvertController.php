<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mikehaertl\wkhtmlto\Pdf;
use \imagick;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class ConvertController extends Controller
{
    public function __construct(Pdf $pdf, imagick $imgk)
    {
        $this->pdf = $pdf;
        $this->imgk = $imgk;
        $this->convertPath = storage_path('app/public/convert/');
    }

    public function index($type='index')
    {
        $data = [
            'title' => '',
            'type' => $type,
        ];
        switch ($type){
            case 'pdf':
                $data['title'] = 'PDF 변환';
                break;
            case 'image':
                $data['title'] = '이미지 변환';
                break;
            default:
                $data['title'] = '파일 변환 서비스';
                break;

        }

        return view('convert.'.$type, compact('data'));
    }

    public function process(Request $request, $type)
    {
        switch ($type){
            case 'pdf':
                $this->makePdf($request->source);
                break;
            case 'image':
                $this->convertImage($request->file('source'), $request->ext);
                break;
        }
    }

    public function makePdf($source)
    {
        $this->pdf->addPage($source);
        if (!$this->pdf->send()) {
            $error = $this->pdf->getError();
            ddd($error);
        }
    }

    public function convertImage($source, $ext)
    {
        $ext = strtolower($ext);
        $fpath = $this->getStorageDir();
        $tmp = $source->getPathname();
        $fname = uniqid().'.'.$ext;
        $dest = "$fpath/$fname";

        $this->imgk->readimage($tmp);
        $this->imgk->setResolution(300,300);
        $this->imgk->setImageFormat($ext);
        $this->imgk->writeImage($dest);

        if($ext == 'pdf'){
            header("Content-type:application/pdf");
        } else {
            header('Content-Type: image/'.$ext);
        }

        echo $this->imgk;
    }

    public function getStorageDir()
    {
        $fpath = $this->convertPath.date('Y/m/d');
        if(!is_dir($fpath)){
            mkdir($fpath, 0777, true);
        }

        return $fpath;
    }
}
