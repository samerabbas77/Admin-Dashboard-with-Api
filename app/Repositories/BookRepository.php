<?php
    namespace App\Repositories;

    use App\Models\Book;
    use App\Models\Gategory;
    use App\Models\SubGategory;

    class BookRepository
    {
        public function AllBook()
        {
            return $Books = Book::all();
        }
    
        public function AllGategory()
        {    
          return   $gategories  = Gategory::all();     
        }

        public function AllSubGategory()
        {
            return $sub_gategories = SubGategory::all();
        }
        public function Storebook($request)
        { 
            $subgategory = SubGategory::find($request->sub_gategory);
        
            Book::create([
            'name' => $request->name,
            'gategory_id' =>  $subgategory->gategory_id,	       
            'subGategory_id' =>  $request->sub_gategory,	       
            'publisher_name' => $request->publisher_name,	       
            'publish_date' =>$request->publish_date
            ]);
            return true;
        }
        public function Updateebook($request,$Book)
        {
            $Book->update([           
                'name' => $request->name,
                'gategory_id' =>  $request->gategory,	       
                'subGategory_id' =>  $request->sub_gategory,	        
                'publisher_name' => $request->publisher_name,	       
                'publish_date' =>$request->publish_date
            ]);
            return true;
        }

    }