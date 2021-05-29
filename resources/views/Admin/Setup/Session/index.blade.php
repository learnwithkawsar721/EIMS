{{-- extends with resources/views/layouts/dashboard --}}
@extends('layouts.dashboard')

{{-- title section Start --}}
@section('title')
    Setup
@endsection
{{-- title section End --}}

{{-- dashboar Active Section Start --}}
@section('setup')
    active
@endsection
{{-- dashboar Active Section End --}}

{{-- main Content Section Start --}}
@section('dashboard')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Session Setup</h3>
        <ul>
            <li>
                <a href="{{ route('admin') }}">Home</a>
            </li>
            <li>Session SetUp</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- ClassSetUp summery Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Session
                        <a href="{{ route('sessionsetup.create') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow add_button"><i class="fa fa-plus"></i> Add</a>
                    </h3>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Session</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_Session as $item)

                            <tr>

                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->session_name }}</td>
                                <td>
                                    @if ($item->updated_at)
                                        {{ $item->updated_at->diffForHumans() }}
                                    @else
                                        {{ $item->created_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <button value="{{ route('sessionsetup.edit', $item->id) }}"
                                        class="btn-fill-md text-light bg-dodger-blue btn-hover-bluedark add_button edit_submit_btn">Edit</button>
                                    <button value="{{ route('sessionsetup.delete',$item->id) }}" class="btn-fill-md radius-4 text-light bg-orange-red btn-hover-bluedark add_button delete_btn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ClassSetUp summery End Here -->

@endsection
{{-- main Content Section End --}}

{{-- Script Section Start --}}

@section('script')
    <script>
        $(document).ready(function() {
            // Edit Page Show Start
            $('.edit_submit_btn').click(function() {
                var value = $(this).val();
                window.location.href = value;
            });
            // Edit Page Show End

            // Sweetalert2 code Start
            $('.delete_btn').click(function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var value = $(this).val();
                        window.location.href = value;
                    }
                })
            })
            // Sweetalert2 code End
        });

    </script>
@endsection
{{-- Script Section End --}}
