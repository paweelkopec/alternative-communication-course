<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Course;
use File;
use Response;

class StudyController extends Controller{
    
    public function index(Request $request, Course $course) {
        
        $rep = new \App\Repositories\FileRepository();
        
        return view('study.index', [
            'course' => $course,
            'files'  => $rep->forCourse($course)
        ]);
    }
    
    public function image(Request $request, \App\Models\File $file){
        
        $img = File::get($file->file);
        $type = File::mimeType($file->file);
        $response = Response::make($img, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
    
    
}
