<?php
    
namespace App\Http\Controllers;
    
use index;
use App\Models\Book;
use App\Models\Gategory;
use App\Models\SubGategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\BookService;

class BookController extends Controller
{ 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $service;
    function __construct(BookService $service)
    {
        $this->service =  $service;
         //$this->middleware('permission:book-list|book-create|book-edit|book-delete',['only' => ['index','edit','store','update','destroy','create']]);
         $this->middleware('permission:book-list', ['only' => ['index','show']]);
         $this->middleware('permission:book-create', ['only' => ['create','store']]);
         $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book-delete', ['only' => ['destroy']]);

      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->service->indexService();
    
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->service->createService();
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
      
        return $this->service->stroecreateService($request);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('Books.show',compact('book'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return $this->service->editService($book);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $Book)
    {
       return $this->service->updateService( $request,$Book);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $Book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $Book)
    {
        return $this->service->destroyService($Book);
    }
}