@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Premium Package List
                </h2>
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th>Title</th>
                        <th title="Total Month">Duration</th>
                        <th>Price</th>
                        <th style="width: 30%">Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @forelse($premium_packages as $premium_package)

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $premium_package->title }}</td>
                        <td>{{ $premium_package->duration }}</td>
                        <td>{{ $premium_package->price }}</td>
                        <td class="text-justify">{{ $premium_package->description }}</td>
                        <td>{!! $premium_package->status == 1 ? '<span class="badge badge-info badge-sm">Active</span>' : '<span class="badge badge-danger badge-sm">In-Active</span>' !!}</td>
                        <td>
                            <form action="{{ route('premium_package.destroy', $premium_package->id) }}" method="POST">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $premium_package->id }}">
                                   <i class="fa fa-edit"></i>
                                </button>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Premium Package?')"> <i class="fa fa-trash"></i> </button>
                            </form>



                            <!-- Modal -->
                            <div class="modal text-left fade" id="edit_{{ $premium_package->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Premium Package</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('premium_package.update', $premium_package->id) }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Name</label>
                                                            <input type="text" class="form-control" name="edit_title" value="{{ $premium_package->title }}">
                                                            @error('edit_title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Status</label>
                                                            <select name="edit_status" id="" class="form-control">
                                                                <option value="1">Active</option>
                                                                <option value="0">In-Active</option>
                                                            </select>
                                                            @error('edit_status')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Price (TK)</label>
                                                            <input type="number" class="form-control" name="edit_price" value="{{ $premium_package->price }}">
                                                            @error('edit_price')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Total Month</label>
                                                            <input type="number" class="form-control" name="edit_duration" value="{{ $premium_package->duration }}">
                                                            <small class="fa fa-info-circle text-muted"><i>How Many Month available applicable this package...</i></small>
                                                            @error('edit_duration')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Description</label>
                                                            <textarea rows="5" class="form-control w-100" name="edit_description" style="height: 100px;">{{ $premium_package->description }}</textarea>
                                                            @error('edit_description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <table class="table" style="min-height: {{ count($premium_package_items) * 40}}px !important;">
                                                        @php $selected_items = (array) $premium_package->selected_items @endphp
                                                        @forelse($premium_package_items as $premium_package_item)
                                                            <tr>
                                                                <td>
                                                                    <label for="{{ $premium_package_item->id.'_item_edit' }}" class="cursor-pointer">{{ $premium_package_item->name }}</label>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="checkbox" name="items[]"
                                                                       value="{{ $premium_package_item->id }}"
                                                                       id="{{ $premium_package_item->id.'_item_edit' }}"
                                                                       @foreach($selected_items as $selected_item)
                                                                           @if($selected_item == $premium_package_item->id)
                                                                               {{ 'checked' }}
                                                                            @endif
                                                                        @endforeach

                                                                    >
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="25"></td>
                                                            </tr>
                                                        @endforelse
                                                    </table>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="10">No Data Found</td>
                        </tr>
                    @endforelse
                </table>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                <h2 class="header_title">
                    Add a new Premium Package
                </h2>
                <form action="{{ route('premium_package.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control select2">
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Price (TK)</label>
                        <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Total Month</label>
                        <input type="number" class="form-control" name="duration" value="{{ old('duration') }}">
                        <small class="fa fa-info-circle text-muted"><i>How Many Month available applicable this package...</i></small>
                        @error('duration')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea rows="5" class="form-control w-100" name="description" style="height: 100px;">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <table class="table">
                            @forelse($premium_package_items as $premium_package_item)
                            <tr>
                                <td>
                                    <label for="{{ $premium_package_item->id.'_item' }}" class="cursor-pointer">{{ $premium_package_item->name }}</label>
                                </td>
                                <td>
                                    <input type="checkbox" name="items[]" value="{{ $premium_package_item->id }}" id="{{ $premium_package_item->id.'_item' }}">
                                </td>
                            </tr>
                           @empty
                            <tr>
                                <td colspan="25"></td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Premium Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('javascript')
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            $('.summernote').summernote({
                height: 530,                 // set editor height
                toolbar: [
                    [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'underline'] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', [ 'link'] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', ] ]
                ]
            });
        })
    </script>
@endsection
