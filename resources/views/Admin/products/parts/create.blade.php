<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('products.store')}}">
        @csrf
        <div class="form-group">
            <label for="name" class="form-control-label">الصورة</label>
            <input type="file" class="dropify" name="image" data-default-file="{{asset('assets/uploads/avatar.png')}}"
                   accept="image/png,image/webp , image/gif, image/jpeg,image/jpg"/>
            <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif, jpeg, jpg,webp</span>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label"> {{__('admin.categories')}}</label>
            <select class="form-control" name="category_id" id="category_id">
                @forelse($categories as $category)
                    <option value="{{$category->id}}">{{$category->name_ar}}</option>
                @empty
                    <option value=""></option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="user_id" class="form-control-label"> {{__('admin.providers')}}</label>
            <select class="form-control" name="user_id" id="user_id">
                @forelse($providers as $provider)
                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                @empty
                    <option value=""></option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label"> {{__('admin.name_ar')}}</label>
            <input type="text" class="form-control" name="name_ar" id="name_ar">
        </div>
        <div class="form-group">
            <label for="email" class="form-control-label">{{__('admin.name_en')}}</label>
            <input type="text" class="form-control" name="name_en" id="name_en">
        </div>
        <div class="form-group">
            <label for="price" class="form-control-label">{{__('admin.price')}}</label>
            <input type="number" class="form-control" name="price" id="price">
        </div>
        <div class="form-group">
            <label for="price" class="form-control-label">السعر بعد الخصم</label>
            <input type="number"  class="form-control" name="price_after_discount" id="price_after_discount">
        </div>
        <div class="col-12">
            <div class="form-group row">
                <input type="hidden" name="the_best" value="0" />
                <input type="checkbox" class="form-control col-2" name="the_best" value="1"  placeholder="******">
                <label for="btn_link" class="form-control-label col-10">وضع كمفضل</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-primary" id="addButton">اضافة</button>
        </div>
    </form>
</div>

<script>
    $('.dropify').dropify()
</script>
