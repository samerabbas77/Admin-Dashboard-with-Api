@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit book</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('books.update',$book->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" value="{{ $book->name }}" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Gategory:</strong>
					<select name="gategory" id="">
						<option value="">Choose a Main Category</option>
						@foreach($gategories as $gategory)       
							<option value="{{$gategory->id}}" <?php if($book->gategory_id == $gategory->id ) echo 'selected';?> >{{$gategory->name}}</option>   
							
						@endforeach
				</select> 
		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Sub Gategory:</strong>
		            <select name="sub_gategory" id="">
						<option value="">Choose a Sub Category</option>
						@foreach($sub_gategories as $subgategory)       
							<option value="{{$subgategory->id}}" <?php if($book->subGategory_id == $subgategory->id ) echo 'selected';?> >{{$subgategory->name}}</option>   						
						@endforeach
				</select>  		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Publisher Name:</strong>
		            <input value="{{$book->publisher_name}}" class="form-control" style="height:150px" name="publisher_name" placeholder="Publisher_name">
		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Publish Date:</strong>
		            <input value="{{$book->publisher_date}}" type="date" class="form-control" style="height:150px" name="publish_date" placeholder="Publish_date">
		        </div>
		    </div>
            
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection