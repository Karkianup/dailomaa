@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <form role="form" action="{{route('site-settings.update',$site_setting['id'])}}" method="POST"
        enctype="multipart/form-data">
        @method('put')
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger col-md-12">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-cog fa-2x"></i>
                        </div>
                        @include('Dashboard.Commons.breadcrum')
                    </div>
                    @include('Dashboard.Admin.SiteSettings.fields')

                </div>
                @include('Dashboard.Admin.SiteSettings.logo-section')
                @include('Dashboard.Admin.SiteSettings.social-links')

            </div>
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">contacts</i>
                        </div>
                        <h4 class="card-title">SEO</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group bmd-form-group">
                            <label for="exampleEmails" class="bmd-label-floating"> Meta Title *</label>
                            <input type="text" class="form-control" value="{{$site_setting['meta_title']}}"
                                name="meta_title" id="meta_title" required="true" aria-required="true">
                        </div>

                        <div class="form-group bmd-form-group">
                            <label for="exampleEmails" class="bmd-label-floating"> Meta Keywords *</label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="10"
                                required="true" aria-required="true">{{$site_setting['meta_keywords']}}</textarea>
                        </div>

                        <div class="form-group bmd-form-group">
                            <label for="exampleEmails" class="bmd-label-floating"> Meta Description *</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" rows="10"
                                required="true" aria-required="true">{{$site_setting['meta_description']}}</textarea>
                        </div>

                    </div>

                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">Action</h3>
                        </div>
                        <div class="box-footer" style="display: block;">
                            {{-- <input class="btn btn-primary" type="submit" name="action" value="Update"> --}}
                            <button class="btn btn-primary" type="submit" name="action">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection