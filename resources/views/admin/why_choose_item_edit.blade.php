@extends('admin.layout.app')
@section('heading', 'Edit Why Choose')

@section('button')
    <div>
        <a href="{{ route('admin_why_choose_item') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
    </div>
@endsection
@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_why_choose_item_update', $single_why_choose_item->id) }}" method="post">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <label>Category Icon</label>
                                <input type="text" class="form-control" name="icon"
                                    value="{{ $single_why_choose_item->icon }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Icon Preview</label>
                                <div>
                                    <i class="{{ $single_why_choose_item->icon }}"></i>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Heading</label>
                                <input type="text" class="form-control" name="heading"
                                    value="{{ $single_why_choose_item->heading }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Text</label>
                                <textarea name="text" class="form-control h_100"  cols="30" rows="10">{{ $single_why_choose_item->text }}</textarea>
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
