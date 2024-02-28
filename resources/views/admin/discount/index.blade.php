@extends('layouts.app')
@section('content')

<div class="container">


<div class="table-wrapper">
<div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30 shadow-lg mt-4" data-aos="fade-down" data-aos-duration="1000">
                  <h6 class="mb-10">Discount</h6>
                  <p class="text-sm mb-20">
                        INSERT A NEW DISCOUNT
                  </p>
                  <div class="col-md-12 d-flex flex-row-reverse">
                            <a href="{{ route('admin.discount.create') }}" class="btn btn-primary btn-sm">Add Discount</a>
                        </div>
                  <div class="table-wrapper table-responsive mt-4">
                    @include('components.alert')
                    <table class="table">
                      <thead>
                        <tr>
                          <th><h6>Name</h6></th>
                          <th><h6>Code</h6></th>
                          <th><h6>Description</h6></th>
                          <th><h6>Percentage</h6></th>
                          <th><h6>Action</h6></th>
                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>
                        @forelse($discounts as $discount)
                        <tr>
                          <td class="min-width">
                            <span>{{ $discount->name }}</span>
                          </td>
                          <td class="min-width">
                            <span class="badge bg-primary">{{ $discount->code }}</span>
                          </td>
                          <td class="min-width">
                            <span>{{ $discount->description }}</span>
                          </td>
                          <td class="min-width">
                          <span>{{ $discount->percentage }} %</span>
                          </td>
                          <td colspan="6">
                                <a href="{{ route('admin.discount.edit', $discount->id) }}" class="btn btn-warning">Edit</a>
                          </td>
                          <td>
                                <form action="{{ route('admin.discount.destroy', $discount->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">DELETE</button>
                                </form>
                          </td>
                        </tr>
                        @empty

                        @endforelse
                        <!-- end table row -->

                        <!-- end table row -->
                      </tbody>
                    </table>
                    <!-- end table -->
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
</div>
</div>

@endsection