<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-primary">
                {{session('success') }}
            </div>
        @endif
    </div>
</div>
