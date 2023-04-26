@if (session('success') || session('fail'))
    <div class="notification">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-warning">
                            {{ session('fail') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
