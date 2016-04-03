<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Description of CoursePolicy
 *
 * @author pawel
 */
class CoursePolicy {
    
    public function destroy(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }
    
    public function edit(User $user, Course $course)
    {
        return $user->id === $course->user_id;
    }
    
}
