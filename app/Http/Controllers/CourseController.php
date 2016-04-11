<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories;
use App\Http\Requests;
use App\Models\Course;

/**
 * @author Pawel Kopec paweelkopec@gmail.com
 */
class CourseController extends Controller{
    /**
     *
     * @var Repositories\CourseRepository
     */
    protected $curses;
    protected $files;
    
    public function __construct(Repositories\CourseRepository $curses){
        $this->middleware('auth');
        $this->curses = $curses;
        $this->files  = new Repositories\FileRepository();
    }
    
     /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request) {
        return view('courses.index', [
            'curses' => $this->curses->forUser($request->user()),
            'categories' => \App\Models\Category::all()
        ]);

    }
    
    /**
     * Create a new curse.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request){
        
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $path = storage_path("courses/");

        foreach($_FILES['images']["name"]["file"] as $k => $name){
            
            $target = $path. basename($name);
            $imageFileType = pathinfo($target,PATHINFO_EXTENSION);
            $check = getimagesize($_FILES['images']["tmp_name"]["file"][$k]);
            if(!$check)
                throw new \Exception (sprintf("File %s is not an image.",$name ));

            if($_FILES['images']["size"]["file"][$k] > 500000*20)
                throw new \Exception (sprintf("File %s is too large.",$name ));

            $type = $_FILES['images']["type"]["file"][$k];
            if(!in_array($type, array('image/jpg', 'image/jpeg','image/png','image/gif')))
                throw new \Exception ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
        
        $id = $curse = $request->user()->curses()->create([
            'name'   => $request->name,
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id
        ])->id;
        

        foreach($_FILES['images']["name"]["file"] as $k => $name){
            $tmp_name= $_FILES['images']["tmp_name"]["file"][$k];
            $type = $_FILES['images']["type"]["file"][$k];
            $ex = explode("/", $type );
            $ex = end($ex);
            $name = $request->images['name'][$k];
            $fileName = "{$path}/{$id}_$name.{$ex}";
            $file = new \App\Models\File();
            $file->course_id = $id;
            $file->name = $name;
            $file->file = $fileName;
            $file->save();
            move_uploaded_file($tmp_name, $fileName);
        }

        return redirect('/courses');
    }
    
    public function destroy(Request $request, Course $course){

        $this->authorize('destroy', $course);

        //delete files
        foreach($this->files->forCourse($course) as $file){
            try{
                unlink($file->file);
                
            } catch (\Exception $ex) {

            }
            $file->delete();
        }
        
        $course->delete();

        return redirect('/courses');
    }

    public function detail(Request $request, Course $course){
        return view('courses.detail', [
            'course' => $course,
            'categories' => \App\Models\Category::all(),
            'files' =>  $this->files->forCourse($course)
            
        ]);
    }
    
    public function edit(Request $request, Course $course){
        
        $this->authorize('edit', $course);
        $course->name = $request->name;
        $course->category_id = $request->category_id;
        $course->save();
        $ids= array();
        foreach($request->images['name'] as $id => $name ){
            $file =  \App\Models\File::find($id);
            $file->name = $name;
            $file->save();
            $ids[]=(int) $id;
        }
        //delete files
        foreach($this->files->forCourseAndIdNotIn($course, $ids) as $file){
            unlink($file->file);
            $file->delete();
        }
        //new files
        $path = storage_path("courses/");
        foreach($_FILES['new_images']["name"]["file"] as $k => $name){
            if(empty($name))
                continue;
            $target = $path. basename($name);
            $imageFileType = pathinfo($target,PATHINFO_EXTENSION);
            $check = getimagesize($_FILES['new_images']["tmp_name"]["file"][$k]);
            if(!$check)
                throw new \Exception (sprintf("File %s is not an image.",$name ));

            if($_FILES['new_images']["size"]["file"][$k] > 500000*20)
                throw new \Exception (sprintf("File %s is too large.",$name ));

            $type = $_FILES['new_images']["type"]["file"][$k];
            if(!in_array($type, array('image/jpg', 'image/jpeg','image/png','image/gif')))
                throw new \Exception ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
        
        foreach($_FILES['new_images']["name"]["file"] as $k => $name){
            if(empty($name))
                continue;
            $tmp_name= $_FILES['new_images']["tmp_name"]["file"][$k];
            $type = $_FILES['new_images']["type"]["file"][$k];
            $ex = explode("/", $type );
            $ex = end($ex);
            $name = $request->new_images['name'][$k];
            $fileName = "{$path}/{$id}_$name.{$ex}";
            $file = new \App\Models\File();
            $file->course_id = $course->id;
            $file->name = $name;
            $file->file = $fileName;
            $file->save();
            move_uploaded_file($tmp_name, $fileName);
        }
        
        return redirect('/courses');
        
        
    }
    
}
