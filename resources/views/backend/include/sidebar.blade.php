<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <style>
            .nav-divider{
                height: 2px !important;
                color: #f8fafc;
            }
        </style>
        <!--- Sidemenu -->


        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                @php
                    $applied_tuition = \App\Models\TuitionBook::select('id')->where('status','2')->count();
                    $pending_tuition = \App\Models\TuitionBook::select('id')->where('status','0')->count();
                    $booked_tuition = \App\Models\TuitionBook::select('id')->where('status','1')->count();
                    $pending_charge = \App\Models\Payment::select('id')->where('status','Pending')->where('payment_for','tuition_book')->count();

                    $not_applied = 0;

                @endphp
                <li>
                    <a href="javascript: void(0);" class="text-muted d-block" uk-toggle="target: #offcanvas-usage">
                        <i class="fa fa-list-alt"></i><span>Details Menubar</span>
                    </a>
                </li>

                @canany(['users.index','roles.create','permissions.index'])
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-user-o"></i> <span> Users </span>
                        </a>
                        <ul class="nav-second-level" aria-expanded=false>
                            @can('users.index') <li><a href="{{ route('users.index') }}">Users</a></li>@endcan
                            @can('roles.index') <li><a href="{{ route('roles.index') }}">Roles</a></li>@endcan
                            @can('permissions.index')<li><a href="{{ route('permissions.index') }}">Permission</a></li>@endcan
                        </ul>
                    </li>
                @endcanany

                    @can('tuitions.create')<li><a href="{{ route('tuitions.create') }}"><i class="fa fa-plus"></i> <span> Create Tuition</span></a></li>@endcan
                    @can('tuition_book.create')  <li><a href="{{ route('tuition_book.create') }}"><i class="fa fa-plus-circle"></i>  <span> Create Book Tuition</span></a></li> @endcan
                    @can('guardian_or_student.create')<li><a href="{{ route('guardian_or_student.create') }}?type=guardian"><i class="fa fa-plus-circle"></i><span>Guardian Add</span></a></li>@endcan
                    @can('sent_notification')
                    <li>
                        <a href="{{ route('review') }}">
                            <i class="fa fa-phone"></i><span>Review Message</span>
                        </a>
                    </li>
                    @endcan
                    @can('sent_notification')
                    <li>
                        <a href="{{ route('urgent_contact') }}">
                            <i class="fa fa-phone"></i><span>Hire Tutor Number <span id="hiretutorcount" class="float-end badge badge-primary">1</span></span>

                        </a>
                        
                    </li>
                    @endcan
                    @can('tuitions.index')<li><a href="{{ route('tuitions.index') }}"><i class="fa fa-briefcase"></i> <span> Tuition List</span></a></li> @endcan

{{--                    @canany(['tuition_comment.index','tuition_comment.create'])--}}
{{--                        <li>--}}
{{--                            <a href="javascript: void(0);">--}}
{{--                                <i class="fa fa-comment"></i> <span> Tuition Comments </span>--}}
{{--                            </a>--}}
{{--                            <ul class="nav-second-level" aria-expanded=false>--}}
{{--                                @can('tuition_comment.index')<li><a href="{{ route('tuition_comment.index') }}">Comments</a></li>@endcan--}}
{{--                                @can('tuition_comment.create') <li><a href="{{ route('tuition_comment.create') }}">Comments Create</a></li>@endcan--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    @endcanany--}}
                    @can('tutors.index') <li><a href="{{ route('tutors.index') }}"><i class="fa fa-users"></i>  <span> Tutor List</span></a></li>@endcan
                <hr class="my-1 nav-divider">
                <style>
                    .active_now{ background-color: #666f7b }
                </style>
                    @can('tuition_book.index') <li class="{{ request()->get('applied_book') ? 'active_now' : '' }}"><a href="{{ route('tuition_book.index') }}?applied_book=true"><i class="fa fa-thumbs-o-up"></i>  <span> Applied Tuition </span><span class="float-end badge {{ $applied_tuition > 0 ? 'badge-danger' : 'badge-secondary' }}">{{ $applied_tuition }}</span></a></li> @endcan
                    @can('tuition_book.index') <li class="{{ request()->get('pending_book') ? 'active_now' : '' }}"><a href="{{ route('tuition_book.index') }}?pending_book=true"><i class="fa fa-list-alt"></i>  <span> Pending Tuition</span> <span class="float-end badge {{ $pending_tuition > 0 ? 'badge-danger' : 'badge-secondary' }}">{{ $pending_tuition }}</span></a></li> @endcan
                    @can('tuition_book.index') <li class="{{ request()->get('booked_tuition') ? 'active_now' : '' }}"><a href="{{ route('tuition_book.index') }}?booked_tuition=true"><i class="fa fa-handshake-o"></i> <span> Confirmed</span>  <span class="float-end badge badge-primary">{{ $booked_tuition }}</span></a></li> @endcan
                    @can('tuition_book.index') <li class="{{ request()->get('pending_charge') ? 'active_now' : '' }}"><a href="{{ route('tuition_book.index') }}?pending_charge=true"><i class="fa fa-money"></i> <span> Pending Charge</span> </a></li> @endcan
                    @can('tuition_book.index') <li class="{{ request()->get('not_applied') ? 'active_now' : '' }}"><a href="{{ route('tuition_book.index') }}?not_applied=true"><i class="fa fa-thumbs-down"></i>  <span> Not Applied</span></a></li> @endcan
                    @can('tuition_book.index') <li class="{{ request()->get('rejected') ? 'active_now' : '' }}"><a href="{{ route('tuition_book.index') }}?rejected=true"><i class="fa fa-times"></i>  <span> Rejected List</span></a></li> @endcan
                    @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}"><i class="fa fa-handshake-o"></i> <span> Book Tuition (All List) </span></a></li> @endcan
                <hr class="my-1 nav-divider">
                    @can('guardian_or_student.index') <li><a href="{{ route('guardian_or_student.index') }}?type=guardian"><i class="fa fa-user-md"></i><span>Guardian List</span></a></li>@endcan
                    @can('guardian_or_student.index') <li><a href="{{ route('guardian_or_student.index') }}?type=student"><i class="fa fa-graduation-cap"></i><span>Student List</span></a></li>@endcan
                <hr class="my-1 nav-divider">
                    @can('tutors.create')<li><a href="{{ route('tutors.create') }}"><i class="fa fa-plus-circle"></i>Tutor Add</a></li>@endcan
                    @can('guardian_or_student.create')<li><a href="{{ route('guardian_or_student.create') }}?type=student"><i class="fa fa-plus-circle"></i><span>Student Add</span></a></li>@endcan
                @can('sent_sms')
                    <li>
                        <a href="{{ route('sent_sms') }}">
                            <i class="fa fa-comment"></i><span>Sent SMS</span>
                        </a>
                    </li>
                @endcan
                @can('sent_notification')
                    <li>
                        <a href="{{ route('sent_notification') }}">
                            <i class="fa fa-comment"></i><span>Sent Notification</span>
                        </a>
                    </li>
                @endcan

                {{-- @can('sent_notification')
                <li>
                    <a href="{{ route('urgent_contact') }}">
                        <i class="fa fa-phone"></i><span>Hire Tutor Contact Number</span>
                    </a>
                </li>
                @endcan --}}
            </ul>

        </div>




        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>


<div id="offcanvas-usage" uk-offcanvas>
    <div class="uk-offcanvas-bar">

        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <ul class="uk-nav uk-nav-default">

            @canany(['users.index','roles.create','permissions.index'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-user-o"></i> <span> Users </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('users.index') <li><a href="{{ route('users.index') }}">Users</a></li>@endcan
                        @can('roles.index') <li><a href="{{ route('roles.index') }}">Roles</a></li>@endcan
                        @can('permissions.index')<li><a href="{{ route('permissions.index') }}">Permission</a></li>@endcan
                    </ul>
                </li>
            @endcanany

            @canany(['tuitions.index','tuitions.create'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-suitcase"></i> <span> Tuition Post </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('tuitions.index')<li><a href="{{ route('tuitions.index') }}">Tuition List</a></li> @endcan
                        @can('tuitions.create')<li><a href="{{ route('tuitions.create') }}">Create Tuition</a></li> @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['tuition_book.index','tuition_book.create'])
                <li>
                    <a href="javascript: void(0);">


                        <i class="fa fa-suitcase"></i> <span>Book Tuition <SUP class="{{ ($applied_tuition + $pending_tuition > 0) ? 'fa fa-circle text-danger' : '' }}"></SUP></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('tuition_book.create')  <li><a href="{{ route('tuition_book.create') }}">Create Book Tuition</a></li> @endcan
                        @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}?applied_book=true">Applied Tuition <span class="float-end badge {{ $applied_tuition > 0 ? 'badge-danger' : 'badge-secondary' }}">{{ $applied_tuition }}</span></a></li> @endcan
                        @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}?pending_book=true">Pending Tuition  <span class="float-end badge {{ $pending_tuition > 0 ? 'badge-danger' : 'badge-secondary' }}">{{ $pending_tuition }}</span></a></li> @endcan
                        @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}?booked_tuition=true">Booked Tuition  <span class="float-end badge {{ $pending_tuition > 0 ? 'badge-danger' : 'badge-secondary' }}">{{ $booked_tuition }}</span></a></li> @endcan
                        @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}?pending_charge=true">Pending Charge  </a></li> @endcan
                            @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}?not_applied=true">Not Applied</a></li> @endcan
                            @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}?rejected=true">Rejected</a></li> @endcan
                        @can('tuition_book.index') <li><a href="{{ route('tuition_book.index') }}">Book Tuition (All List)</a></li> @endcan


                    </ul>
                </li>
            @endcanany

            <hr class="my-1 nav-divider">

            @canany(['tutors.index','tutors.create'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fi-air-play"></i> <span> Tutors </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('tutors.index') <li><a href="{{ route('tutors.index') }}">Tutor List</a></li>@endcan
                        @can('tutors.index') <li><a href="{{ route('tutors.index') }}?inactive_tutors=true">Inactive Tutor</a></li>@endcan
                        @can('tutors.create')<li><a href="{{ route('tutors.create') }}">Tutor Add</a></li>@endcan
                    </ul>
                </li>
            @endcanany
            @canany(['guardian_or_student.index','guardian_or_student.create'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fi-air-play"></i> <span> Guardians </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('guardian_or_student.index') <li><a href="{{ route('guardian_or_student.index') }}?type=guardian">Guardian List</a></li>@endcan
                        @can('guardian_or_student.create')<li><a href="{{ route('guardian_or_student.create') }}?type=guardian">Guardian Add</a></li>@endcan
                    </ul>
                </li>
            @endcanany
            @canany(['guardian_or_student.index','guardian_or_student.create'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fi-air-play"></i> <span> Students </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('guardian_or_student.index') <li><a href="{{ route('guardian_or_student.index') }}?type=student">Student List</a></li>@endcan
                        @can('guardian_or_student.create')<li><a href="{{ route('guardian_or_student.create') }}?type=student">Student Add</a></li>@endcan
                    </ul>
                </li>
            @endcanany
            <hr class="my-1 nav-divider">
            @can('payment.index') <li>
                <a href="{{ route('payment.index') }}">
                    <i class="fa fa-money"></i> Payment
                </a>
            </li>
            @endcan
            @canany(['tuition_comment.index','tuition_comment.create'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-suitcase"></i> <span> Tuition Comments </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('tuition_comment.index')<li><a href="{{ route('tuition_comment.index') }}">Comments</a></li>@endcan
                        @can('tuition_comment.create') <li><a href="{{ route('tuition_comment.create') }}">Comments Create</a></li>@endcan
                    </ul>
                </li>
            @endcanany

            @canany(['subject.index','class.index','medium.index','timely.index','premium_package_items.index','premium_package.index','area.index','setting.index', 'tutor_faculty.index'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-gear"></i> <span> Configuration </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('sms_templates')<li><a href="{{ route('title_templates.index') }}">Title Template</a></li>@endcan
                        @can('sms_templates')<li><a href="{{ route('sms_templates.index') }}">SMS Template</a></li>@endcan
                        @can('notification_templates')<li><a href="{{ route('notification_templates.index') }}">Notification Template</a></li>@endcan
                        @can('tuition_condition_templates')<li><a href="{{ route('tuition_condition_templates.index') }}">Tuition Condition Template</a></li>@endcan
                        @can('tuition_category.index')<li><a href="{{ route('tuition_category.index') }}">Tuition Category</a></li>@endcan
                        @can('tutor_faculty.index')<li><a href="{{ route('tutor_faculty.index') }}">Tutor Faculty</a></li>@endcan
                        @can('tutor_institute_type.index')<li><a href="{{ route('tutor_institute_type.index') }}">Tutor Institue Type</a></li>@endcan
                        @can('subject.index')<li><a href="{{ route('subject.index') }}">Subject List</a></li>@endcan
                        @can('class.index') <li><a href="{{ route('class.index') }}">Class List</a></li>@endcan
                        @can('medium.index')<li><a href="{{ route('medium.index') }}">Medium List</a></li>@endcan
                        @can('weekly.index') <li><a href="{{ route('weekly.index') }}">Weekly List</a></li>  @endcan
                        @can('timely.index') <li><a href="{{ route('timely.index') }}">Time List</a></li>  @endcan
                        @can('premium_package_items.index')<li><a href="{{ route('premium_package_items.index') }}">Premium Package Items</a></li>@endcan
                        @can('premium_package.index') <li><a href="{{ route('premium_package.index') }}">Premium Package</a></li>@endcan
                        @can('area.index')<li><a href="{{ route('area.index') }}">Area</a></li>@endcan
                        @can('setting.index') <li><a href="{{ route('setting.index') }}">Setting</a></li>@endcan
                        @can('setting.index') <li><a href="{{ route('banner_image.index') }}">Home Page Banner Image</a></li>@endcan
                        @can('setting.index') <li><a href="{{ route('hire_banner_image.index') }}">Hire Page Banner Image</a></li>@endcan
                        @can('setting.index') <li><a href="{{ route('home_page_video.index') }}">Home Page Video Upload</a></li>@endcan
                    </ul>
                </li>
            @endcanany
            @canany(['admin_page.index','admin_page.create'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-file-text"></i> <span> Pages </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('admin_page.index') <li><a href="{{ route('admin_page.index') }}">Page List</a></li>@endcan
                        @can('admin_page.create') <li><a href="{{ route('admin_page.create') }}">Create Page</a></li>@endcan
                    </ul>
                </li>
            @endcanany

            <hr class="my-1 nav-divider">


            @can('contact.index') <li>
                <a href="{{ route('contact.index') }}">
                    <i class="fi-eye"></i> Contact
                </a>
            </li>
            @endcan

            @can('tuition_comment.index') <li>
                <a href="{{ route('subscriber_lists.index') }}">
                    <i class="fa fa-suitcase"></i> <span>Subscribers </span>
                </a>
            </li>
            @endcan




            @can('sms_templates')
            <li>
                <a href="{{ route('sms_templates.index') }}">
                    <i class="mdi mdi-message"></i> <span>SMS Templates </span>
                </a>
            </li>
            @endcan
            @can('sent_sms')
            <li>
                <a href="{{ route('sent_sms') }}">
                    <i class="mdi mdi-message"></i> <span>Sent SMS </span>
                </a>
            </li>
            @endcan
            <hr class="my-1 nav-divider">
            @canany(['logs'])
                <li>
                    <a href="{{ route('logs') }}"><i class="fa fa-history"></i>System Logs</a>
                </li>
            @endcanany

            <li>
                <a href="{{ route('index') }}" target="_blank">
                    <i class="fi-eye"></i> Live Website
                </a>
            </li>
        </ul>

    </div>
</div>
