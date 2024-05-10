<?php

namespace App\Services;

use App\Repositories\BookRepository;



class BookService 
{
protected $repo;
   public function __construct(BookRepository $repo)
    {
      $this->repo = $repo;
    }
    public function indexService()
    {         
        $books = $this->repo->AllBook();
        $gategories = $this->repo->AllGategory();
        $sub_gategories = $this->repo->AllSubGategory();
       
        return view('books.index',compact('books','gategories','sub_gategories'));
            // ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function createService()
    {
      $gategories = $this->repo->AllGategory();
      $sub_gategories = $this->repo->AllSubGategory();
      return view('Books.create',compact('gategories','sub_gategories'));
    }
    public function stroecreateService($request)
    {  
     $this->repo->Storebook($request);
     return redirect()->route('books.index')
                   ->with('success','Book created successfully.');
    }

    public function editService($book)
    {
      $gategories = $this->repo->AllGategory();
      $sub_gategories = $this->repo->AllSubGategory();
        return view('Books.edit',compact('book','gategories','sub_gategories'));
    }

    public function updateService( $request,$Book)
    {
       $this->repo->Updateebook($request,$Book);
    
        return redirect()->route('books.index')
                        ->with('success','Book updated successfully');
    }

    public function destroyService($Book)
    {
        $Book->delete();
    
        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }

}

