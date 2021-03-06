@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        @include('admin.notification.success')
        @include('admin.notification.error')
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border pad-15">
                    <h5>Добавить товар, привязать товар к нужной марке, подкатегирии товара:</h5>
                    <form method="POST" action="{{ route('update-goods', ['good' => $good->id]) }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$good->img_path}}">
                            <label for="picture">Картинка товара</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <div class="form-group">
                            <label for="nameOfGood">Название товара</label>
                            <input type="text" class="form-control" name="name_good" value="{{$good->name_good}}">
                        </div>
                        <div class="form-group">
                            <label for="description_goods">Описание товара</label>
                            <textarea class="form-control" id="description_goods" rows="5" name ="desc_good">{{$good->desc_good}}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="markOfGood">Торговая марка</label>
                                <input type="text" class="form-control" name="mark_good" value="{{$good->mark_good}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="countryOfGood">Страна</label>
                                <select class="form-control" id="countryOfGood" name="country">
                                    <option>EU</option>
                                    <option>RU</option>
                                    <option>USA</option>
                                    <option>CN</option>
                                    <option>JP</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="innerId">Артикул</label>
                                <input type="text" class="form-control" id ="innerId" name="inner_id" value="{{$good->id_inner}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="costOfGoods">Цена закупки</label>
                                <input type="text" class="form-control" name="cost" value="{{$good->cost}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="profit">Маржа %</label>
                                <select class="form-control" id="profit" name="profit">
                                    <option selected="selected">{{$good->profit}}</option>
                                    <option>0</option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                    <option>30</option>
                                    <option>35</option>
                                    <option>40</option>
                                    <option>45</option>
                                    <option>50</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="discount">Скидка %</label>
                                <select class="form-control" id="discount" name="discount">
                                    <option selected="selected">{{$good->discount}}</option>
                                    <option>0</option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                    <option>30</option>
                                    <option>35</option>
                                    <option>40</option>
                                    <option>45</option>
                                    <option>50</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="currency">Валюта</label>
                                <select class="form-control" id="currency" name="currency">
                                    <option selected="selected">{{$good->currency}}</option>
                                    <option>EUR</option>
                                    <option>UAH</option>
                                    <option>USD</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="quantity">Количество</label>
                                <input type="text" class="form-control" name="quantity" value="{{$good->quantity}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="itemOfGood">Еденица изм.</label>
                                <select class="form-control" id="itemOfGood" name="item">
                                    <option selected="selected">{{$good->item}}</option>
                                    <option>шт.</option>
                                    <option>л.</option>
                                    <option>кг.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="auto">Модель авто</label>
                            <select class="form-control" id="auto" name="auto">
                                <option value="{{$good->autoModels->id}}">{{$good->autoModels->autoMark->name_mark.' '.$good->autoModels->name_model.' / '.$good->autoModels->year.'г.'.' / '.$good->autoModels->engine.'L.'}}</option>
                                @forelse($models as $model)
                                <option value="{{$model->id}}">{{$model->autoMark->name_mark .' '.$model->name_model .' / '.$model->year.'г.'.' / '.$model->engine.'L.'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sub-category">Подкатегория</label>
                            <select class="form-control" id="sub-category" name="sub-category">
                                @forelse($subCategories as $subCategory)
                                    <option
                                        @if($good->subCategories->id == $subCategory->id)
                                        <?='selected'?>
                                        @endif
                                        value="{{$subCategory->id}}">{{$subCategory->sub_category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="further-sub-category">Под-подкатегория</label>
                            <select class="form-control" id="further-sub-category" name="further-sub-category">
                                <option value="null">Нет</option>
                                @foreach($furtherSubCategories as $furtherSubCategory)
                                    <option
                                        @if($good->furtherSubCategories->id == $furtherSubCategory->id)
                                        <?='selected'?>
                                        @endif value="{{$furtherSubCategory->id}}"
                                    >{{$furtherSubCategory->further_sub_category}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{ method_field('PUT') }}
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            @include('admin.goods.currency')
        </div>
    </div>
@endsection
