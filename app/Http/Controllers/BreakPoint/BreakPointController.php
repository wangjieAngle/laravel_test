<?php

namespace App\Http\Controllers\BreakPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BreakPointController extends Controller
{
    //

    public function uploadGet()
    {
        /*header('Content-type: text/plain; charset=utf-8');
        header('Range: bytes=1-80');*/
//        var_dump($_SERVER);
        $file_path = public_path();
        $file_path .= "/img/qianbao_20181106_164755.png";
        $speed = 512;//此参数为下载最大速度
        $pos = strrpos($file_path, "/");
        $file_name = substr($file_path, $pos+1);
        $file_size = filesize($file_path);
        $ranges = $this->getRange($file_size);
        var_dump($ranges);exit;
        $fh =  fopen($file_path, "rb");
        header('Cache-control: public');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$file_name);
        if ($ranges != null) {
            header('HTTP/1.1 206 Partial Content');
            header('Accept-Ranges: bytes');
            header(sprintf('Content-Length: %u',$ranges['end'] - $ranges['start']));
            header(sprintf('Content-Range: bytes %s-%s/%s', $ranges['start'], $ranges['end'], $file_size));
            fseek($fh, sprintf('%u',$ranges['start']));
        }else{
            header("HTTP/1.1 200 OK");
            header(sprintf('Content-Length: %s', $file_size));
        }
        while(!feof($fh))
        {
            echo  fread($fh, round($speed*1024, 0));
            ob_flush();
            sleep(1);
        }
        ($fh != null) && fclose($fh);
    }


    /** $file_size  文件大小 */
    public function getRange($file_size){
//        var_dump($file_size);
        $range = isset($_SERVER['HTTP_RANGE'])?$_SERVER['HTTP_RANGE']:null;
        if(!empty($range)){
            $range = preg_replace('/[\s|,].*/', '', $range);
            var_dump($range);
            $range = explode('-',substr($range,6));
            var_dump($range);
            if (count($range) < 2 ) {
                $range[1] = $file_size;
            }
            var_dump($range);
            $range = array_combine(array('start','end'),$range);
            var_dump($range);
            if (empty($range['start'])) {
                $range['start'] = 0;
            }
            if (!isset ($range['end']) || empty($range['end'])) {
                $range['end'] = $file_size;
            }
            return $range;
        }
        return null;
    }


    public function uploadGetHtml()
    {
        $data = ["name" => 'jiege'];
        return view('BreakPoint/breakpoint', $data);
    }
}
