<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MovieController;
use Session;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Actor;
use App\Models\Director;
use App\Models\GenreMovie;
use Illuminate\support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use DB;

class MovieController extends Controller
{
    public function index(){
        $movie = Movie::all();

        return view('admin.movie.index', compact('movie'));
    }

    public function addMovies(){
        $genre = Genre::all();

        return view('admin.movie.create', compact('genre'));
    }

    public function insertMovies(Request $request){
        DB::beginTransaction();
        try{
            $file = $request->file('video');
            $file_name = str::random(4).'-'.$file->getClientOriginalName();
            $file_path = 'video';
            $file->move($file_path, $file_name);

            $movie = new Movie();

            $movie->title = $request->title;
            $movie->duration = $request->duration;
            $movie->release_date = $request->release_date;
            $movie->description = $request->description;
            $movie->story_line = $request->story_line;
            $movie->video = $file_path.'/'.$file_name;

            $movie->save();

            $arr_actor = array_filter($request->actor);
            foreach($arr_actor as $a){
                $actor = new Actor();

                $actor->name = $a;
                $actor->movie_id = $movie->id;

                $actor->save();
            }
            
            $arr_director = array_filter($request->director);
            foreach($arr_director as $d){
                $director = new Director();

                $director->name = $d;
                $director->movie_id = $movie->id;

                $director->save();
            }
            
            foreach($request->genre as $g){
                $genre_movie = new GenreMovie();

                $genre_movie->movie_id = $movie->id;
                $genre_movie->genre_id = $g;

                $genre_movie->save();
            }

            DB::commit();
            return redirect('/admin/movie');
        }catch(\Throwable $e){
            $genre = Genre::all();
            DB::rollback();
            return redirect('/admin/movie/create', compact('genre'));
        }
    }

    public function detailMovies(Request $request){
        $movie = Movie::find($request->id);
        $genres = $movie->genres;
        $directors = $movie->directors;
        $actors = $movie->actors;

        foreach($genres as $g){
            $g->genre_id = Genre::find($g->genre_id)->name;
        }

        $movie->release_date = date('d M Y H:i', strtotime($movie->release_date));

        return view('admin.movie.detail', compact('movie', 'genres', 'directors', 'actors'));
    }

    public function editMovies(Request $request){
        $genre = Genre::all();
        $movie = Movie::find($request->id);
        $genres = $movie->genres;
        $directors = $movie->directors;
        $actors = $movie->actors;

        foreach($genres as $g){
            $g->genre_name = Genre::find($g->genre_id)->name;
        }

        return view('admin.movie.edit', compact('movie', 'genres', 'genre', 'directors', 'actors'));
    }

    public function updateMovies(Request $request){
        DB::beginTransaction();
        try{
            $movie = Movie::find($request->id);

            $prevVideo = $movie->video;

            if($file = $request->file('video')){
                $file = $request->file('video');
                $file_name = str::random(4).'-'.$file->getClientOriginalName();
                $file_path = 'video';
                $file->move($file_path, $file_name);
      
                $data = [
                    'title' => $request->title,
                    'duration' => $request->duration,
                    'release_date' => $request->release_date,
                    'description' => $request->description,
                    'story_line' => $request->story_line,
                    'video' => $file_path.'/'.$file_name,
                ];
            }else{
                $data = [
                    'title' => $request->title,
                    'duration' => $request->duration,
                    'release_date' => $request->release_date,
                    'description' => $request->description,
                    'story_line' => $request->story_line,
                ];
            }

            $movie->update($data);

            Actor::where('movie_id', $movie->id)->delete();
            $arr_actor = array_filter($request->actor);
            foreach($arr_actor as $a){
                $actor = new Actor();

                $actor->name = $a;
                $actor->movie_id = $movie->id;

                $actor->save();
            }
            
            Director::where('movie_id', $movie->id)->delete();
            $arr_director = array_filter($request->director);
            foreach($arr_director as $d){
                $director = new Director();

                $director->name = $d;
                $director->movie_id = $movie->id;

                $director->save();
            }
            
            GenreMovie::where('movie_id', $movie->id)->delete();
            foreach($request->genre as $g){
                $genre_movie = new GenreMovie();

                $genre_movie->movie_id = $movie->id;
                $genre_movie->genre_id = $g;

                $genre_movie->save();
            }

            if(!empty($request->video) && !empty($prevVideo)){
                $image_path = $prevVideo;
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            DB::commit();
            return redirect('/admin/movie');
        }catch(\Throwable $e){
            $genre = Genre::all();
            DB::rollback();
            return redirect('/admin/movie/create', compact('genre'));
        }
    }

    public function deleteMovies(Request $request){
        $movie = Movie::find($request->id);
        
        $movie->delete();

        return redirect('/admin/movie');
    }
}
