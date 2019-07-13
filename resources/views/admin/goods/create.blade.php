@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        @include('admin.notification.success')
        @include('admin.notification.error')
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border pad-15">
                    <h5>Добавить товар, привязать товар к нужной марке, подкатегирии товара:</h5>
                    <form method="POST" action="{{ route('store-goods') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="picture">Картинка товара</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <div class="form-group">
                            <label for="nameOfGood">Название товара</label>
                            <input type="text" class="form-control" name="name_good">
                        </div>
                        <div class="form-group">
                            <label for="description_goods">Описание товара</label>
                            <textarea class="form-control" id="description_goods" rows="5" name ="desc_good"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="markOfGood">Торговая марка</label>
                                <input type="text" class="form-control" name="mark_good">
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
                                <input type="text" class="form-control" id ="innerId" name="inner_id">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="costOfGoods">Цена закупки</label>
                                <input type="text" class="form-control" name="cost">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="currency">Валюта</label>
                                <select class="form-control" id="currency" name="currency">
                                    <option>EUR</option>
                                    <option>UAH</option>
                                    <option>USD</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="profit">Маржа %</label>
                                <select class="form-control" id="profit" name="profit">
                                    <option>0</option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                    <option selected="selected">30</option>
                                    <option>35</option>
                                    <option>40</option>
                                    <option>45</option>
                                    <option>50</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="discount">Скидка %</label>
                                <select class="form-control" id="discount" name="discount">
                                    <option selected="selected">0</option>
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
                                <label for="quantity">Количество</label>
                                <input type="text" class="form-control" name="quantity">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="itemOfGood">Еденица изм.</label>
                                <select class="form-control" id="itemOfGood" name="item">
                                    <option>шт.</option>
                                    <option>л.</option>
                                    <option>кг.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="auto">Модель авто</label>
                            <select class="form-control" id="auto" name="auto">
                                @foreach($models as $model)
                                <option value="{{$model->id}}">{{$model->autoMark->name_mark .' '.$model->name_model .' / '.$model->year.'г.'.' / '.$model->engine.'L.'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sub-category">Подкатегория</label>
                            <select class="form-control" id="sub-category" name="sub-category">
                                @foreach($subCategories as $subCategory)
                                <option value="{{$subCategory->id}}">{{$subCategory->sub_category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="further-sub-category">Под-подкатегория</label>
                            <select class="form-control" id="further-sub-category" name="further-sub-category">
                                @foreach($furtherSubCategories as $furtherSubCategory)
                                <option value="null">Нет</option>
                                <option value="{{$furtherSubCategory->id}}">{{$furtherSubCategory->further_sub_category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить в базу</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="custom-border pad-15 text-white bg-dark">
                    <h5>Актуальный курс НБУ</h5>
                    @foreach($apiCurrencyUsd as $value)
                        <p>{{$value}}</p>
                    @endforeach
                    <hr>
                    @foreach($apiCurrencyEur as $value)
                        <p>{{$value}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
