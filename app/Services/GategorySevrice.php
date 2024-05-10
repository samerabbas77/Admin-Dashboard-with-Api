<?php

namespace App\Services;

use App\Repositories\GategoryRepository;

class GategorySevrice 
{
    protected $repo;
    public function __construct(GategoryRepository $repo)
    {
        $this->repo = $repo;       
    }
    public function store_gategoryService($request)
    {
        $this->repo->createGategoryRepo($request);
        return redirect()->route('books.index')
                        ->with('success','Gategory created successfully');
    }


    public function create_sub_gategoryService()
    {
        $gategories = $this->repo->ALLGategoryRepo();
        return view('gategory.create-subgategory',compact('gategories'));
    }


    public function store_sub_gategory($request)
    {
        $this->repo->createSubGategoryRepo($request);
        return redirect()->route('books.index')
                        ->with('success','Gategory created successfully');
    }
}
