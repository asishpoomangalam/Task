@extends('layouts.master_auth')
 
@section('content')
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Edit Product</h4>
              </div>
                      @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif
              <div class="card-body">
                <form action="/updateproduct/{{ $product->id }}" id="proform" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                	
                	<div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" required name="title" value="{{ $product->title }}" >
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Quantity</label>
                        <input type="number" class="form-control" id="qty" required name="qty" value="{{ $product->qty }}" >
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step=".01" required value="{{ $product->price }}" >
                    </div>
                    @if($product->image!="")
                    <div class="form-group">
                    <img src="{{ asset('images/'.$product->image ) }}" class="img-fluid" />
                    <label for="remove">Remove Image</label>
                    <input type="checkbox" class="form-control" id="remove" name="remove" value="Y" >
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image" >
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control myeditor">{{ $product->description }}</textarea>
                    </div>
                    
                    
              		
                    
                    
                    
                    
                    
                    <button type="submit" class="btn btn-success" id="butPro">Update</button>
                    <a href="/productlists" class="btn btn-danger">Cancel</a>
                </form>
              </div>
            </div>
          </div>
          
        </div>
@endsection

@section('scripts')

@endsection