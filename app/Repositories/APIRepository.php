<?php
 namespace App\Repositories;


use App\Models\Review;
use App\Models\Gategory;
use App\Models\SubGategory;
use Illuminate\Support\Facades\Auth;
    

    class APIRepository
    {
        public function searchByGategory($request)
        {
            $gategories = Gategory::where('name','LIKE','%'.$request->gategory.'%')->get();
            return $gategories;
        }

        public function searchBySubGategory($request)
        {
            $subgategories = SubGategory::where('name','LIKE','%'.$request->subgategory.'%')->get();
            return $subgategories;
        }
        
//  ********************************Review**********************************
        public function reviewSearch($book)
        {
            $review = Review::where([
                ['book_id','=',$book->id],
                ['user_id','=',Auth::id()],
             ])->first(); //using get will make review a array inside array
             return $review;

        }
   

    }
