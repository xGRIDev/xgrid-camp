@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card mt-3 shadow-lg" data-aos="fade-up" data-aos-duration="1000" >
                <div class="card-header">
                    UPDATE DISCOUNT {{ $discount->name }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.discount.update', $discount->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $discount->id }}">
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') ?: $discount->name }}" required/>
                            @if ( $errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name')}}</p>
                                    @endif
                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Code</label>
                            <input name="code" type="text" class="form-control  {{ $errors->has('code') ? 'is-invalid' : '' }}" value="{{ old('code') ?: $discount->code }}" required/>
                            @if ( $errors->has('code'))
                                        <p class="text-danger">{{ $errors->first('code')}}</p>
                                    @endif
                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Description</label>
                            <textarea name="description" cols="0" rows="2" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" value="{{ old('description') ?: $discount->description }}"></textarea>
                            @if ( $errors->has('description'))
                                        <p class="text-danger">{{ $errors->first('description')}}</p>
                                    @endif
                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">Discount Percentage</label>
                            <input name="percentage" type="number" class="form-control {{ $errors->has('percentage') ? 'is-invalid' : '' }}" value="{{ old('percentage') ?: $discount->percentage }}" min="1" max="200" required/>
                        </div>
                            @if ( $errors->has('percentage'))
                                <p class="text-danger">{{ $errors->first('percentage') }}</p>
                            @endif
                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection