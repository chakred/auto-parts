@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Курс валют НБУ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Просмотры страниц</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="custom-border">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Валюта</th>
                                    <th scope="col">Курс</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Статус курса</th>
                                    <th scope="col">Обновить курс</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($currentCurrency as $currency)
                                    <tr>
                                        <td>{{$currency->currency_name}}</td>
                                        <td>{{$currency->rate}}</td>
                                        <td>{{\Carbon\Carbon::parse($currency->updated_at)->format('d.m.Y')}}</td>
                                        <td>
                                            @if(\Carbon\Carbon::parse($currency->updated_at)->format('d.m.Y') == \Carbon\Carbon::today()->format('d.m.Y'))
                                                Актуальный
                                            @else
                                                Не актуальный
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action ="{{ route('update-currency-rate', ['id' => $currency->id]) }}">
                                                {{ method_field('PUT') }}
                                                <button type="submit" class="btn btn-outline-secondary" title="Обновить курс"><i class="fas fa-undo"></i></button>
                                                {{ csrf_field() }}
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Нет просмотров страниц</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="custom-border">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">URL страницы</th>
                                    <th scope="col">Посмотры</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($visitedPages as $page)
                                    <tr>
                                        <td>{{$page->id}}</td>
                                        <td width="80%"><a href="{{$page->url}}">{{$page->url}}</a></td>
                                        <td width="15%">{{$page->count}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Нет просмотров страниц</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
@endsection
