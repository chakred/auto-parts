@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5 mt-3 heavy">
                <h1>Раздел: Марка авто</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="custom-border">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Логотип</th>
                            <th scope="col">Мака авто</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($marks as $mark)
                            <tr>
                                <th scope="row">{{$mark->id}}</th>
                                @if($mark->img_path)
                                    <td><img width="80" height="80" src="{{env('APP_URL').'/storage/upload'.$mark->img_path}}"></td>
                                @else
                                    <td><img src="http://placehold.jp/80x80.png?text=Нет логотипа"></td>
                                @endif
                                <td>{{$mark->name_mark}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="custom-border silver pad-15">
                    <p><strong>Добавить марку авто:</strong></p>
                    <form method="POST" action ="{{ route('store-mark-auto') }}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="picture">Логотип</label>
                            <input type="file" class="form-control-file" id="picture" name="picture">
                        </div>
                        <div class="form-group">
                            <label for="yearAuto">Марка авто</label>
                            <select class="form-control" id="yearAuto" name="name_mark">
                                <option>Renault</option>
                                <option>Peugeot</option>
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
