<?php

namespace App\Http\Controllers\BreakPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BreakPointController extends Controller
{
    //

    public function uploadGet()
    {
        header('Content-type: text/plain; charset=utf-8');
        header('Range: bytes=1-80');
        var_dump($_SERVER);
    }

    public function uploadGetHtml()
    {
        $data = ["name" => 'jiege'];
        return view('BreakPoint/breakpoint', $data);
    }
}
