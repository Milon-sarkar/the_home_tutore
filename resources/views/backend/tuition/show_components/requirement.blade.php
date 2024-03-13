<div class="col-md-4">
    <div class="card-header bg-dark text-light h3">Requirement/Interested Section</div>
    <div class="card-box">
        <table class="table">
            <tr>
                <td>Medium</td>
                <td>
                    @foreach ($mediums as $medium)
                        {{is_array($tuition->interest_medium) && in_array($medium->id, $tuition->interest_medium) ? $medium->name : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Class</td>
                <td>
                    @foreach ($tclass as $tclas)
                        {{is_array($tuition->interest_class) && in_array($tclas->id, $tuition->interest_class) ? $tclas->name : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Tutor Gender</td>
                <td>
                    {{ $tuition->interest_gender=='Male'? 'Male':'' }}
                    {{ $tuition->interest_gender=='Female'? 'Female':'' }}
                </td>
            </tr>
            <tr>
                <td>Salary</td>
                @if($tuition->salary_range)
                    <td>{{ $tuition->salary_range }}
                        ({{ $tuition->salary <= 0 ? 'Negotiable': $tuition->salary}})
                    </td>
                @else
                    <td>{{ $tuition->salary }}</td>
                @endif
            </tr>
            <tr>
                <td>Salary show/Hide</td>
                <td>
                    {{ $tuition->salary_show_hide=='1'? 'Show':'' }}
                    {{ $tuition->salary_show_hide=='0'? 'Hide':'' }}
                </td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>
                    @foreach ($subjects as $subject)
                        {{is_array($tuition->interest_sub) && in_array($subject->id, $tuition->interest_sub) ? $subject->name : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Time</td>
                <td>
                    @foreach ($timelys as $timely)
                        {{is_array($tuition->interest_time) && in_array($timely->id, $tuition->interest_time) ? $timely->name : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Weekly Days</td>
                <td>
                    @foreach ($weeklys as $weekly)
                        {{is_array($tuition->weekly) && in_array($weekly->id, $tuition->weekly) ? $weekly->name : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Institution</td>
                <td>{{ $tuition->interest_institution }}</td>
            </tr>
            <tr>
                <td>Class Type</td>
                <td>
                    {{ $tuition->class_type=='Offline'? 'Offline':'' }}
                    {{ $tuition->class_type=='Online'? 'Online':'' }}
                </td>
            </tr>
            <tr>
                <td>Class Type</td>
                <td>
                    {{ $tuition->class_type=='Offline'? 'Offline':'' }}
                    {{ $tuition->class_type=='Online'? 'Online':'' }}
                </td>
            </tr>
        </table>
    </div> <!-- end card-box -->
</div>
