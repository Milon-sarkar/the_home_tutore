<div class="col-lg-4">
    <div class="card-header bg-dark text-light h3">Tuition Basic Information (1)</div>
    <div class="card-box">
        <table class="table">
            <tr>
                <td><span class="text-danger">JOB ID</span></td>
                <td><span class="tex-danger">{{ $tuition->job_id }}</span></td>
            </tr>
            <tr>
                <td>Name/Title</td>
                <td>{{ $tuition->name ?? '' }}</td>
            </tr>
            <tr>
                <td>Division</td>
                <td><strong>{{ $tuition->division->name ?? '' }}</strong></td>
            </tr>
            <tr>
                <td>District</td>
                <td>{{ $tuition->district->name ?? '' }}</td>
            </tr>
            <tr>
                <td>Area Name</td>
                <td>{{ $tuition->area->name ?? '' }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $tuition->address ?? '' }}</td>
            </tr>
            <tr>
                <td>Duration (Hour)</td>
                <td>{{ $tuition->duration ?? '' }}</td>
            </tr>
            <tr>
                <td>Hiring From</td>
                <td>{{ $tuition->hiring_date ? $tuition->hiring_date : '' }}</td>
            </tr>
        </table>
    </div>
</div>
