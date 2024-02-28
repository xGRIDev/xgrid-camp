@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card mt-3" data-aos="fade-up" data-aos-duration="1000">
                <div class="card-header">
                    DISCOUNT
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex flex-row-reverse">
                            <a href="{{ route('admin.discount.create') }}" class="btn btn-primary btn-sm">Add Discount</a>
                        </div>
                    </div>
                    @include('components.alert')
      {{--              <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Camp</th>
                                <th>Price</th>
                                <th>Register Data</th>
                                <th>Paid Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($checkouts as $checkout)
                            <tr>
                                <td>{{ $checkout->User->name }}</td>
                                <td>{{ $checkout->User->title }}</td>
                                <td>{{ $checkout->User->price }}</td>
                                <td>{{ $checkout->User->created_at->format('M d Y') }}</td>
                                <td>
                                <strong>{{ $checkout->payment_status}} </strong> 
                            </td>
                             
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Camp Registered</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection