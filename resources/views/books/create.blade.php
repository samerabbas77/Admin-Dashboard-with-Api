@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New book</h2>
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


    <form action="{{ route('books.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            {{-- <strong>Category:</strong>
		            <select name="gategory" id="">
							<option value="">Choose a Main Category</option>
							@foreach($gategories as $gategory)       
								<option value="{{$gategory->id}}">{{$gategory->name}}</option>   						
							@endforeach
					</select>
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Sub Gategory :</strong>
		            <select name="sub_gategory" id="">
						<option value="">Choose a Sub Category</option>
						@foreach($sub_gategories as $subgategory)       
							<option value="{{$subgategory->id}}">{{$subgategory->name}}</option>   						
						@endforeach
				</select>         --}}
				<select name="sub_gategory">
					@foreach($gategories as $gategory)
				 	<optgroup  label={{$gategory->name}} >
						@foreach($gategory->sub_gategories as $subgategory) 
						<option value="{{$subgategory->id}}">{{$subgategory->name}}</option>
						@endforeach
					@endforeach		
				</select>
			</div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Publisher_name:</strong>
		            <input class="form-control" style="height:150px" name="publisher_name" placeholder="Publisher_name">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Publish_date:</strong>
		            <input type= "date" class="form-control" style="height:150px" name="publish_date" placeholder="Publish_date">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Create</button>
		    </div>
		</div>


    </form>



@endsection