<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Course;
use File;
use Response;
/**
 * @author Pawel Kopec
 */
class StudyController extends Controller{
    
    /**
     * 
     * @param Request $request
     * @param Course $course
     * @return view
     */
    public function index(Request $request, Course $course) {
        
        $rep = new \App\Repositories\FileRepository();
        return view('study.index', [
            'course' => $course,
            'files'  => $rep->forCourse($course)
        ]);
        
    }
    
    /**
     * 
     * @param Request $request
     * @param \App\Models\File $file
     * @return Response
     */
    public function image(Request $request, \App\Models\File $file){
        
        $img = File::get($file->file);
        $type = File::mimeType($file->file);
        $response = Response::make($img, 200);
        $response->header("Content-Type", $type);
        return $response;
        
    }
    
    /**
     * 
     * @param Request $request
     * @param Course $course
     * @return view
     */
    public function test(Request $request, Course $course){
        
        $rep   = new \App\Repositories\FileRepository();
        $files = $rep->forCourse($course);
        return view('study.test', [
            'course' => $course,
            'files'  => $files->shuffle()->toJson()
        ]);
        
    }
    
    
}
