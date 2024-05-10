@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show book</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $book->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                {{ $book->gategory->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Sub Category:</strong>
                {{ $book->subGategory->name }}
            </div>
        </div>        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Publisher_name:</strong>
                {{ $book->publisher_name }}
            </div>
        </div>        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Publish_date:</strong>
                {{ $book->publish_date }}
            </div>
        </div>
    </div>
@endsection
<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>