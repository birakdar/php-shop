@extends('layouts.dashboard.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@lang('site.categories') <small>{{ $categories->total()}}</small> </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index')}}">@lang('site.dashboard')</a></li>
    <li class="active">@lang('site.categories')</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    @if(auth()->user()->hasPermission('create_categories'))
      <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-success m-1 inline-block"> @lang('site.add')</a>
    @else
      <button type="button" class="btn btn-success disabled btn-sm m-1">@lang('site.add')</button>
    @endif
    <div class="box-search inline-block">
      <form action="{{route('dashboard.categories.index')}}" class="navbar-form" role="search">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="@lang('site.search')" value="{{ request()->search }}" >
        </div>
        <button type="submit" class="btn btn-default">@lang('site.search')</button>
      </form>
    </div>
    <?php if ($categories->count() > 0): ?>
    <!-- <div class="box-header with-border">
      <h3 class="box-title">Bordered Table</h3>
    </div> -->
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered text-center">
        <tr>
          <th style="width: 10px">#</th>
          <th>@lang('site.name')</th>
            <th>@lang('site.product_count')</th>
            <th>@lang('site.action')</th>
        </tr>
        <tbody class="">
          <?php foreach ($categories as $key => $value): ?>
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{ $value->name}}</td>
              <td>{{ $value->products->count()}}</td>
              <td>
              <a class="btn btn-success btn-sm" href="{{route('dashboard.products.index', ['category_id' => $value->id ])}}">@lang('site.related_products')</a>
              @if(auth()->user()->hasPermission('update_categories'))
                  <a class="btn btn-info btn-sm" href="{{route('dashboard.categories.edit', $value->id)}}">@lang('site.edit')</a>
                  @else
                      <button type="button" class="btn btn-info disabled btn-sm">@lang('site.edit')</button>
                @endif
                @if(auth()->user()->hasPermission('delete_categories'))
                  <form class="inline" action="{{route('dashboard.categories.destroy', $value->id)}}" method="post">
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
    {{ $categories->appends(request()->query())->links() }}
  </div>
  <!-- /.box -->
  <?php else: ?>
    <p>@lang('site.no_data_found')</p>
  <?php endif; ?>
</section>
@endsection
