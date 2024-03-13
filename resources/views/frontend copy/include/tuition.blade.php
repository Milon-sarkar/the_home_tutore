<div class="col-md-6 mb-4">
    <div class="post_card p-0">
        <div class="p-4 pb-2 bg-secondary">
            <div class="post_card_header">
                <div class="class_title">
                    <h4 class="text-light text-capitalize">{{ $tuition->name ?? '' }}</h4>
                    <span class="text-light">{{ $tuition->created_at->diffForHumans() }}</span>
                </div>
                <div class="job_id d-flex flex-column align-items-center">
                    <p class="text-nowrap text-light m-0">JOB ID: {{ $tuition->job_id ?? '' }}</p>
                    @if($tuition->class_type == 'Online')
                        <p class="d-block m-0" style="color: #01d31f"><i class="fas fa-dot-circle"></i> Online</p>
                    @else
                        <p class="d-block m-0" style="color: #f77f00"><i class="fas fa-dot-circle"></i> Offline</p>
                    @endif
                </div>
            </div>
            <div class="post_meta row pl-0">
                <div class="location text-light col-8 ps-0">
                    <i class="fa-solid fa-location-dot"></i><span>{{ $tuition->area->name ?? '' }},
                                        {{ $tuition->district->name ?? '' }}</span>
                </div>
                <div class="date col-4 text-right">
                    <span class="text-light">{{ date('M-d-Y',strtotime($tuition->hiring_date)) }}</span>
                </div>

            </div>


        </div>

        <div class="post_card_content p-4 pt-2">
            <div class="row">
                <div class="col-lg-6">
                    <div class="content_item">
                        <div class="icon"><i class="fa-solid fa-book-open-reader"></i></div>
                        <h3 class="item_data text-muted">Class : <strong class="text-dark">@forelse ($tuition->classjeson as $tclass)
                                    {{ $tclass->name }}@if( !$loop->last) ,@endif
                                @empty
                                @endforelse</strong>
                        </h3>
                    </div>


                    <div class="content_item">
                        <div class="icon"><i class="fa-solid fa-code-branch"></i></div>
                        <h3 class="item_data text-muted">Medium :<strong class="text-dark">@forelse ($tuition->student_mediumjeson as $medium)
                                    {{ $medium->name }}  @if( !$loop->last) ,@endif
                                @empty
                                @endforelse</strong> </h3>
                    </div>
                    <div class="content_item">
                        <div class="icon"><i class="fa fa-mars"></i></div>
                        <h3 class="item_data text-muted">Gender : <strong class="text-dark">{{is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'Male' : '' }}  {{is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'Female' : '' }}</strong> </h3>
                    </div>
                    <div class="content_item">
                        <div class="icon"><i class="fa-regular fa-user"></i></div>
                        <h3 class="item_data text-muted">Number of Student :<span> {{ $tuition->student_number }}</span> </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content_item">
                        <div class="icon"><i class="fa-solid fa-book"></i></div>
                        <h3 class="item_data text-muted">Subjects : <strong class="text-dark">@forelse ($tuition->subject_idsjeson as $subject)
                                    {{ $subject->name }}@if( !$loop->last) ,@endif
                                @empty
                                @endforelse</strong> </h3>
                    </div>
                    <div class="content_item">
                        <div class="icon"><i class="fa-regular fa-clock"></i></div>
                        <h3 class="item_data text-muted">Per Week : <strong class="text-dark">@forelse ($tuition->weekjeson as $week)
                                    {{ $week->name }}  @if( !$loop->last) ,@endif
                                @empty
                                @endforelse</strong> </h3>
                    </div>
                    <div class="content_item">
                        <div class="icon"><i class="fa-regular fa-clock"></i></div>
                        <h3 class="item_data text-muted">Duration (h) :
{{--                                @forelse ($tuition->timejeson as $time)--}}
{{--                                    {{ $time->name }}  @if( !$loop->last) ,@endif--}}
{{--                                @empty--}}
{{--                                @endforelse</strong>--}}
                            <strong class="text-dark">{{ $tuition->duration }}</strong>
                        </h3>
                    </div>
                    <div class="content_item">
                        <div class="icon"><i class="fa-solid fa-dollar-sign"></i></div>
                        <h3 class="item_data text-muted">Salary :
                            <strong class="text-dark">
                                    @if ($tuition->salary_show_hide=='1')
                                        @if($tuition->salary_range != '')
                                            {{ $tuition->salary_range }} ৳
                                        @elseif($tuition->salary > 0.00)
                                            {{ $tuition->salary }}  ৳
                                        @else
                                            Negotiable
                                        @endif
                                    @endif
                            </strong>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="button">
            @if($tuition->is_blocked_application == 'lock')
                <a href="#" class="not_available_btn">Not Available</a>
            @else
                <a href="{{ route('tuition_details',$tuition->job_id) }}?id={{ $tuition->id }}" class="view_btn">View Details</a>
            @endif
        </div>
    </div>
</div>
