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
    
    public function __construct(Repositories\CourseRepository $curses){
        $this->middleware('auth');
        $this->curses= $curses;
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

        $request->user()->curses()->create([
            'name'   => $request->name,
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id
            
        ]);

        return redirect('/courses');
    }
    
    public function destroy(Request $request, Course $course){

        $this->authorize('destroy', $course);

        $course->delete();

        return redirect('/courses');
    }
    
    
}
