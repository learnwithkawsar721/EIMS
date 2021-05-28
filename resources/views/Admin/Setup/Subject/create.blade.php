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
        <h3>Subject Setup</h3>
        <ul>
            <li>
                <a href="{{ route('admin') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('subjectsetup.index') }}">Subject</a>
            </li>
            <li>Subject SetUp</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add New Subject
                        <button value="{{ route('subjectsetup.index') }}" class="btn-fill-xl text-light bg-red add_button back_btn">Back</button>
                    </h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <form class="new-added-form" action="{{ route('subjectsetup.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-12 form-group ">
                        <label>Subject Name *</label>
                        <input type="text" name="subject_name" placeholder="Enter New Subject Name" class="form-control">
                        @error('subject_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                     <div class="col-xl-4 col-lg-6 col-12 form-group ">
                        <label>Subject Code *</label>
                        <input type="text" name="subject_code" placeholder="Enter New Subject Code" class="form-control">
                        @error('subject_code')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button  type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
{{-- main Content Section End --}}

{{-- Script Section Start --}}

@section('script')
<script>
    $(document).ready(function(){
         // return back Button Start
         $('.back_btn').click(function(){
            var url = $(this).val();
            window.location.href = url;
        })
        // return back Button End
    });
</script>
@endsection
{{-- Script Section End --}}
