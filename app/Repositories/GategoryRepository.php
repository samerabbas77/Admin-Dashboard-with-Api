<?php
    namespace App\Repositories;

    use App\Models\Book;
    use App\Models\Gategory;
    use App\Models\SubGategory;

    class GategoryRepository
    {
        public function createGategoryRepo($request)
        {
           Gategory::create([
                'name'=> $request->name,
                'descraption'=> $request->descraption,
            ]);
            return true;
        }
        public function ALLGategoryRepo()
        {
            $gategories  = Gategory::all();
            return $gategories;
        }
        public function createSubGategoryRepo($request)
        {
            SubGategory::create([
                'name'=> $request->name,
                'gategory_id'=> $request->gategory,
            ]);
            Return true;
        }
        
    }