<?php
namespace App\Http\Traits;

    trait ApiResponses
    {

      public function indexResponse($book =null,$gategory,$subGategory)
        {
            return response()->json([
                'Books'           =>$book,
                'Categories'      =>$gategory,
                'Sub Categories'  =>$subGategory,
                'message'         => "All Book , Their Categories and Sub Categories successfully sent",
                'status'=> 200,
            ],200);
        }  
        public function gategoryIndexRespons($gategory,$subGategory)
        {
            return response()->json([
                'Categories'      =>$gategory,
                'Sub Categories'  =>$subGategory,
                'message'         => "All Categories and Sub Categories successfully sent",
                'status'=> 200,
            ],200);
        }
        public function filterRespons($book)
        {
            return response()->json([
                'Book'      =>$book,
                'message'         => "Search By Category successfully sent",
                'status'=> 200,
            ],200);
        }

        public function filterSubRespons($book)
        {
            return response()->json([
                'Book'      =>$book,
                'message'         => "Search By Sub Category successfully sent",
                'status'=> 200,
            ],200);
        }
        
       public function faildLoginResponse()
        {
            return response()->json([
                'message' => 'Invalid login details',
                'status'  => 'false',
                'code'    => 401
            ], 401);
        }

        public function loginResponse($data,$token)
        {
            return response()->json([
                'user'         =>$data,
                'message'      =>"Login Success",
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'code'         => 202,
            ]);
        }

        public function regesterResponse($data)
        {
            return response()->json([
                'user'         =>$data,
                'message'      =>"Regester and Give Token Successfully",
                'access_token' => 'Login To get Token!',
                'token_type' => 'Bearer',
                'code'         => 202,
            ]);
        }
    
        public function logoutResponse($data)
        {
            return response()->json([
                'user'      =>$data,
                'status'    =>'true',
                'Message'   =>'Current Uesr Logout',
            ]);
        }


       
        public function storeFavoriteResponse($user,$book)
        {
            return response()->json([
                'Book'            =>$book->name,
                'User'            =>$user->name,
                'Favorite'        =>$user->favorite,
                'message'         => "Your Book saved in Your Favorite Successfully",
                'status'=> 200,
            ],200);
        }

        public function updateFavoriteResponse($user,$book)
        {
            return response()->json([
                'Book'            =>$book->name,
                'User'            =>$user->name,
                'Favorite'        =>$user->favorite,
                'message'         => "Your Book Removed From Your Favorite Successfully",
                'status'=> 200,
            ],200);
        }

        
        public function createReviewResponse($review,$name)
        {
            return response()->json([
                'Book'            =>$review->book->name,
                'Book Review'     =>$review,
                'Star'            =>$review->star,
                'User '           =>$name,
                'message'         => "Your Review saved  Successfully",
                'status'=> 200,
            ],200);
        }

        public function excistBookInFavoriteArray($n)
        {
           $array = array(                
                'status'   =>false,
                'message'  => "This Book Already Excist in your Favorite",
                'code'     => 409,
    
                );

            if($n == 2)
            {
                $array['message']="This Book Not Excist in your Favorite";
            }

            return $array;

        }


        public function deleteReviewResponse($review)
        {
            return response()->json([
                'Book'            =>$review->book->name,
                'Review'          =>$review->content,
                'message'         => "Your Review on This Book is Deleted Successfully",
                'status'=> 200,
            ],200); 
        }
       
     }





?>