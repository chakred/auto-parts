@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-12 mb-5 mt-3 heavy">
                <h1>Раздел:Категории запчастей</h1>
            </div>
        </div>
        @include('admin.errors.error')
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Картинка</th>
                            <th scope="col">Категории запчастей</th>
                            {{--<th scope="col">Удаление</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <th scope="row">{{$category->id}}</th>
                                @if($category->img_path)
                                    <td><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$category->img_path}}"></td>
                                @else
                                    <td><img src="http://placehold.jp/80x80.png?text=Нет логотипа"></td>
                                @endif
                                <td>{{$category->category}}</td>
                                {{--<td width="5%">--}}
                                    {{--<form method="POST" action ="{{ route('category-delete', ['category' => $category->id]) }}">--}}
                                        {{--{{ method_field('DELETE') }}--}}
                                        {{--<button type="submit" class="btn btn-outline-secondary delete-category" data-category-id ="{{$category->id}}" title="Удалить"><i class="far fa-trash-alt"></i></button>--}}
                                        {{--{{ csrf_field() }}--}}
                                    {{--</form>--}}
                                {{--</td>--}}
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Нет данных в базе</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="custom-border silver pad-15">
                    <p><strong>Добавить категорию запчастей:</strong></p>
                    <form method="POST" action ="{{ route('store-category') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="picture">Картинка категории</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="category" name="category">
                                <option>Фильтра</option>
                                <option>Двигатель</option>
                                <option>Трансмиссия</option>
                                <option>Шасси</option>
                                <option>Система амортизации</option>
                                <option>Привод</option>
                                <option>Электрические системы</option>
                                <option>Рулевая система</option>
                                <option>Тормозная система</option>
                                <option>Охлаждение двигателя</option>
                                <option>Обеспечение, подготовка топлива</option>
                                <option>Кузовные запчасти</option>
                                <option>Освещение</option>
                                <option>Выхлопная система</option>
                                <option>Обогрев, кондиционер</option>
                                <option>Очистка стекол</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить в базу</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
