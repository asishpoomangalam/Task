<div class="form-group">
                        <label for="title">Product Sizes</label>
                    </div>
                    <div class="row">
                        @foreach($sizes as $item)
                        <label class="checkbox-inline col-lg-3">
                        <input type="checkbox" name="sizes[]" value="{{$item->id}}" /> {{$item->title}}
                        </label>
                        @endforeach
                    </div>