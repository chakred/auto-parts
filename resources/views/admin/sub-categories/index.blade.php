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
                            <th scope="col">Категория запчастей</th>
                            <th scope="col">Подкатегория запчастей</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sub_categories as $sub_category)
                            <tr>
                                <th scope="row">{{$sub_category->id}}</th>
                                <th scope="row">{{$sub_category->category->category}}</th>
                                <td>{{$sub_category->sub_category}}</td>
                                <td width="5%">
                                    {{--<form method="POST" action ="{{ route('category-delete', ['category' => $category->id]) }}">--}}
                                    {{--{{ method_field('DELETE') }}--}}
                                    {{--<button type="submit" class="btn btn-outline-secondary" title="Удалить"><i class="far fa-trash-alt"></i></button>--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--</form>--}}
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
                <div class="custom-border pad-15 silver">
                    <form method="POST" action ="{{ route('store-sub-category') }}">
                        <div class="form-group">
                            <p><strong>Добавить подкатегорию запчастей, привязать подкатегорию к категирии</strong></p>
                            <label for="category">Категории:</label>
                            <select class="form-control" id="category" name="category">
                                @foreach($categories as $category)
                                    <option>{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sub-category">Подкатегории:</label>
                            <select class="form-control" id="sub-category" name="sub-category">
                                <option>Фильтр масляный </option>
                                <option>фильтр топливный</option>
                                <option>Воздушный фильтр</option>
                                <option>Фильтр салона</option>
                                <option>Система амортизации</option>
                                <option>Корпус фильтра и комплектующие</option>

                                <option>Ремни и ролики</option>
                                <option>Моторная группа</option>
                                <option>Щуп уровня масла</option>
                                <option>Компрессор наддува (турбина)</option>
                                <option>Шкивы и шестерни привода</option>
                                <option>Подвеска двигателя, коробки, передач</option>
                                <option>Защита двигателя, кпп, генератора, ремней</option>
                                <option>Зажимы, заглушки</option>

                                <option>Подшипники КПП</option>
                                <option>Шестерни, валы, синхронизаторы, вилки КПП</option>
                                <option>Сальники, шайбы и мастлоотражатели кпп</option>
                                <option>Вилка КПП, штифты , втулки</option>
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
