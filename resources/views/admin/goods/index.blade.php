@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mb-3">
                <a href="{{route('add-goods')}}" class="btn btn-primary" title="Добавить товар"><i class="far fa-plus-square"></i> Добавить</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Картинка</th>
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
                        @forelse($goods as $good)
                        <tr>
                        <td>{{$good->id}}</td>
                            @if($good->img_path)
                                <td><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$good->img_path}}"></td>
                            @else
                                <td><img src="http://placehold.jp/80x80.png?text=Нет картинки"></td>
                            @endif
                        <td width="10%">{{$good->name_good}}</td>
                        <td width="15%">{{$good->mark_good}}</td>
                        <td width="10%">{{$good->country}}</td>
                        <td width="15%">{{$good->cost}}</td>
                        <td>{{$good->currency}}</td>
                        <td>{{$good->quantity}}</td>
                        <td>{{$good->autoModels->autoMark->name_mark}}</td>
                        <td>{{$good->autoModels->name_model}}</td>
                        <td>{{$good->autoModels->year}}</td>
                        <td>{{$good->subCategories->sub_category}}</td>
                        <td width="5%">
                            <a href="{{ route('edit-goods', ['good' => $good->id]) }}" class="btn btn-outline-secondary" title="Редактировать"><i class="far fa-edit"></i></a>

                            <form method="POST" action ="{{ route('delete-goods', ['good' => $good->id]) }}">
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-secondary delete-good" data-good-id ="{{$good->id}}" title="Удалить"><i class="far fa-trash-alt"></i></button>
                                {{ csrf_field() }}
                            </form>
                        </td>
                        </tr>
                        @empty
                            <tr>
                                <td>Нет товаров</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
