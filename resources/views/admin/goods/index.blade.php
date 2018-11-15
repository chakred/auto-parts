@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mb-3">
                <a href="{{route('add-goods')}}" class="btn btn-outline-info" title="Добавить товар"><i class="far fa-plus-square"></i> Добавить</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Название товара</th>
                            <th scope="col">Марка товара</th>
                            <th scope="col">Страна</th>
                            <th scope="col">Цена закупки</th>
                            <th scope="col">Валюта</th>
                            <th scope="col">Кол</th>
                            <th scope="col">Марка авто</th>
                            <th scope="col">Модель авто</th>
                            <th scope="col">Год авто</th>
                            <th scope="col">Подкатегория</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($models as $model)--}}
                        {{--<tr>--}}
                        {{--<th width="5%" scope="row">{{$model->id_model}}</th>--}}
                        {{--<td width="10%">{{$model->autoMark->name_mark}}</td>--}}
                        {{--<td width="15%">{{$model->name_model}}</td>--}}
                        {{--<td width="10%">{{$model->year}}</td>--}}
                        {{--<td width="15%">{{$model->engine}}</td>--}}
                        {{--<td>{{$model->type_of_engine}}</td>--}}
                        {{--<td>{{$model->transmission}}</td>--}}
                        {{--<td>{{$model->type_of_transmission}}</td>--}}
                        {{--<td width="5%">--}}
                        {{--<a href="#" class="btn btn-outline-secondary" title="Редактировать"><i class="far fa-edit"></i></a>--}}
                        {{--</td>--}}
                        {{--<td width="5%">--}}
                        {{--<form method="POST" action ="{{ route('model-auto-delete', ['model' => $model->id_model]) }}">--}}
                        {{--{{ method_field('DELETE') }}--}}
                        {{--<button type="submit" class="btn btn-outline-secondary" title="Удалить"><i class="far fa-trash-alt"></i></button>--}}
                        {{--{{ csrf_field() }}--}}
                        {{--</form>--}}
                        {{--</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
