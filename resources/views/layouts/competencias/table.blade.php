<div class="row">
    <div class="col-xs-12">
        <div class="box">
            @include('Messages.Alerts')
            <div class="box-header">
                <h3 class="box-title">@yield('list_title')</h3>
                @yield('search')
            </div>

            @yield('other')

            <div class="box-body table-responsive no-padding">
                <table id="tabla" class="table table-striped">
                    <thead>
                        @yield('thead')
                    </thead>
                    <tbody>
                        @yield('tbody')
                    </tbody>
                </table>
            </div>
            @yield('table2')
        </div>
    </div>
</div>