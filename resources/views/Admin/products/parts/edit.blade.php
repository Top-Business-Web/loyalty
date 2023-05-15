<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('products.update',$find->id)}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$find->id}}" name="id">
        <div class="form-group">
            <label for="name" class="form-control-label">{{__('admin.image')}}</label>
            <input type="file" id="testDrop" class="dropify" name="image" data-default-file="{{$find->image}}"/>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label"> {{__('admin.categories')}}</label>
            <select class="form-control" name="category_id" id="category_id">
                @forelse($categories as $category)
                    <option value="{{$category->id}}" {{($category->id == $find->category_id)? 'selected' : ''}}>{{$category->name_ar}}</option>
                @empty
                    <option value=""></option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="user_id" class="form-control-label"> {{__('admin.providers')}}</label>
            <select class="form-control" name="user_id" id="user_id">
                @forelse($providers as $provider)
                    <option value="{{$provider->id}}"  {{($provider->id == $find->user_id)? 'selected' : ''}}>{{$provider->name}}</option>
                @empty
                    <option value=""></option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label"> {{__('admin.name_ar')}}</label>
            <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{$find->name_ar}}">
        </div>
        <div class="form-group">
            <label for="email" class="form-control-label">{{__('admin.name_en')}}</label>
            <input type="text" class="form-control" name="name_en" id="name_en" value="{{$find->name_en}}">
        </div>
        <div class="form-group">
            <label for="price" class="form-control-label">{{__('admin.price')}}</label>
            <input type="number" class="form-control" name="price" id="price" value="{{$find->price}}">
        </div>
        <div class="form-group">
            <label for="price" class="form-control-label">السعر بعد الخصم</label>
            <input type="number"  class="form-control" name="price_after_discount" id="price_after_discount">
        </div>
        <div class="col-12">
            <div class="form-group row">
                <input type="hidden" name="the_best" value="0" />
                <input type="checkbox" class="form-control col-2" name="the_best" value="1" {{($find->the_best == 1)? "checked":  ''}} placeholder="******">
                <label for="btn_link" class="form-control-label col-10">وضع كمفضل</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-success" id="updateButton">{{__('admin.update')}}</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>
