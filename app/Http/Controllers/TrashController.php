<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TrashController;
use App\Models\Movie;
use Illuminate\support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use DB;

class TrashController extends Controller
{
    public function index(){
        $movie = Movie::onlyTrashed()->get();

        return view('admin.trash.index', compact('movie'));
    }

    public function allRestore(Request $request){
        $movie = Movie::onlyTrashed();
        $movie->restore();
        
        return redirect('/admin/movie');
    }

    public function restore(Request $request){
        $movie = Movie::onlyTrashed()->where('id',$request->id);
        $movie->restore();
        
        return redirect('/admin/movie');
    }

    public function delete(Request $request){
        $movie = Movie::onlyTrashed()->where('id',$request->id);
        $movie->forceDelete();
        
        return redirect('/admin/movie');
    }
}
