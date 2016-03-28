<?php

namespace App\Repositories;
use App\Models\Category;

/**
 * Description of CategoryRepositor
 *
 * @author Pawel Kopec <paweelkopec@gmail.com>
 */
class CategoryRepository {
    
    public function all(){
        return Category::all()
                ->get();
    }
    
    
    
}
