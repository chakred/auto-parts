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
                            <th scope="col">Мака авто</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($marks as $mark)
                            <tr>
                                <th scope="row">{{$mark->id_mark}}</th>
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
                    <form method="POST" action ="{{ route('store-mark-auto') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name_mark"  placeholder="Пр: Renault" required="required">
                            <small id="emailHelp" class="form-text text-muted">Добавьте марку авто с большей заглавной буквы</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить в базу</button>
                        {{ csrf_field() }}
                    </form>
                </div>
           </div>
        </div>
    </div>
@endsection
