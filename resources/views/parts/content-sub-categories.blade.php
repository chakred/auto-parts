<div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card">
                <div style="    display: inline-block;
    width: 50px;
    height: 50px;
    text-align: center;
    overflow: hidden;
    vertical-align: middle;"><img height="50"  style="    object-fit: cover;
    width: 100%;" src="{{env('APP_URL').'/storage/upload'.$model->img_path}}"></div>
                <p>Подкатегории запчастей к {{$model->autoMark->name_mark.' '.$model->name_model}}</p>
            </div>
        </div>
    @forelse($subCategories as $subCategory)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="#"><img width="200" src="{{env('APP_URL').'/storage/upload'.$subCategory->img_path}}"></a>
                <div class="card-footer">
                    <small class="text-muted"><a href="#">{{$subCategory->sub_category}}</a></small>
                </div>
            </div>
        </div>
    @empty
        Нет моделей данной марки
    @endforelse
</div>
