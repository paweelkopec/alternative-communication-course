<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Description of Course
 *
 * @author pawel
 */
class Course extends Model {
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','category_id'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    /**
     * Get the user that owns the curse.
     */
    public function user()
    {
        return User::find($this->user_id);
    }
    
    public function category(){
        return Category::find($this->category_id);
    }
    
    public function countFiles(){
        $rep = new \App\Repositories\FileRepository();
        return  $rep->countForCourse($this);
    }
    
}
