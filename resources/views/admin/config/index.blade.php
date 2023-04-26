@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Config') }}</div>
                    <div class="card-body">
                        <form action="{{ route('admin.config.update') }}" role="form" method="POST">
                            @csrf
                            @method('PUT')
                            @foreach ($configs as $config)
                                <div class="mb-3">
                                    @if ($config->name != 'open_store')
                                        <label for="config_<?= $config->name ?>"
                                            class="form-label">{{ replaceSpecialChar($config->name) }}</label>
                                        <input type="text" name="config[{{ $config->name }}]" class="form-control"
                                            value="{{ $config->value }}" id="config_<?= $config->name ?>">
                                    @else
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="config[{{ $config->name }}]"
                                                type="checkbox" id="config_<?= $config->name ?>" @if ($config->value == 'on')
                                            checked
                                    @endif>
                                    <label class="form-check-label"
                                        for="config_<?= $config->name ?>">{{ replaceSpecialChar($config->name) }}</label>
                                </div>
                            @endif
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Save config</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
