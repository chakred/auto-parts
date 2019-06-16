<div class="search-for-goods">
    <form action="{{route('search-for-goods')}}" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="searchForGoods"
                   placeholder="Поиск товара"> <span class="input-group-btn">
            <button type="submit" class="btn btn-dark">
                <i class="fas fa-search"></i>
            </button>
        </span>
        </div>
    </form>
</div>
