@extends('admin.layouts.app_admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-12 mb-5 mt-3 heavy">
                <h1>Раздел:Все заказы</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-2">
                {{ Form::open(array('route' => 'orders-search-in-all')) }}
                <div class="input-group mb-3">
                    <input type="text" name="searchKey" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" value="Поиск"></input>
                        <a href="{{route('orders')}}" class="btn btn-success" title="Вернутся к полному списку"><i class="fab fa-accessible-icon"></i></a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">№ заказа</th>
                            <th scope="col">Картинка товара</th>
                            <th scope="col">Название товара</th>
                            {{--<th scope="col">Марка товара</th>--}}
                            <th scope="col">Модель авто</th>
                            <th scope="col">Цена закуп. за шт.</th>
                            <th scope="col">Цена прод. за шт.</th>
                            <th scope="col">Кол. в заказе</th>
                            <th scope="col">Сумма заказа</th>
                            <th scope="col">Заказчик</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Дата заказа</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Опции</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                        <tr>
                        <td width="1%">{{$order->id}}</td>
                            @if($order->goods->img_path)
                                <td width="5%"><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$order->goods->img_path}}"></td>
                            @else
                                <td width="5%"><img src="http://placehold.jp/80x80.png?text=Нет картинки"></td>
                            @endif
                        <td width="10%">{{$order->goods->name_good}}</td>
                        {{--<td>{{$order->goods->mark_good}}<br/> {{$order->goods->country}}</td>--}}
                        <td>{{$order->goods->autoModels->autoMark->name_mark}}<br/>{{$order->goods->autoModels->name_model}}<br/>{{$order->goods->autoModels->year}}г.в.</td>
                        <td>{{$order->goods->cost}} {{$order->goods->currency}}</td>
                        <td>{{$order->convertedPrice}}грн.</td>
                        <td width="1%">{{$order->quantity}}</td>
                        <td>{{$order->totalSum}}грн.</td>
                        <td>{{$order->buyer_name}}</td>
                        <td>{{$order->buyer_phone}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->status}}</td>
                        <td width="5%">
                            <a href="{{ route('edit-order', ['id' => $order->id]) }}" class="btn btn-primary" title="Редактировать"><i class="far fa-edit"></i></a>
                            <form method="POST" action ="{{ route('delete-order', ['id' => $order->id]) }}">
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger delete-good" data-good-id ="{{$order->id}}" title="Удалить"><i class="far fa-trash-alt"></i></button>
                                {{ csrf_field() }}
                            </form>
                        </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100" style="text-align: center">
                                    <strong>
                                    @if($notFound) Не найдено! @else Нет заказов @endif
                                    </strong>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="d-flex justify-content-center mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
