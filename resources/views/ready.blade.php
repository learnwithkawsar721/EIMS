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
    <h3>Class Setup</h3>
    <ul>
        <li>
            <a href="{{ route('admin') }}">Home</a>
        </li>
        <li>Class SetUp</li>
    </ul>
</div>
<!-- Breadcubs Area End Here -->
<!-- Dashboard summery Start Here -->

<!-- Dashboard summery End Here -->

@endsection
{{-- main Content Section End --}}

{{-- Script Section Start --}}

@section('script')

@endsection
{{-- Script Section End --}}
