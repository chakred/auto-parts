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
                            <th scope="col">Подкат.</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($goods as $good)
                        <tr>
                        <th width="5%" scope="row">{{$good->id}}</th>
                        <td width="10%">{{$good->name_good}}</td>
                        <td width="15%">{{$good->mark_good}}</td>
                        <td width="10%">{{$good->country}}</td>
                        <td width="15%">{{$good->cost}}</td>
                        <td>{{$good->currency}}</td>
                        <td>{{$good->quantity}}</td>
                        <td>{{$model->autoMark->name_mark}}</td>
                        <td>no</td>
                        <td>no</td>
                        <td>no</td>
                        <td width="5%">
                        <a href="#" class="btn btn-outline-secondary" title="Редактировать"><i class="far fa-edit"></i></a>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
