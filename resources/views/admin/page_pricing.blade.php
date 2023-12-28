@extends('admin.layout.app')
@section('heading', 'Pricing Page')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_pricing_page_update') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Heading</label>
                                <input type="text" class="form-control" name="heading"
                                    value="{{ $page_pricing_data ->heading }}">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ $page_pricing_data ->title }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Meta Description</label>
                                <input type="text" class="form-control" name="meta_description"
                                    value="{{ $page_pricing_data ->meta_description }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
