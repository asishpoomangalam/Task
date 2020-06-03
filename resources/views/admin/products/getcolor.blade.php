<div class="form-group">
                        <label for="title">Product Colors</label>
                    </div>
                    <div class="row">
                        @foreach($colors as $item)
                        <label class="checkbox-inline col-lg-1">
                        <div class="rounded-sm float-sm-right mx-auto p-3 " style="background-color:{{$item->title}}" >
                        <input type="checkbox" name="colors[]" value="{{$item->id}}"  /> 
                        </div>
                        </label>
                        @endforeach
                    </div>