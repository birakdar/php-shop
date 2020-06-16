@extends('layouts.dashboard.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@lang('site.users') <small>{{ $users->total()}}</small> </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index')}}">@lang('site.dashboard')</a></li>
    <li class="active">@lang('site.users')</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    @if(auth()->user()->hasPermission('create_users'))
      <a href="{{route('dashboard.users.create')}}" class="btn btn-sm btn-success m-1 inline-block"> @lang('site.add')</a>
    @else
      <button type="button" class="btn btn-success disabled btn-sm m-1">@lang('site.add')</button>
    @endif
    <div class="box-search inline-block">
      <form action="{{route('dashboard.users.index')}}" class="navbar-form" role="search">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="@lang('site.search')" value="{{ request()->search }}" >
        </div>
        <button type="submit" class="btn btn-default">@lang('site.search')</button>
      </form>
    </div>
    <?php if ($users->count() > 0): ?>
    <!-- <div class="box-header with-border">
      <h3 class="box-title">Bordered Table</h3>
    </div> -->
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered text-center">
        <tr>
          <th style="width: 10px">#</th>
          <th>@lang('site.first_name')</th>
          <th>@lang('site.last_name')</th>
          <th>@lang('site.email')</th>
          <th>@lang('site.image')</th>
          <th>@lang('site.action')</th>
        </tr>
        <tbody class="">
          <?php foreach ($users as $key => $value): ?>
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{ $value->first_name}}</td>
              <td>{{ $value->last_name}}</td>
              <td>{{ $value->email}}</td>
              <td><img src="{{ $value->image_path}}" alt="{{ $value->image}}" width="70" class="img-thumbnail"></td>
              <td>
                @if(auth()->user()->hasPermission('update_users'))
                  <a class="btn btn-info btn-sm" href="{{route('dashboard.users.edit', $value->id)}}">@lang('site.edit')</a>
                @else
                  <button type="button" class="btn btn-info disabled btn-sm">@lang('site.edit')</button>
                @endif
                @if(auth()->user()->hasPermission('delete_users'))
                  <form class="inline-block" action="{{route('dashboard.users.destroy', $value->id)}}" method="post">
                    {{ csrf_field()}}
                    {{ method_field('delete')}}
                    <button type="submit" class="btn delete btn-sm btn-danger">@lang('site.delete')</button>
                  </form>
                @else
                  <button type="button" class="btn btn-danger disabled btn-sm">@lang('site.delete')</button>
                @endif
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
    {{ $users->appends(request()->query())->links() }}
  </div>
  <!-- /.box -->
  <?php else: ?>
    <p>@lang('site.no_data_found')</p>
  <?php endif; ?>
</section>
@endsection
