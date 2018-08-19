@extends('commons.master')

@section('title') {{$title}} @endsection
@if($metaDescription!=null) @section('metaDescription'){{ $metaDescription }}@endsection @endif
@if($metaKeywords!=null) @section('metaKeywords'){{ $metaKeywords }}@endsection @endif

@if($styles!=null) @section('styles'){{ $styles }}@endsection @endif
@if($scripts!=null) @section('scripts'){{ $scripts }}@endsection @endif

@section('sidebar')
  @include('layouts.app.sidebar')
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{$h1Title}}</h1>
      <ol class="breadcrumb">
        <li><a href="{{$breadcrumbParentlink}}"><i class="fa {{$breadcrumbFaIcon}}"></i>{{$breadcrumbParent}}</a></li>
        <li class="active">{{$breadcrumbChild}}</li>
      </ol>
    </section>
    @yield('app-content')
    <!-- /.content -->
  </div>
@endsection