<?php

namespace App\Services;

use Exception;

use App\Models\Book;
use App\Models\User;
use App\Repositories;
use App\Models\Review;
use App\Models\Gategory;
use App\Models\SubGategory;
use App\Http\Traits\ApiResponses;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\ReviewRequest;

use App\Http\Resources\BookResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\FilterSubRequest;
use App\Http\Resources\GategoryResource;
use App\Http\Resources\SubGategoryResource;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\ErrorHandler\Error\UndefinedMethodError;

//------repo
use App\Repositories\APIRepository;

use function PHPUnit\Framework\isEmpty;

class APIService 
{
    use ApiResponses;
    protected $repo;
    public function __construct(APIRepository $repo)
    {
        $this->repo = $repo ;
    }
     /**
     ********* Visitor Method***********************************
     */
    public function book_filter_Service($request)
    {             
        //Filter by  Categoury  
        $gategories= $this->repo->searchByGategory($request);
        if($gategories->isEmpty()) return response()->json('messgae:There are no Category!! ') ; 
      
        foreach($gategories as $gategory)
        {
            if(($gategory->books)->isEmpty()) return response()->json('messgae:There are no  Book in this Category!! ');;      

            foreach($gategory->books as $book)
            {   
                $idarray[]= $book->name;
            }
                  
        }
        $search = Book::whereIn('name',$idarray)->get();

        return $this->filterRespons(BookResource::collection($search),); // Group of element 
    }


    public function  book_filter_sub_Service(FilterSubRequest $request)
    {
        //Filter by Sub Categoury 
        $subgategories = $this->repo->searchBySubGategory($request);
        if($subgategories->isEmpty()) return response()->json('messgae:There are no Sub Category!! ') ;     
         
        foreach($subgategories as $subgategory)
        {
            if(($subgategory->books)->isEmpty()) return response()->json('messgae:There are no  Book in this Sub Category!! ');;      

            foreach($subgategory->books as $book)
                $idarray[]= $book->name;
        }

        $search = Book::whereIn('name',$idarray)->get();

        return $this->filterSubRespons(BookResource::collection($search),); // Group of element 
    }
    /**
     * ****************Member****************************
     * I Handle ModelNotFoundException in Exception Class
     */
   //  ****************Favorite********************
    public function store_favorite_Service($book)
    {
            $user = User::findorFail(Auth::id());
            $favorite_array=array();
            if($user->favorite)$favorite_array = $user->favorite;
               try{
                    if(!in_array($book->name, $favorite_array))
                     {
                       array_push($favorite_array,$book->name);
                     }else{
                        return $this->excistBookInFavoriteArray(1);
                     }
                  }catch(Exception $e){
                           return response()->json("Store Favorite Faild : Array error!!");
                        }   
  
           $user->update([
            'favorite'  => $favorite_array,// another way if you set 'favorite as string institof json in migration  ....'favorite'  => json_encode([1,2]),
      
           ]);
         
          
         return $this->storeFavoriteResponse(new UserResource($user),new BookResource($book));
    }


    public function update_favorite_service($book)
    {
        //
        $user = User::findorFail(Auth::id());
        $favorite_array = $user->favorite;
        try{
        if(in_array($book->name, $favorite_array))
        {
           $newarray = array_diff($favorite_array,[$book->name]);
           $newarray = array_values( $newarray);
        }else{
           return $this->excistBookInFavoriteArray(2);
        }
        }catch(Exception $e)
            {
               return response()->json(['Message'=>'Store Favorite Faild : Array error!! ','Code:'=>'505'],505) ;
            }
  
         $user->update([
          'favorite'  => $newarray,// another way if you set 'favorite as string institof json in migration  ....'favorite'  => json_encode([1,2]),
         ]);
         

        return $this->updateFavoriteResponse(new UserResource($user),new BookResource($book));
    }
    
//  ********************************Review**********************************

    public function reviewService($request,$book)
    {
        $review = $this->repo->reviewSearch($book);
         if($review)
         return ['message' => 'You hve Reveiwed This Book!!'];
      $review = Review::create([
         'content'     =>$request->content,
         'star'        =>$request->star,
         'book_id'     =>$book->id,
         'user_id'     =>Auth::id()
      ]);

      return $this->createReviewResponse(new ReviewResource($review),Auth::user()->name);
    }


    public function updteReviewService($request,$book)
    {

         $review = $this->repo->reviewSearch($book);
         if(!$review)
            return ['message' => 'You Do not hve Reveiw on This Book!!'];
         if($request->contentt) $review->content = $request->content;
         if($request->star) $review->star = $request->star;
         $review->save();
                 
         
   
         return $this->createReviewResponse(new ReviewResource($review),Auth::user()->name);
    }


    public function deletReviewService($book)
    {
        $review = $this->repo->reviewSearch($book);
         if(!$review)
         return ['message' => 'You Do not hve Reveiw on This Book!!'];
         
         $review->delete();
            
         return $this->deleteReviewResponse($review);
    }
}
