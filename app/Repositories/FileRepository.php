<?php

namespace App\Repositories;
use App\Models\Course;

/**
 * Description of FileRepository
 *
 * @author pawel
 */
class FileRepository {
    
    /**
     * 
     * @param Course $course
     * @return \Illuminate\Support\Collection
     */
    public function forCourse(Course $course){
        
        return \App\Models\File::where('course_id', $course->id)
                    ->orderBy('name', 'asc')
                    ->get();
        
    }
    /**
     * 
     * @param Course $course
     * @param array $ids
     * @return @return \Illuminate\Support\Collection
     */
    public function forCourseAndIdNotIn(Course $course, array $ids){
        return \App\Models\File::where("course_id", $course->id )
                           ->whereNotIn("id", $ids)
                           ->get();
    }
    
    public function countForCourse(Course $course){
        return \App\Models\File::where("course_id", $course->id )
                    ->count();
    }
}
