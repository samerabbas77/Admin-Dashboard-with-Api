<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use App\Models\Gategory;
use App\Models\SubGategory;
use App\Services\APIService;
use App\Http\Traits\ApiResponses;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\BookResource;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\FilterSubRequest;
use App\Http\Resources\GategoryResource;
use App\Http\Requests\UpdatereviewRequest;

use App\Http\Resources\SubGategoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ApiController extends Controller
{
    use ApiResponses;
   protected $service;
    public function __construct(APIService $service)
    {
      $this->service = $service; 
    }
    /**
     ********* Visitor Method***********************************
     */
    public function index()
    {//Show all books and their Categoury and Sub Category

       return $this->indexResponse(BookResource::collection(Book::all()),GategoryResource::collection(Gategory::all()),SubGategoryResource::collection(SubGategory::all())); // Group of element 
    }
    public function  gategory_index()
    {//Show all  Categoury and Their Sub Category

       return $this->gategoryIndexRespons(GategoryResource::collection(Gategory::all()),SubGategoryResource::collection(SubGategory::all())); // Group of element 
    }
   
    public function  book_filter(FilterRequest $request)
    {
      return $this->service->book_filter_Service($request);
    }
    public function  book_filter_sub(FilterSubRequest $request)
    {
       return $this->service->book_filter_sub_Service( $request) ;      

    }
   

    /**
     * ****************Member****************************
     * 
     */
   //  ****************Favorite********************
    public function store_favorite(Book $book)
    {
      return $this->service->store_favorite_Service($book);
    }

    public function update_favorite(Book $book)
    {
      return $this->service->update_favorite_service($book);
    }



//  ********************************Review**********************************

    public function review(ReviewRequest $request,Book $book)
    {
     return $this->service->reviewService($request,$book);
    }

    public function updteReview(UpdatereviewRequest $request,Book $book)
    { 
      return $this->service->updteReviewService($request,$book);   
    }
    

 public function deletReview(Book $book)
 {
   
   return $this->service->deletReviewService( $book);

 }
}
