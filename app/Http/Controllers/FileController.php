<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

    public function edit(Request $request)
    {
        $files = [];
        return view('file.common', [
            'files' => $files,
        ]);
    }

    public function save(Request $request)
    {
        $file_id = 1;
        return redirect('/file/'.$file_id);
    }

    public function open(Request $request, $file_id)
    {
        $file = null;
        $comments = [];
        return view('file.open', [
            'file' => $file,
            'comments' => $comments,
        ]);
    }

    public function del(Request $request, $file_id)
    {
        return redirect('/file/'.$file_id);
    }
}
