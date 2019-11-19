<div class="col-lg-8">
    <div class="mb-3">
        <div class="card head-block">
            <div>
                <div>
                    <img src="{{env('APP_URL').'/storage/upload'.$relatedGoods->autoModels->img_path}}">
                </div>
                <p><span>Запчасти к</span> {{$relatedGoods->autoModels->autoMark->name_mark.' '.$relatedGoods->autoModels->name_model}}</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{$relatedGoods->name_good}}</h3>
            <h4>{{$relatedGoods->convertedPrice}} грн.</h4>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-success mb-3" data-toggle="modal" data-target="#buyProductModal">
                    Купить
                </button>
            <p class="card-text">{{$relatedGoods->desc_good}}</p>
            <p class="card-text">Производитель - {{$relatedGoods->mark_good}}</p>
            <p class="card-text">Страна производства - {{$relatedGoods->country}}</p>
            {{--<span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>--}}
            {{--4.0 stars--}}
        </div>
    </div>
    <!-- /.card -->

    <div class="card card-outline-secondary my-4">
        <div class="card-header">
            Условия возврата и обмена
        </div>
        <div class="card-body">
            <p>Компания осуществляет возврат и обмен этого товара в соответствии с требованиями законодательства.</p>
        </div>
    </div>

    <div class="card card-outline-secondary my-4">
        <div class="card-header">
            Сроки возврата
        </div>
        <div class="card-body">
            <p>Возврат возможен в течение 14 дней после получения (для товаров надлежащего качества).</p>
            <p>Обратная доставка товаров осуществляется по договоренности.</p>
            <p>Требования к товару, который Вы хотите вернуть:
                - товар принимается к возврату только в упаковке, в которой он был отпущен клиенту, не зависимо от причины возврата;
                - упаковка и товар не должны содержать какие-либо надписи, быть повреждёнными (за исключением брака товара);
                - товар с претензией по браку принимается только с комплектом соответствующих документов, указанных в условиях возврата.
                В случае, если товар возвращается необоснованно и с момента продажи прошло более 14 дней, но не более 1 месяца, товар может быть принят от клиента с возвратом стоимости товара на день отгрузки минус 25%.
                Если с момента продажи прошло более 1 месяца, но менее 3 месяцев – комиссия составляет 50%. По истечении 3 месяцев товар возврату не подлежит.</p>
        </div>
    </div>
    <!-- /.card -->

</div>
<!-- /.col-lg-9 -->

<!-- Modal -->
<div class="modal fade" id="buyProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Заказ товара</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('store-order') }}" enctype="multipart/form-data">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Картинка</th>
                        <th scope="col">Товар</th>
                        <th scope="col">ТМ</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Количество</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            @if($relatedGoods->img_path)
                                <img width="100" src="{{env('APP_URL').'/storage/upload'.$relatedGoods->img_path}}">
                            @else
                                <img src="http://dummyimage.com/100x100/ffffff/545454&text=No+image" />
                            @endif
                        </td>
                        <td>{{$relatedGoods->name_good}}</td>
                        <td>{{$relatedGoods->mark_good}}</td>
                        <td>{{$relatedGoods->convertedPrice}} грн.</td>
                        <td>
                            <div id="field1">
                                <button type="button" id="sub" class="sub">-</button>
                                <input type="number" id="1" value="1" min="1" max="100" name ="quantity" style="text-align: center;"/>
                                <button type="button" id="add" class="add">+</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" name="good_id" value="{{$relatedGoods->id}}">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="buyer_name" placeholder="Имя" required="required">
                </div>
                <div class="form-group col-md-4">
                    <input type="phone" class="form-control" name="buyer_phone" placeholder="Номер телефона" required="required">
                </div>
                <p>Разместите Ваш заказ и мы в течении часа свяжимся с вами для уточнения условий доставки и оплаты товара.</p>
                <p>В скорем времени будет доступка онлайн покупка через Приват24</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Заказать</button>
                {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
