<button class="uk-button uk-button-default" type="button" uk-toggle="target: #offcanvas-flip">Open</button>
<div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar">
        <button class="uk-offcanvas-close" type="button" uk-close></button>
        <ul class="list-inline">

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

            @canany(['subject.index','class.index','medium.index','timely.index','premium_package_items.index','premium_package.index','area.index','setting.index','tuition_category.index', 'tutor_faculty.index'])
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-gear"></i> <span> Configuration </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @can('tuition_category.index')<li><a href="{{ route('tuition_category.index') }}">Tuition Category</a></li>@endcan
                        @can('tutor_faculty.index')<li><a href="{{ route('tutor_faculty.index') }}">Tuition Category</a></li>@endcan
                        @can('subject.index')<li><a href="{{ route('subject.index') }}">Subject List</a></li>@endcan
                        @can('class.index') <li><a href="{{ route('class.index') }}">Class List</a></li>@endcan
                        @can('medium.index')<li><a href="{{ route('medium.index') }}">Medium List</a></li>@endcan
                        @can('timely.index') <li><a href="{{ route('timely.index') }}">Time List</a></li>  @endcan
                        @can('premium_package_items.index')<li><a href="{{ route('premium_package_items.index') }}">Premium Package Items</a></li>@endcan
                        @can('premium_package.index') <li><a href="{{ route('premium_package.index') }}">Premium Package</a></li>@endcan
                        @can('area.index')<li><a href="{{ route('area.index') }}">Area</a></li>@endcan
                        @can('setting.index') <li><a href="{{ route('setting.index') }}">Setting</a></li>@endcan
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



            @can('sent_sms') <li>
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
