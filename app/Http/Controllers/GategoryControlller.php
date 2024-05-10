<?php

namespace App\Http\Controllers;

use App\Models\Gategory;
use App\Models\SubGategory;
use Illuminate\Http\Request;
use App\Services\GategorySevrice;
use App\Http\Requests\StoreGategoryRequest;
use App\Http\Requests\StoreSubGategoryRequest;

class GategoryControlller extends Controller
{
    protected $service;
    public function __construct(GategorySevrice $service)
    {
        $this->service = $service;
        $this->middleware('permission:gategory-add',['create_gategory','store_gategory']);
        $this->middleware('permission:sub_gategory-add',['create_sub_gategory','store_sub_gategory']);
    }
    public function create_gategory()
    {
        return view('gategory.create_gategory');
    }
    public function store_gategory( StoreGategoryRequest $request)
    {
       return $this->service->store_gategoryService($request);
    }

    public function edit_gategory(Gategory $gategory)
    {
        return view('gategory.edit_gategory',compact('gategory'));
    }
    public function update_gategory(StoreGategoryRequest $request,Gategory $gategory)
    {
        $gategory->update([
            'name'         =>$request->name ,
            'descraption'  =>$request->descraption,

        ]);
        return redirect()->route('books.index')->with('success','Category Updated Succefully');
    }


    public function destroy_gategory(Gategory $gategory)
    {
        $gategory->delete();
    
        return redirect()->route('books.index')
                        ->with('success','Category deleted successfully');
    }


/// ........................Sub Category

    public function create_sub_gategory()
    {
        return $this->service->create_sub_gategoryService();
    }
     
    public function store_sub_gategory(StoreSubGategoryRequest $request)
    {
       return $this->service->store_sub_gategory($request);
    }


    public function edit_subgategory(SubGategory $subgategory)
    {
        return view('gategory.edit_subgategory',compact('subgategory'));
    }
    public function update_subgategory(StoreSubGategoryRequest $request,SubGategory $subgategory)
    {
        $subgategory->update([
            'name'         => $request->name ,  
        ]);
        
        return redirect()->route('books.index')->with('success','Sub Category Updated Succefully');
    }
    public function destroy_sub_gategory(SubGategory $subgategory)
    {
        $subgategory->delete();
    
        return redirect()->route('books.index')
                        ->with('success','Sub Category deleted successfully');
    }
     
    

}