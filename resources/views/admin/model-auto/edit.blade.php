@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mt-3 heavy">
                <h1>Раздел: Редактировать мoдель авто</h1>
                <i>Редактировать данные уже созданной модели авто</i>
            </div>
        </div>
        @include('admin.errors.error')
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border pad-15">
                    <form method="POST" action="{{ route('update-model-auto', ['model' => $model->id]) }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$model->img_path}}">
                            <label for="picture">Изображение модели</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <div class="form-group">
                            <label for="markAutoSelect">Марка авто</label>
                            <input class="form-control" id="markAutoSelect" name="mark_auto_select" readonly value="{{$model->autoMark->name_mark}}">
                        </div>
                        <div class="form-group">
                            <label for="modelAuto">Модель авто</label>
                            <input type="text" class="form-control" name="name_model" value="{{$model->name_model}}">
                        </div>
                        <div class="form-group">
                            <label for="yearAuto">Год выпуска</label>
                            <input class="form-control" id="yearAuto" name="year" value="{{$model->year}}">
                        </div>
                        <div class="form-group">
                            <label for="valueEngine">Объем двигателя (л)</label>
                            <input class="form-control" id="valueEngine" name="value_engine" value="{{$model->engine}}">
                        </div>
                        <div class="form-group">
                            <label for="typeEngine">Тип двигателя</label>
                            <input class="form-control" id="type_engine" name="type_engine" value="{{$model->type_of_engine}}">
                        </div>
                        <div class="form-group">
                            <label for="transmission">Трансмиссия</label>
                            <input class="form-control" id="transmission" name="transmission" value="{{$model->transmission}}">
                        </div>
                        <div class="form-group">
                            <label for="typeTransmission">Тип трансмисии</label>
                            <input type="text" class="form-control" name="type_transmission" value="{{$model->type_of_transmission}}">
                        </div>
                        {{ method_field('PUT') }}
                        <button type="submit" class="btn btn-primary">Редактировать</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
