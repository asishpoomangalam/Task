<div class="form-group">
                        <label for="title">Product Specifications</label>
                    </div>
                    <div class="row">
                        @foreach($specifications as $item)
                        <label class="checkbox-inline col-lg-3">
                        <input type="checkbox" name="specifications[]" value="{{$item->id}}" /> {{$item->title}}
                        </label>
                        @endforeach
                    </div>