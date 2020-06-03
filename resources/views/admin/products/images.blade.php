@extends('layouts.master')

@section('title')
Product Images | Ecommerce
@endsection

@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure. You want to delete this data?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="" class="btn btn-primary">Yes Delete It...</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Product Images ({{$product->title}})</h4>
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
              @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <form action="/admin/insert-productimages" method="post" id="proform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{$id}}" />
                    <div class="form-group">
                        <?php /*?><label for="image">Upload Multiple Images(5 at a time)</label><?php */?>
                        <span class="btn btn-raised btn-round btn-default btn-file">
            			<span class="fileinput-new">Upload Multiple Images (5 at a time)</span>
                        <input type="file" class="form-control" id="image" name="image[]" required multiple >
                        </span>
                    </div>

                    <button type="submit" class="btn btn-success" id="butPro">Save</button>
                    <a href="/admin/products" class="btn btn-danger">Cancel</a>
                </form>
                @if(count($images)>0)
                <form action="/admin/update-productimages" method="post" id="proform" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{$id}}" />
                	<div class="card-block">
                    <div class="container">
                    <div class="row">
                    @foreach($images as $item)
                    <div class="col-md-3" style="border:1px solid #999999">
                        <div class="photo-box">
                            <img class="img-fluid" src="/productimages/{{$item->image}}" alt="image"><br />
                            Sort Order
                            <input type="number" size="3" name="sort_order[{{$item->id}}]" value="{{$item->sort_order}}" /><br />
                            Default Image<input type="radio" name="default" value="{{$item->id}}" <?php if($item->is_default==1) { ?> checked="checked"<?php } ?> /><br />
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="del({{$id}},{{ $item->id }})" >Delete</a>
                        </div>
                    </div>
                	@endforeach
                    </div>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-success" id="butPro">Save</button>
                    <a href="/admin/products" class="btn btn-danger">Cancel</a>
                </form>
                @endif
              </div>
            </div>
          </div>
          
        </div>
@endsection

@section('scripts')

<script>
function del(pid,id) {
	var url='/admin/delete-productimage/'+pid+'/'+id;
	$("#deleteModal .btn-primary").attr('href',url);
}
</script>

@endsection