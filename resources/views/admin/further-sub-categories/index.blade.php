@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-12 mb-5 mt-3 heavy">
                <h1>Раздел:Под-подкатегории запчастей</h1>
            </div>
        </div>
        @include('admin.notification.error')
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Картинка</th>
                            <th scope="col">Под-подкатегория запчастей</th>
                            <th scope="col">Подкатегория запчастей</th>
                            <th scope="col"></th>
                            <th scope="col">Картинка</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($further_sub_categories as $further_sub_category)
                            <tr>
                                <td>{{$further_sub_category->id}}</td>
                                @if($further_sub_category->img_path)
                                    <td><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$further_sub_category->img_path}}"></td>
                                @else
                                    <td><img src="http://placehold.jp/80x80.png?text=Нет картинки"></td>
                                @endif
                                <td>{{$further_sub_category->further_sub_category}}</td>
                                <td scope="row">{{$further_sub_category->subCategory->sub_category}}</td>
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
                                            data-sub-cat-name="{{$further_sub_category->sub_category}}"
                                            data-sub-cat-id="{{$further_sub_category->id}}"
                                            data-sub-cat-img="{{env('APP_URL').'/storage/upload'.$further_sub_category->img_path}}">
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
                    <form method="POST" action ="{{ route('further-sub-category-store') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <p><strong>Добавить подкатегорию запчастей, привязать подкатегорию к категирии</strong></p>
                            <label for="sub-category">Подкатегории:</label>
                            <select class="form-control" id="sub-category" name="sub_category">
                                @foreach($sub_categories as $sub_category)
                                    <option value="{{$sub_category->sub_category}}">{{$sub_category->sub_category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="further-sub-category">Под-подкатегории:</label>
                            <select class="form-control" id="further-sub-category" name="further_sub_category">
                                <option>test1</option>
                                <option>test2</option>
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
                    <form method="POST" id="subCategoryForm" action ="{{route('further-sub-category-edit', ['id' => ''])}}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="picture">Картинка под-подкатегории</label>
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
