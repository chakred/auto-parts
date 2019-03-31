@forelse($marks as $mark)
<div class="row">
    <div class="col-sm-12 mb-3">
        <div class="card">
            <div style="    display: inline-block;
    width: 50px;
    height: 50px;
    text-align: center;
    overflow: hidden;
    vertical-align: middle;"><img height="50"  style="    object-fit: cover;
    width: 100%;" src="{{env('APP_URL').'/storage/upload'.$mark->img_path}}"></div>
            <p>{{$mark->name_mark}}</p>
        </div>
    </div>
    @forelse($mark->autoModels as $models)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="{{ route('categories-site',['id' => $models->id]) }}"><img width="300" src="{{env('APP_URL').'/storage/upload'.$models->img_path}}"></a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('categories-site',['id' => $models->id]) }}">{{$mark->name_mark.' '.$models->name_model}}</a>
                    </h5>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Год выпуска: {{$models->year}}г.</small>
                </div>
            </div>
        </div>
    @empty
        Нет моделей данной марки
    @endforelse
</div>
@empty
 моделей данной марки
@endforelse
