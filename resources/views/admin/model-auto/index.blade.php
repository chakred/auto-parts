@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mt-3 heavy">
                <h1>Раздел: Мoдель авто</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb-3">
                <a href="{{route('add-model-auto')}}" class="btn btn-primary btn-lg active" title="Добавить модель"><i class="far fa-plus-square"></i> Добавить</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Картинка</th>
                            <th scope="col">Марка</th>
                            <th scope="col">Модель</th>
                            <th scope="col">Год</th>
                            <th scope="col">Объем мотр.</th>
                            <th scope="col">Тип мотр.</th>
                            <th scope="col">Трансмиссия</th>
                            <th scope="col">Тип трансм.</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($models as $model)
                            <tr>
                                @if($model->img_path)
                                    <td><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$model->img_path}}"></td>
                                @else
                                    <td><img src="http://placehold.jp/80x80.png?text=Нет картинки"></td>
                                @endif
                                <td width="10%">{{$model->autoMark->name_mark}}</td>
                                <td width="15%">{{$model->name_model}}</td>
                                <td width="10%">{{$model->year}}</td>
                                <td width="15%">{{$model->engine}}</td>
                                <td>{{$model->type_of_engine}}</td>
                                <td>{{$model->transmission}}</td>
                                <td>{{$model->type_of_transmission}}</td>
                                <td width="5%">
                                    <a href="{{ route('edit-model-auto', ['model' => $model->id]) }}" class="btn btn-outline-secondary" title="Редактировать"><i class="far fa-edit"></i></a>
                                </td>
                                <td width="5%">
                                    <form method="POST" action ="{{ route('model-auto-delete', ['model' => $model->id]) }}">
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-outline-secondary delete-model" data-model-id ="{{$model->id}}" title="Удалить"><i class="far fa-trash-alt"></i></button>
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Нет данных в базе</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
