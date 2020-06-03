@extends('layouts.master_auth')
 
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
                <h4 class="card-title"> Products</h4>
                <a href="/addproducts" class="btn btn-success float-right">Add</a>
                <a href="/admin" class="btn btn-warning float-right">Back to Dashboard</a>
              </div>
              
              <div class="card-body">
               @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <form method="post" action="/admin/sort-product">
                {{ csrf_field() }}
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class=" text-primary">
                    <th>ID #</th>
                      <th>
                        Title
                      </th>
                      <th>
                        Product Image
                      </th>
                      <?php /*?><th>
                      Sort Order<br />
                      <input type="submit" class="btnSave btn-sm btn" name="submit" value="Save" onClick="saveOrder();"  />
                      </th><?php */?>
                      <th>
                        Edit
                      </th>
                      <th >
                        Delete
                      </th>
                      <?php /*?><th>
                      Status
                      </th><?php */?>
                    </thead>
                    <tbody>
                    @foreach($products as $key =>$item)
                      <tr>
                      <td>{{ ++$key }}</td>
                        <td>
                          {{$item->title}}
                        </td>
                        <td>
                        	@if($item->image!="")
                        	<img src="{{ asset('images/'.$item->image ) }}" class="img-fluid" height="100" width="100" />
                            @else
                            No Image Found
                            @endif
                        </td>
                        <?php /*?><td>
                        <input type="number" name="sort_order[{{$item->id}}]" value="{{$item->sort_order}}" size="3" />
                        </td><?php */?>
                        <td>
                          <a href="/editproduct/{{$item->id}}" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                          <a href="/deleteproduct/{{$item->id}}" class="btn btn-danger" onclick="return confirm('Do you really need to delete this item?')" >Delete</a>
                        </td>
                        <?php /*?><td>
                        
                        <div class="custom-control custom-switch">
  							<input type="checkbox" class="custom-control-input" id="{{$item->id}}" value="{{$item->status}}" onclick="redirect({{$item->id}},{{$item->status}})" {{ ($item->status==1)?'checked':''}}>
  							<label class="custom-control-label" for="{{$item->id}}">{{ ($item->status==1)?'ON':'OFF'}}</label>
						</div>
                        
                        </td><?php */?>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
                </form>
                <?php /*?>{{ $contents->render() }}<?php */?>
              </div>
            </div>
          </div>
          
        </div>
@endsection

@section('scripts')

<script>
function redirect(id,status)
{
	window.location='/admin/status-product/'+id+'/'+status;
}
$(document).ready( function () {
    $('#myTable').DataTable();
} );
function del(id) {
	var url='/deleteproduct/'+id;
	$("#deleteModal .btn-primary").attr('href',url);
}
</script>

@endsection