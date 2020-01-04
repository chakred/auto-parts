@extends('admin.layouts.app_admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-12 mb-5 mt-3 heavy">
                <h1>Раздел:Все товары</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{ Form::open(array('route' => 'goods-search')) }}
                <div class="input-group mb-3">
                    <input type="text" name="searchKey" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="Поиск"></input>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
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
                            <th scope="col">Артикул</th>
                            <th scope="col">Марка товара</th>
                            <th scope="col">Страна</th>
                            <th scope="col">Цена закупки за шт.</th>
                            <th scope="col">Цена продажи за шт.</th>
                            <th scope="col">Кол</th>
                            <th scope="col">Марка авто</th>
                            <th scope="col">Модель авто</th>
                            <th scope="col">Год авто</th>
                            <th scope="col">Подкат.</th>
                            <th scope="col">Под-подкат.</th>
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
                        <td width="10%">{{$good->id_inner}}</td>
                        <td width="10%">{{$good->mark_good}}</td>
                        <td width="10%">{{$good->country}}</td>
                        <td width="15%">{{$good->cost.' '.$good->currency}}</td>
                        <td>{{$good->convertedPrice.' грн'}}</td>
                        <td>{{$good->quantity}}</td>
                        <td>{{$good->autoModels->autoMark->name_mark}}</td>
                        <td>{{$good->autoModels->name_model}}</td>
                        <td>{{$good->autoModels->year}}</td>
                        <td>{{$good->subCategories->sub_category}}</td>
                        <td>{{isset($good->furtherSubCategories->further_sub_category)?$good->furtherSubCategories->further_sub_category:'нет'}}</td>
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
                                <td colspan="100">Нет товаров</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$goods->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
