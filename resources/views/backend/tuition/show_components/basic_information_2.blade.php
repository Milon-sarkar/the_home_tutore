<div class="col-lg-4">
    <div class="card-header bg-dark text-light h3">Tuition Basic Information (2)</div>
    <div class="card-box">
        <table class="table">
            <tr>
                <td>Gender</td>
                <td>
                    {{is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'Male' : '' }}
                    {{is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'Female' : '' }}
                </td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>{{ $tuition->phone }}</td>
            </tr>
            <tr>
                <td>Class</td>
                <td>
                    @foreach ($tclass as $tclas)
                        {{is_array($tuition->tclass) && in_array($tclas->id, $tuition->tclass) ? $tclas->name : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>
                    @foreach ($subjects as $subject)
                        {{is_array($tuition->subject_ids) && in_array($subject->id, $tuition->subject_ids) ? $subject->name : '' }}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Institution</td>
                <td>{{ $tuition->institution }}</td>
            </tr>
            <tr>
                <td>Medium</td>
                <td>
{{--                    @if(isset($medium))--}}
{{--                        {{is_array($tuition->student_medium) && in_array($medium->id, $tuition->student_medium) ? $medium->name : '' }}--}}
{{--                    @endif--}}
                    @foreach ($tuition->student_mediumjeson as $medium)
                            {{ $medium->name }}  @if( !$loop->last) ,@endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Number Of Student</td>
                <td>{{ $tuition->student_number }}</td>
            </tr>
        </table>

    </div>
</div>
