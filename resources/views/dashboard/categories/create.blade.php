@extends('layouts.dashboard.app')

@section('content')

<section class="content-header">
  <h1>@lang('site.categories')</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index')}}"> @lang('site.dashboard')</a></li>
    <li><a href="{{ route('dashboard.categories.index')}}"> @lang('site.categories')</a></li>
    <li class="active">@lang('site.categories_add')</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('site.categories_add')</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
      @include('partials._errors')
      <form method="post" action="{{route('dashboard.categories.store')}}">
        {{ csrf_field()}}
        {{ method_field('post')}}
        @foreach(config('translatable.locales') as $locale)
          <div class="form-group">
            <label >@lang('site.' . $locale . '.name')</label>
            <input type="text" class="form-control" name="{{$locale}}[name]" value="{{ old($locale . '.name')}}">
          </div>
        @endforeach
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">@lang('site.categories_add')</button>
        </div>
    </form>
  </div>
  <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
@endsection
