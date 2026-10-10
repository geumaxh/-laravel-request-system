@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Request') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="item_name" class="col-md-4 col-form-label text-md-end">{{ __('Item Name') }}</label>

                            <div class="col-md-6">
                                <input id="item_name" type="text" class="form-control @error('item_name') is-invalid @enderror" name="item_name" value="{{ old('item_name') }}" required autofocus>

                                @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required min="1">

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="purpose" class="col-md-4 col-form-label text-md-end">{{ __('Purpose') }}</label>

                            <div class="col-md-6">
                                <textarea id="purpose" class="form-control @error('purpose') is-invalid @enderror" name="purpose" required rows="4">{{ old('purpose') }}</textarea>

                                @error('purpose')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Request') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection