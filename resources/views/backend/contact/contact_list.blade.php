@extends('backend.layouts.app')


@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Brand-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Add customer-->
                       	<h2> Contact List</h2>
                        <!--end::Add customer-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <form action="{{ route('contact.index') }}" method="get" id="search_form"></form>
                    <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_brand_table">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

                            <th class="">No.</th>
                            <th class="">Date</th>
                            <th class="">Name</th>
                            <th class="">Email</th>
                            <th class="">Phone</th>
                            <th class="">Message</th>
                            <th class="text-center min-w-70px">Actions</th>
                        </tr>

                        <tr>
                            <th>#</th>
                            <th>
                                <input type="text" name="created_at" placeholder="Date" form="search_form" class="form-control">
                            </th>
                            <th>
                                <input type="text" name="name" placeholder="Name" form="search_form" class="form-control">
                            </th>
                            <th>
                                <input type="text" name="email" placeholder="E-mail" form="search_form" class="form-control">
                            </th>
                            <th>
                                <input type="text" name="phone" placeholder="Phone" form="search_form" class="form-control">
                            </th>
                            <th>
                                <input type="text" name="message" placeholder="Message" form="search_form" class="form-control">
                            </th>
                            <th class="text-center">
                                <button class="btn btn-outline-dark" form="search_form" type="submit"><span class="fa fa-search"></span></button>
                            </th>
                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                        <!--begin::Table row-->
                        @php $i = 0; @endphp
                        @forelse ($data as $key => $value)
                            @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <!--begin::Checkbox-->
                                <td class="text-muted">
                                    <p class="d-block m-0">{{ $value->created_at->diffForHumans() }}</p>
                                    <small> {{ date_format(date_create($value->created_at),'d-m-Y') }}</small>
                                </td>
                                <!--end::Checkbox-->
                                <!--begin::Brand=-->
                                <td>
                                    <div class="text-muted fs-7 fw-bolder">{{ $value->name }}</div>
                                </td>
                                <!--end::Brand=-->
                                <!--begin::Type=-->
                                <td class="text-muted">{{ $value->email }}</td>
                                <td class="text-muted">{{ $value->phone }}</td>
                                <td class="text-muted">{{ $value->message }}</td>

                                <!--end::Type=-->
                                <!--begin::Action=-->
                                <td class="text-center">

                                    <ul class="list-inline m-0 list-unstyled">
                                        <li>
                                            <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app_{{ $value->id }}"><span class="fa fa-trash"></span> Delete</a>
                                            <div class="modal fade" id="kt_modal_create_app_{{ $value->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered mw-600px">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-dark">
                                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                <span class="svg-icon svg-icon-1">X</span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body py-lg-10 px-lg-10 text-left">
                                                            <h2 class="text-left">Are you sure to delete?</h2>
                                                            <p class="text-left">If you yes, the Message will be deleted permanently and can not be undone.</p>

                                                        </div>
                                                        <div class="modal-footer py-2">
                                                            <a href="#" data-bs-dismiss="modal" class="btn btn-secondary">Close</a>
                                                            {!! Form::open(['method' => 'DELETE','route' => ['contact_delete', $value->id],'style'=>'display:block']) !!}
                                                            {!! Form::submit('Yes', ['class' => 'px-5 btn btn-danger']) !!}

                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <!--end::Menu-->
                                </td>
                                <!--end::Action=-->
                            </tr>
                            @empty
                            <tr>
                                <td colspan="25" class="text-center">Contact Not Found</td>
                            </tr>
                        @endforelse
                        <!--end::Table row-->

                        </tbody>
                        <!--end::Table body-->
                    </table>
                    </div>
                    <!--end::Table-->
                    <!-- paginations start -->
                    <div class="pagination-area">
                        <div class="container">

                            <ul class="pagination">
                                @if($data)
                                <li>  {{ $data->links('pagination::bootstrap-4')  }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- paginations end -->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Brand-->
        </div>
        <!--end::Container-->
    </div>



@endsection

