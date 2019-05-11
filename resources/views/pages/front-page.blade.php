@include('layouts.site-header')

    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 100px">
            <div class="col-lg-3 mb-3">
                @include('parts.sidebar_marks-and-models')
                <br/>
                @include('parts.sidebar_contacts')
                <br/>
                @include('parts.sidebar_working-hours')
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                @include('parts.main-slider')
                @include('parts.content-models')
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

@include('layouts.site-footer')
