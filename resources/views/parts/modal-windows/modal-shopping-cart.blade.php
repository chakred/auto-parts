<div class="modal fade" id="shoppingCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shoppingCartLongTitle">Корзина</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row d-flex align-items-center justify-content-center h-100" style="text-align: center">
                    <div class="col-12">
                        <div class="error-message" style="display: none">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Произошла ошибка</span>
                            <p>Просим Вас заказать товар по телефону</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="success-message" style="display: none">
                            <i class="fas fa-check-circle"></i>
                            <span>Заявка успешно отправлена</span>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('store-order') }}" enctype="multipart/form-data" id="form-order-goods">
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
                        @foreach(Cart::content() as $row)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>
                                @if(!$row->options->imgPath)
                                <img id="transferred-goods-image" width="100" src="http://dummyimage.com/100x100/ffffff/545454&text=No+image" />
                                    @else
                                <img id="transferred-goods-image" width="100" src="{{env('APP_URL').'/storage/upload'.$row->options->imgPath}}" />
                                @endif
                            </td>
                            <td id="transferred-goods-name">{{$row->name}}</td>
                            <td id="transferred-goods-mark">{{$row->options->tradeMark}}</td>
                            <td id="transferred-goods-price">{{$row->price}} грн.</td>
                            <td>
                                <div id="field1">
                                    <button type="button" id="sub" class="sub">-</button>
                                    <input type="number" id="quantity" value="1" min="1" max="100" name ="quantity" style="text-align: center;"/>
                                    <button type="button" id="add" class="add">+</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group col-md-4">
                        <input type="hidden" class="form-control" name="good_id" value="" id="goods-id">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="buyer_name" placeholder="Имя">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="phone" class="form-control" name="buyer_phone" placeholder="Номер телефона">
                    </div>
                    <p>Разместите Ваш заказ и мы в течении часа свяжимся с вами для уточнения условий доставки и оплаты товара.</p>
                    <p>В скорем времени будет доступна онлайн покупка через Приват24</p>
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
