<?php

namespace App\Repositories;

use App\Models\User;


/**
 * Description of CourseRepository
 *
 * @author pawel
 */
class CourseRepository {
    
    public function forUser(User $user){
        
        return \App\Models\Course::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
    
    public function countForUser(User $user){
        return \App\Models\Course::where('user_id', $user->id)
                    ->count();
    }
}
