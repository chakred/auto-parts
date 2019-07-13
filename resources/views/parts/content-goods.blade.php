<div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card head-block">
                <div>
                    <div>
                        <img src="{{env('APP_URL').'/storage/upload'.$model->img_path}}">
                    </div>
                    <p><span>Запчасти к</span> {{$model->autoMark->name_mark.' '.$model->name_model}}</p>
                </div>
            </div>
        </div>
    @forelse($relatedGoods as $goods)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 cat-block">
                <a href="{{ route('goods-single-site',
                [
                    'subCategory' => $goods->id_sub_category,
                    'model' => $model->id,
                    'id' => $goods->id
                ]) }}">
                    @if($goods->img_path)
                        <img src="{{env('APP_URL').'/storage/upload'.$goods->img_path}}">
                    @else
                        <img src="http://dummyimage.com/450x350/ffffff/545454&text=No+image" />
                    @endif
                </a>
                <div class="card-body">
                    <div class="card-title">
                        <h4>
                            <a href="{{ route('goods-single-site', ['subCategory' => $goods->id_sub_category, 'model' => $model->id, 'id' => $goods->id]) }}">{{$goods->name_good}}</a>
                        </h4>
                        <h6>{{$goods->convertedPrice}} грн.</h6>
                    </div>
                    <p class="card-text">
                        {{str_limit($goods->desc_good, $limit = 150, $end = '...')}}
                    </p>
                    <p class="card-text trade-mark">
                        TM {{$goods->mark_good}}
                    </p>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn-success define-goods"
                            data-goods-id="{{$goods->id}}"
                            data-goods-name="{{$goods->name_good}}"
                            data-goods-image="{{env('APP_URL').'/storage/upload'.$goods->img_path}}"
                            data-goods-price="{{$goods->convertedPrice}}"
                            data-goods-mark="{{$goods->mark_good}}"
                            data-toggle="modal"
                            data-target="#buyProductModal">
                        Купить
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-sm-12 mb-3">
            Нет товаров
        </div>
    @endforelse
</div>

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
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <img id="transferred-goods-image" width="100" src="http://dummyimage.com/100x100/ffffff/545454&text=No+image" />
                            </td>
                            <td id="transferred-goods-name"></td>
                            <td id="transferred-goods-mark"></td>
                            <td id="transferred-goods-price"></td>
                            <td>
                                <div id="field1">
                                    <button type="button" id="sub" class="sub">-</button>
                                    <input type="number" id="quantity" value="1" min="1" max="100" name ="quantity" style="text-align: center;"/>
                                    <button type="button" id="add" class="add">+</button>
                                </div>
                            </td>
                        </tr>
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

