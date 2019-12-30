@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        @include('admin.notification.error')
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border pad-15">
                    <h5>Редактировать заказ:</h5>
                    <form method="POST" action="{{ route('update-order', ['id' => $order->id]) }}" enctype="multipart/form-data">
                        <div class="form-group">
                            @if($order->goods->img_path)
                                <img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$order->goods->img_path}}">
                            @else
                                <img src="http://placehold.jp/80x80.png?text=Нет картинки">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nameOfGood">Название товара</label>
                            <input type="text" class="form-control" name="name_good" value="{{$order->goods->name_good}}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="markOfGood">Торговая марка</label>
                                <input type="text" class="form-control" name="mark_good" value="{{$order->goods->mark_good}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="countryOfGood">Страна</label>
                                <select class="form-control" id="countryOfGood" name="country">
                                    <option selected>{{$order->goods->country}}</option>
                                    <option>EU</option>
                                    <option>RU</option>
                                    <option>USA</option>
                                    <option>CN</option>
                                    <option>JP</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="costOfGoods">Цена продажи</label>
                                <input type="text" class="form-control" name="cost" value="{{$order->convertedPrice}}грн.">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="quantity">Количество</label>
                                <input type="text" class="form-control" name="quantity" value="{{$order->quantity}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Статус</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="new">Новый</option>
                                    <option value="handled">Обработан</option>
                                    <option value="ordered">Заказан</option>
                                    <option value="canseled">Отменен</option>
                                </select>
                            </div>
                        </div>
                        {{ method_field('PUT') }}
                        <button type="submit" class="btn btn-primary" disabled>Обновить</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
