<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locus;

class LocusController extends Controller
{

    public function index(Request $request, $id)
    {
        $locus = Locus::select('locuses.*')
            ->where('locuses.id', $id)
            ->first();
        return view('locus', [
            'locus' => $locus
        ]);
    }

    public function input(Request $request)
    {
        return view('locus_save', [
          'post_id' => $request->post_id
        ]);
    }

    public function save(Request $request)
    {
        $validator = $request->validate([
        ]);

        $locus = new Locus;
        $locus->name = $request->name;
        $locus->content = $request->content;
        $locus->post_id = $request->post_id;
        $locus->created_user_id = $request->user()->id;
        $locus->updated_user_id = $request->user()->id;
        $locus->save();

        return redirect('/locus/'.$locus->id);
    }
}
