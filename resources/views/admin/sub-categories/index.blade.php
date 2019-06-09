@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-12 mb-5 mt-3 heavy">
                <h1>Раздел:Под-категории запчастей</h1>
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
                            <th scope="col">Категория запчастей</th>
                            <th scope="col">Подкатегория запчастей</th>
                            <th scope="col"></th>
                            <th scope="col">Картинка</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sub_categories as $sub_category)
                            <tr>
                                <td>{{$sub_category->id}}</td>
                                @if($sub_category->img_path)
                                    <td><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$sub_category->img_path}}"></td>
                                @else
                                    <td><img src="http://placehold.jp/80x80.png?text=Нет картинки"></td>
                                @endif
                                <td scope="row">{{$sub_category->category->category}}</td>
                                <td>{{$sub_category->sub_category}}</td>
                                <td width="5%">
                                    {{--<form method="POST" action ="{{ route('category-delete', ['category' => $category->id]) }}">--}}
                                    {{--{{ method_field('DELETE') }}--}}
                                    {{--<button type="submit" class="btn btn-outline-secondary" title="Удалить"><i class="far fa-trash-alt"></i></button>--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--</form>--}}
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary update-image"
                                            data-toggle="modal"
                                            data-target="#subCategoryModal"
                                            data-sub-cat-name="{{$sub_category->sub_category}}"
                                            data-sub-cat-id="{{$sub_category->id}}"
                                            data-sub-cat-img="{{env('APP_URL').'/storage/upload'.$sub_category->img_path}}">
                                        <i class="fas fa-image"></i>
                                    </button>
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
                    <form method="POST" action ="{{ route('store-sub-category') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <p><strong>Добавить подкатегорию запчастей, привязать подкатегорию к категирии</strong></p>
                            <label for="category">Категории:</label>
                            <select class="form-control" id="category" name="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->category}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sub-category">Подкатегории:</label>
                            <select class="form-control" id="sub-category" name="sub_category">
                                <option>Фильтр масляный</option>
                                <option>Фильтр топливный</option>
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
                        <div class="form-group">
                            <label for="picture">Логотип</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить в базу</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="subCategoryModal" tabindex="-1" role="dialog" aria-labelledby="subCategoryModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subCategoryModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="sub-cat-image" src="">
                </div>
                <div class="modal-footer">
                    <form method="POST" id="subCategoryForm" action ="{{route('sub-category-edit', ['id' => ''])}}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="picture">Картинка подкатегории</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить кактинку</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
