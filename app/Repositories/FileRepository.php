<?php

namespace App\Repositories;
use App\Models\Course;

/**
 * Description of FileRepository
 *
 * @author pawel
 */
class FileRepository {
    
    public function forCourse(Course $course){
        
        return \App\Models\File::where('course_id', $course->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
        
    }
    
    public function forCourseAndIdNotIn(Course $course, array $ids){
        return \App\Models\File::where("course_id", $course->id )
                           ->whereNotIn("id", $ids)
                           ->get();
    }
}
