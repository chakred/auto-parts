<div class="col-sm-4">
    <div class="custom-border pad-15 text-white bg-dark">
        @foreach($currentCurrency as $value)
            @if(\Carbon\Carbon::parse($value->updated_at)->format('d.m.Y') == \Carbon\Carbon::today()->format('d.m.Y'))
                <h5>Aктуальный курс НБУ</h5>
            @else
                <h5>Установленный курс НБУ</h5>
            @endif
            <p>{{$value->currency_name}}</p>
            <p>{{$value->rate}}</p>
            <p>{{\Carbon\Carbon::parse($value->updated_at)->format('d.m.Y')}}</p>
            <hr>
        @endforeach
    </div>
</div>
