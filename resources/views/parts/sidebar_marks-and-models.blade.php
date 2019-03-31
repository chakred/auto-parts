<div class="accordion" id="accordionExample">Выберите модель:
    @forelse($marks as $mark)
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <div style="    display: inline-block;
    width: 50px;
    height: 50px;
    text-align: center;
    overflow: hidden;
    vertical-align: middle;"><img height="50"  style="    object-fit: cover;
    width: 100%;" src="{{env('APP_URL').'/storage/upload'.$mark->img_path}}"></div>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    {{$mark->name_mark}}
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <ul>
                    @forelse($mark->autoModels as $models)
                        <li>{{$models->name_model}}</li>
                    @empty
                        <li>Нет моделей данной марки</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    @empty
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    No marks in databese
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <ul>
                    <li> No models related</li>
                </ul>
            </div>
        </div>
    </div>
    @endforelse
</div>
