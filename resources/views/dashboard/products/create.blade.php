@extends('layouts.dashboard.app')

@section('content')

<section class="content-header">
  <h1>@lang('site.products')</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index')}}"> @lang('site.dashboard')</a></li>
    <li><a href="{{ route('dashboard.products.index')}}"> @lang('site.products')</a></li>
    <li class="active">@lang('site.products_add')</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('site.products_add')</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
      @include('partials._errors')
      <form method="post" action="{{route('dashboard.products.store')}}" enctype="multipart/form-data">
        {{ csrf_field()}}
        {{ method_field('post')}}

        <div class="form-group">
          <label>@lang('site.categories')</label>
          <select name="category_id" class="form-control">
            <option value="">@lang('site.all_categories')</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        @foreach(config('translatable.locales') as $locale)
          <div class="form-group">
            <label >@lang('site.' . $locale . '.name')</label>
            <input type="text" class="form-control" name="{{$locale}}[name]" value="{{ old($locale . '.name')}}">
          </div>
          <div class="form-group">
            <label >@lang('site.' . $locale . '.description')</label>
            <textarea class="form-control ckeditor" name="{{$locale}}[description]">{{ old($locale . '.description')}}</textarea>
          </div>
        @endforeach

        <div class="form-group">
          <label >@lang('site.image')</label>
          <input type="file" class="image" name="image" value="{{ old('email')}}">
        </div>

        <div class="form-group">
          <img src="{{asset('uploads/product_images/default.png')}}" alt="default" class="image-preview img-thumbnail" width="60">
        </div>

        <div class="form-group">
          <label>@lang('site.purchase_price')</label>
          <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ old('purchase_price') }}">
        </div>

        <div class="form-group">
          <label>@lang('site.sale_price')</label>
          <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}">
        </div>

        <div class="form-group">
          <label>@lang('site.stock')</label>
          <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">@lang('site.products_add')</button>
        </div>
    </form>
  </div>
  <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
@endsection
