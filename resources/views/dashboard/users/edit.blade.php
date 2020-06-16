@extends('layouts.dashboard.app')

@section('content')

<section class="content-header">
  <h1>@lang('site.users')</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index')}}"> @lang('site.dashboard')</a></li>
    <li><a href="{{ route('dashboard.users.index')}}"> @lang('site.users')</a></li>
    <li class="active">@lang('site.users_edit')</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('site.users_edit')</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
      @include('partials._errors')
      <form method="post" action="{{route('dashboard.users.update', $user->id)}}" enctype="multipart/form-data">
        {{ csrf_field()}}
        {{ method_field('put')}}
        <div class="form-group">
          <label >@lang('site.first_name')</label>
          <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
        </div>
        <div class="form-group">
          <label >@lang('site.last_name')</label>
          <input type="text" class="form-control" name="last_name" value="{{ $user->last_name}}">
        </div>
        <div class="form-group">
          <label >@lang('site.email')</label>
          <input type="email" class="form-control" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
          <label >@lang('site.image')</label>
          <input type="file" class="image" name="image" value="{{ old('email')}}">
        </div>
        <div class="form-group">
          <img src="{{$user->image_path}}" alt="default" class="image-preview img-thumbnail" width="60">
        </div>
        <div class="form-group">
          <label>@lang('site.permission')</label>
          <div class="nav-tabs-custom" >
            @php
              $models = ['users', 'categories', 'products'];
              $maps = ['create', 'read', 'update', 'delete'];
            @endphp
            <ul class="nav nav-tabs">
              @foreach($models as $index => $model)
                <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{$model}}" data-toggle="tab">@lang('site.' . $model)</a></li>
              @endforeach
            </ul>
            <div class="tab-content">
              @foreach($models as $index => $model)
                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{$model}}">
                  <?php foreach ($maps as $map): ?>
                    <label><input type="checkbox" {{ $user->hasPermission( $map .'_'. $model) ? 'checked' : '' }} name="permission[]" value="{{$map .'_'.$model}}">@lang('site.'. $map)</label><br>
                  <?php endforeach; ?>
                </div>
            @endforeach
            <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
        </div>
    </form>
  </div>
  <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
@endsection
