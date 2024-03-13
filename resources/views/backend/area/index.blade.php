@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">
                    Area List
                </h2>
                <form action="{{ route('area.index') }}" method="get" id="search_form" class="d-none">
                <div class="input-group input-group-sm">
					  		<input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name & Enter">
						</div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="datatable">
                    <tr>
                        <th>Serial</th>
                        <th>District</th>
                        <th>Thana</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @forelse($areas as $area)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $area->district['name'] ?? '' }}</td>
                        <td>{{ $area->thana['name'] ?? '' }}</td>
                        <td>{{ $area->name }}</td>
                        <td>{{ $area->status }}</td>
                        <td>
                            <form action="{{ route('area.destroy', $area->id) }}" method="POST">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_{{ $area->id }}">
                                   <i class="fa fa-edit"></i>
                                </button>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Subject?')"> <i class="fa fa-trash"></i> </button>
                            </form>



                            <!-- Modal -->
                            <div class="modal text-left fade" id="edit_{{ $area->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Subject</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('area.update', $area->id) }}" method="POST">
                                            @method("PUT")
                                            @csrf
                                            <input type="hidden" name="area_id" value="{{ $area->id }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="dristrict">District<span class="text-danger">*</span></label>
                                                    <select class="form-control" name="district_id" id="update_district_id" onchange="getThanaByDistrict_update()" required>
                                                        <option>Select</option>
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}" {{ ($area->district_id == $district->id) ? 'selected' : '' }}>{{ $district->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="thana_id">Thana<span class="text-danger">*</span></label>
                                                    <select class="form-control" name="thana_id" id="update_thana_id" required>
                                                        <option selected disabled></option>
                                                        @foreach(\App\Models\Thana::where('district_id', $area->district_id)->get() as $thana)
                                                            <option value="{{ $thana->id }}" @if($thana->id == $area->thana_id) selected @endif>{{ $thana->name }}</option>
                                                        @endforeach
                                                     </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{ $area->name }}" name="name" required>
                                                    @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="">Bangla Name<span class="text-muted">(optional)</span></label>--}}
{{--                                                    <input type="text" class="form-control" value="{{ $area->bn_name }}" name="bn_name">--}}
{{--                                                    @error('bn_name')--}}
{{--                                                        <small class="text-danger">{{ $message }}</small>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}

                                                <div class="form-group">
                                                    <label for="">Status<span class="text-danger">*</span></label>
                                                    <select name="status" class="form-control" id="" required>
                                                        <option value="Active" {{ $area->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                        <option value="Inactive" {{ $area->status == 'Inactive' ? 'selected' : '' }}>In-Active</option>
                                                    </select>
                                                    @error('bn_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
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
                <div class="pagination-area">
                    <div class="container">

                        <ul class="pagination">
                            @if($areas)
                            <li>  {{ $areas->links('pagination::bootstrap-4')  }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                <h2 class="header_title">
                    Add a new Area
                </h2>
                <form action="{{ route('area.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="dristrict">District<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="district_id" id="create_district_id" onchange="getThanaByDistrict_create()">
                            <option>Select</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="create_thana_id">Thana<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="thana_id" id="create_thana_id">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="">Bangla Name<span class="text-danger">*</span></label>--}}
{{--                        <input type="text" class="form-control" value="{{ old('bn_name') }}" name="bn_name">--}}
{{--                        @error('bn_name')--}}
{{--                            <small class="text-danger">{{ $message }}</small>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <label for="">Status<span class="text-danger">*</span></label>
                        <select name="status" class="form-control" id="">
                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>In-Active</option>
                        </select>
                        @error('bn_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Subject</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



        <script>
            function getThanaByDistrict_update() {
                var district_id = $("#update_district_id").val();
                $('#update_thana_id').find('option').remove().end();
                jQuery.ajax({
                    url: "{{ url(route('getThanaByDistrict')) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        district_id: district_id
                    },
                    method: "POST",
                    success: function(data) {
                        console.log(data.options);
                        document.getElementById("update_thana_id").innerHTML = data.options
                    },
                    error: function() {
                        alert('Something Getting Wrong! Please reload the page and try again')
                    }
                });
            }

            function getThanaByDistrict_create() {
                var district_id = $("#create_district_id").val();
                $('#create_thana_id').find('option').remove().end();
                jQuery.ajax({
                    url: "{{ url(route('getThanaByDistrict')) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        district_id: district_id
                    },
                    method: "POST",
                    success: function(data) {
                        console.log(data.options);
                        document.getElementById("create_thana_id").innerHTML = data.options
                    },
                    error: function() {
                        alert('Something Getting Wrong! Please reload the page and try again')
                    }
                });
            }
        </script>

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
     <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

     <script type="text/javascript">
         $(document).ready(function () {
             $('#datatable').dataTable();
         });
     </script>

@endsection
