@extends('layouts.app')
<style>
    /* Style the anchor tag to look like a link */
    .disabled-link {
        color: #999;  /* Change color to a muted grey */
        text-decoration: none;  /* Remove underline */
        cursor: default;  /* Change cursor to default (not pointer) */
    }
</style>

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>books :</h2>
            </div>
            <div class="pull-right ">
                @can('book-create')

                @if($gategories->isEmpty() || $sub_gategories->isEmpty() )      
                    <a class=" disabled-link " href="{{ route('books.create') }}" onclick="return false;"> Create New book</a>        
                @endif
                @if(!$gategories->isEmpty() && !$sub_gategories->isEmpty())
                    @if(!$sub_gategories->isEmpty())
                        <a class="btn btn-success" href="{{ route('books.create') }}"> Create New book</a>
                    @endif
                @endif    
                @endcan

                @can('gategory-add')
                <a class="btn btn-warning ml-2" href="{{ route('gategory.create') }}"> Add Category</a>     
                @endcan

                @can('sub_gategory-add')
                
                @if($gategories->isEmpty()) 
                <a class=" disabled-link " href="{{ route('gategory.create') }}" onclick="return false;"> Add Sub Category</a>        
                @endif
                @if(!$gategories->isEmpty())
                    <a class="btn btn-primary ml-2" href="{{ route('subgategory.create') }}"> Add Sub Category</a>
                @endif

               @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Publisher Name</th>
            <th>Publish Date</th>
            <th width="280px">Action</th>
        </tr>
        <?php $i = 0; 
          ?>
	    @foreach ($books as $book)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $book->name }}</td>
	        <td>{{ $book->gategory->name }}</td>
	        <td>{{ $book->subGategory->name }}</td>
	        <td>{{ $book->publisher_name }}</td>
	        <td>{{ $book->publish_date }}</td>
	        <td>
                <form action="{{ route('books.destroy', $book->id)}}" method="POST">
                    @can('book-list')
                    <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Show</a>
                    @endcan
                    @can('book-edit')
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                    @endcan

                
                    @csrf
                    @method('DELETE')
                    @can('book-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
    <?php $a = 0; 
          $b = 0;
          ?>
    <h2>Category :</h2>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Descraption</th>
            <th>Books</th>
            <th width="280px">Action</th>
            
        </tr>
	    @foreach ($gategories as $gategory)
	    <tr>
	        <td>{{ ++$a  }}</td>
	        <td>{{ $gategory->name }}</td>
	        <td>{{ $gategory->descraption }}</td>
	        <td>
                @foreach ($gategory->books as $book)   
                {{$book->name}}
                <br>
                @endforeach
            </td>
            <td>
                <form action="{{route('gategory.destroy', $gategory->id)}} " method="POST">
                    @can('book-edit')
                    <a class="btn btn-primary" href="{{route('gategory.edit', $gategory->id)}} ">Edit</a>
                    @endcan
       
                    @csrf
                    @method('DELETE')
                    @can('book-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
               
        @endforeach



    </table>
    <h2>Sub Category :</h2>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th> Main Category </th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($sub_gategories as $sub_gategory)
	    <tr>
	        <td>{{ ++$b}}</td>
	        <td>{{ $sub_gategory->name }}</td>
	        <td>{{ $sub_gategory->gategory->name }}</td>           
            <td>
                <form action="{{route('subgategory.destroy', $sub_gategory->id)}} " method="POST">
                    @can('book-edit')
                    <a class="btn btn-primary" href=" {{route('subgategory.edit', $sub_gategory->id)}}">Edit</a>
                    @endcan
       
                    @csrf
                    @method('DELETE')
                    @can('book-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
                
        @endforeach
    </table>


    <p class="text-center text-primary"><big>**Note: Please Add Category first Then Sub Gategory Then you can Add Book </big></p>


@endsection