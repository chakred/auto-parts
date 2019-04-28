@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">№ заказа</th>
                            <th scope="col">Картинка товара</th>
                            <th scope="col">Название товара</th>
                            <th scope="col">Марка товара</th>
                            <th scope="col">Модель авто</th>
                            <th scope="col">Цена закуп. за шт.</th>
                            <th scope="col">Цена прод. за шт.</th>
                            <th scope="col">Кол. в заказе</th>
                            <th scope="col">Сумма заказа</th>
                            <th scope="col">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                        <tr>
                        <td>{{$order->id}}</td>
                            @if($order->goods->img_path)
                                <td><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$order->goods->img_path}}"></td>
                            @else
                                <td><img src="http://placehold.jp/80x80.png?text=Нет картинки"></td>
                            @endif
                        <td width="10%">{{$order->goods->name_good}}</td>
                        <td>{{$order->goods->mark_good}}<br/> {{$order->goods->country}}</td>
                        <td>{{$order->goods->autoModels->autoMark->name_mark}}<br/>{{$order->goods->autoModels->name_model}}<br/>{{$order->goods->autoModels->year}}г.в.</td>
                        <td>{{$order->goods->cost}} {{$order->goods->currency}}</td>
                        <td>{{$order->convertedPrice}}грн.</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->totalSum}}грн.</td>
                        <td width="5%">
                            <a href="{{ route('edit-goods', ['good' => $order->id]) }}" class="btn btn-outline-secondary" title="Редактировать"><i class="far fa-edit"></i></a>
                            <form method="POST" action ="{{ route('delete-orders', ['id' => $order->id]) }}">
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-secondary delete-good" data-good-id ="{{$order->id}}" title="Удалить"><i class="far fa-trash-alt"></i></button>
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
            <div class="col-sm-12">
                <div class="d-flex justify-content-center mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
