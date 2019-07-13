@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mt-3 heavy">
                <h1>Раздел: Добавить мoдель авто</h1>
                <i>Привязать мoдель к ранее созданой марке:</i>
            </div>
        </div>
        @include('admin.notification.error')
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border pad-15">
                    <form method="POST" action="{{ route('store-model-auto') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="picture">Изображение модели</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <div class="form-group">
                            <label for="markAutoSelect">Марка авто</label>
                            <select class="form-control" id="markAutoSelect" name="mark_auto_select">
                                @foreach($marks as $mark)
                                    <option>{{$mark->name_mark}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modelAuto">Модель авто</label>
                            <input type="text" class="form-control" name="name_model">
                        </div>
                        <div class="form-group">
                            <label for="yearAuto">Год выпуска от</label>
                            <select class="form-control" id="yearAuto" name="year">
                                <option>2000</option>
                                <option>2001</option>
                                <option>2002</option>
                                <option>2003</option>
                                <option>2004</option>
                                <option>2005</option>
                                <option>2006</option>
                                <option>2007</option>
                                <option>2008</option>
                                <option>2009</option>
                                <option>2010</option>
                                <option>2011</option>
                                <option>2012</option>
                                <option>2013</option>
                                <option>2014</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lastYearAuto">Год выпуска до</label>
                            <select class="form-control" id="lastYearAuto" name="last_year">
                                <option>2000</option>
                                <option>2001</option>
                                <option>2002</option>
                                <option>2003</option>
                                <option>2004</option>
                                <option>2005</option>
                                <option>2006</option>
                                <option>2007</option>
                                <option>2008</option>
                                <option>2009</option>
                                <option>2010</option>
                                <option>2011</option>
                                <option>2012</option>
                                <option>2013</option>
                                <option>2014</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="valueEngine">Объем двигателя (л)</label>
                            <select class="form-control" id="valueEngine" name="value_engine">
                                <option>0.9</option>
                                <option>1.0</option>
                                <option>1.1</option>
                                <option>1.2</option>
                                <option>1.3</option>
                                <option>1.4</option>
                                <option>1.5</option>
                                <option>1.6</option>
                                <option>1.7</option>
                                <option>1.8</option>
                                <option>1.9</option>
                                <option>2.0</option>
                                <option>2.1</option>
                                <option>2.2</option>
                                <option>2.3</option>
                                <option>2.4</option>
                                <option>2.5</option>
                                <option>2.6</option>
                                <option>2.7</option>
                                <option>2.8</option>
                                <option>2.9</option>
                                <option>3.0</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="typeEngine">Тип двигателя</label>
                            <select class="form-control" id="type_engine" name="type_engine">
                                <option>Бензин</option>
                                <option>Дизель</option>
                                <option>Гибрид</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="transmission">Трансмиссия</label>
                            <select class="form-control" id="transmission" name="transmission">
                                <option>Механика</option>
                                <option>Автомат</option>
                                <option>Типтроник</option>
                                <option>Вариатор</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="typeTransmission">Тип трансмисии</label>
                            <input type="text" class="form-control" name="type_transmission">
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить в базу</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
