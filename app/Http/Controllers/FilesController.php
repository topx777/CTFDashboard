<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    //
    public function upload()
    {
        return view('admin.challenges.filemanager');
    }
}
