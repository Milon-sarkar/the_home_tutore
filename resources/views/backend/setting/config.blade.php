@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <form id="kt_ecommerce_settings_general_form" class="form" action="{{ route('setting.update', 1) }}" method="POST" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <!--begin::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Organization Name</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set the name of the organization"></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="name"
                                   value="{{ $setting->name }}" />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Owner Name</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set the store owner's name"></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="owner"
                                   value="{{ $setting->owner }}" />
                            @error('owner')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Address</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set the store's full address."></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid"
                                      name="address">{{ $setting->address }}</textarea>
                            @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span>Geocode</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Enter the store geocode manually (optional)"></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="geocode"
                                   value="{{ $setting->geocode }}" />
                            @error('geocode')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Email</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="email" class="form-control form-control-solid" name="email"
                                   value="{{ $setting->email }}" />
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Phone</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="phone"
                                   value="{{ $setting->phone }}" />
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="required">Meta Title</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set the title of the store for SEO."></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="meta_title"
                                   value="{{ $setting->meta_title }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span>Meta Tag Description</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set the description of the store for SEO."></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid"
                                      name="meta_description">{{ $setting->meta_description }}</textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span>Meta Keywords</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set keywords for the store separated by a comma."></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="meta_keywords"
                                   value="{{ $setting->meta_keywords }}" data-kt-ecommerce-settings-type="tagify" />
                            <!--end::Input-->
                        </div>
                    </div>

                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span>Logo</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set keywords for the store separated by a comma."></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Thumbnail settings-->
                            <div class="card card-flush py-4">
                                <div class="card-body text-center pt-0 d-flex justify-content-center">
                                    <div style="width: 200px; height: auto; position: relative">
                                        <img src="{{ $setting->logo }}" class="w-100 img-thumbnail" alt="LOGO" id="logo">
                                        <label>
                                            <input type="file" name="logo" accept=".png" class="d-none" id="imgInp" />
                                            <i class="fa fa-pencil cursor-pointer p-2 bg-light text-dark" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; border: 2px solid #666;"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span>Favicon</span>
                                <i class="fa fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Set keywords for the store separated by a comma."></i>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Thumbnail settings-->
                            <div class="card card-flush py-4">
                                <div class="card-body text-center pt-0 d-flex justify-content-center">
                                    <div style="width: 200px; height: auto; position: relative">
                                        <img src="{{ $setting->favicon}}" class="w-100 img-thumbnail" alt="FAVICON" id="favicon">
                                        <label>
                                            <input type="file" name="favicon" accept=".png" class="d-none" id="imgInpFavicon" />
                                            <i class="fa fa-pencil cursor-pointer p-2 bg-light text-dark" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; border: 2px solid #666;"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--end::Input group-->
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Facebook</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="facebook"
                                   value="{{ $setting->facebook }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Instagram</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="instagram"
                                   value="{{ $setting->instagram }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Linkedin</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="linkedin"
                                   value="{{ $setting->linkedin }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Youtube</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="youtube"
                                   value="{{ $setting->youtube }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Twitter</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="twitter"
                                   value="{{ $setting->twitter }}" />
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Important Link</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            @if($setting->link != null)
                                @php
                                    $links =  json_decode($setting->link);
                                @endphp
                                @forelse ($links as $link)
                                    @php $link = (array) $link; @endphp
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">

                                            <input type="text" name="link_names[]" value="{{ $link['name'] }}" class="form-control m-input" placeholder="Enter Name" autocomplete="off">
                                            <input type="text" name="links[]" value="{{ $link['link'] }}" class="form-control m-input" placeholder="Enter Link" autocomplete="off">

                                            <div class="input-group-append">
                                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                @empty

                                @endforelse

                            @endif
                            <div id="newRow"></div>
                            <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                            <!--end::Input-->
                        </div>

                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <h2>Welcoming Image Manipulation</h2>
                        </div>
                    </div>


                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Welcoming Title</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="welcome_title_on_image"
                                   value="{{ $setting->welcome_title_on_image }}" />
                            @error('welcome_title_on_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Welcoming Short Title</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="welcome_short_title_on_image"
                                   value="{{ $setting->welcome_short_title_on_image }}" />
                            @error('welcome_short_title_on_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row fv-row mb-3">
                        <div class="col-md-3 text-md-end">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold form-label mt-3">
                                <span class="">Image</span>
                            </label>
                            <!--end::Label-->
                        </div>
                        <div class="col-md-9">
                            <div class="form-group mt-3">
                                <label for="">Image (PNG) (MX Width 580px)</label> <br>
                                <label>
                                    <div style=" cursor: pointer; position: relative;">
                                        <img src="{{ welcome_img($setting->welcome_image) }}" class="img-fluid img-thumbnail" id="thumbnail_img" alt="">
                                        <input type="file" class="d-none" id="images" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="welcome_image" id="thumbnail_input"  readonly/>
                                        <span class="fa fa-pencil cursor-pointer p-2 bg-light text-dark" style="position: absolute; top: -10px; right: -10px; border-radius: 50%; border: 2px solid #666;"></span>
                                    </div>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="welcome_dark_overlay_on_image" {{ $setting->welcome_dark_overlay_on_image == 1 ? 'checked' : '' }}> Dark Color Overlay on the Image
                                </label>
                            </div>
                        </div>
                    </div>


                    <!--begin::Action buttons-->
                    <div class="row">
                        <div class="col-md-9 offset-md-3">
                            <!--begin::Separator-->
                            <div class="separator mb-6"></div>
                            <!--end::Separator-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <button type="reset" data-kt-ecommerce-settings-type="cancel"
                                        class="btn btn-light me-3">Cancel</button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" data-kt-ecommerce-settings-type="submit"
                                        class="btn btn-primary">
                                    <span class="indicator-label">Save</span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>
                    <!--end::Action buttons-->
                </form>

            </div>
        </div>
    </div>
@endsection

@push('modals')
    {{-- Crop image modal --}}
    <div id="image_crop_modal" class="modal" role="dialog">
        <div class="modal-dialog modal-lg" id="crop_modal_type" style="min-width: 800px; margin: 0 auto;">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title text-capitalize">cropt image</h4>
                    <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo" class="m-auto mt-2 ml-0"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="rotate_left"  data-deg="-90" class="btn btn-secondary text-capitalize">rotate left</button>
                    <button type="button" id="rotate_right"  data-deg="90" class="btn btn-secondary text-capitalize">rotate right</button>
                    <button type="button" class="btn btn-secondary text-capitalize" data-dismiss="modal" data-bs-dismiss="modal">close</button>
                    <button class="btn btn-success text-capitalize crop_image">crop</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Crop image modal end--}}
@endpush


@push('footer_js')


    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script src="{{ asset('js/croppie.js') }}"></script>

    <script>
        $(function() {
            // Multiple images preview with JavaScript

            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 700,
                    height: 281,
                    type: 'square' //circle
                },
                boundary: {
                    width: 750,
                    height: 300
                },
                enableOrientation: true
            });

            $('#images').on('change', function () {
                if (this.files) {
                    var filesAmount = this.files.length;

                    ///The loop is used for if there are multiple photos need to be selected.
                    for (i = 0; i < filesAmount; i++) {

                        if(i > 1){
                            break
                            alert('maximum of image quantity is 25')
                        }

                        var reader = new FileReader();
                        reader.onload = function (event) {
                            $image_crop.croppie('bind', {
                                url: event.target.result
                            });
                        }
                        $('#rotate_left,#rotate_right').on('click', function (ev) {
                            $image_crop.croppie('rotate', parseInt($(this).data('deg')));
                        });
                        reader.readAsDataURL(this.files[0]);
                        $('#image_crop_modal').modal('show');
                    }
                }
            });

            $('.crop_image').click(function (event) {
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function (response) {

                    d = new Date();
                    let time = d.getTime();

                    $("#thumbnail_input").val(response)
                    $("#thumbnail_img").attr('src', response)

                    $('#image_crop_modal').modal('hide');

                    var element = document.getElementById('image_input');
                    element.dispatchEvent(new Event('input'));

                });
            });


        });

    </script>

    <script type="text/javascript">
        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="link_names[]" class="form-control m-input" placeholder="Enter Name" autocomplete="off">';
            html += '<input type="text" name="links[]" class="form-control m-input" placeholder="Enter Link" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                logo.src = URL.createObjectURL(file)
            }
        }

        imgInpFavicon.onchange = evt => {
            const [file] = imgInpFavicon.files
            if (file) {
                favicon.src = URL.createObjectURL(file)
            }
        }
    </script>


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
@endpush
