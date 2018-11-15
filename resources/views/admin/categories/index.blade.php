@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Категории запчастей</th>
                            <th scope="col">Удаление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <th scope="row">{{$category->id}}</th>
                                <td>{{$category->category}}</td>
                                <td width="5%">
                                    <form method="POST" action ="{{ route('category-delete', ['category' => $category->id]) }}">
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-outline-secondary delete-category" data-category-id ="{{$category->id}}" title="Удалить"><i class="far fa-trash-alt"></i></button>
                                        {{ csrf_field() }}
                                    </form>
                                </td>
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
                    <form method="POST" action ="{{ route('store-category') }}">
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
