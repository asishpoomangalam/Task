@extends('layouts.master_auth')
 
@section('content')
<div class="container">
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Add Product</h4>
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
                <form action="/insertproduct" method="post" id="proform" enctype="multipart/form-data">
                {{ csrf_field() }}
                	
                	<div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" required name="title" value="{{ old('title') }}" >
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Quantity</label>
                        <input type="number" class="form-control" id="qty" required name="qty" value="{{ old('qty') }}" >
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step=".01" required value="{{ old('price') }}" >
                    </div>
                    
                    <?php /*?><div id="prosize">
                    </div><?php */?>
                    
                    
                    
                    <?php /*?><div id="procolor">
                    </div><?php */?>
                    
           
                  
                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image" >
                    </div>
                    
                  
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control myeditor">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success" id="butPro">Save</button>
                    <a href="/products" class="btn btn-danger">Cancel</a>
                </form>
              </div>
            </div>
          </div>
          
        </div>
        </div>
@endsection

@section('scripts')


@endsection