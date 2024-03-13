@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                <h2 class="header-title">Urgent Contact List</h2>
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="contactTable">
                        <tr>
                            <th>ID</th>
                            <th>Date & Time</th>
                            <th>Contact Number</th>
                            <th>Select</th>
                        </tr>

                        @forelse($numbers->sortByDesc('id') as $number)
                        {{-- @dd($numbers); --}}
                            <tr>
                                <td>{{ $numbers->count() - $loop->index }}</td>
                                <td>{{ \Carbon\Carbon::parse($number->created_at)->format('d F Y h:i:s A') }}</td>
                                <td><a href="tel:{{ $number->phone }}">{{ $number->phone }}</a></td>

                                <td>
                                    <input type="checkbox" class="selectCheckbox" name="selected_numbers[]" 
                                        value="{{ $number->id }}" {{ in_array($number->id, $selectedNumbers) ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the selected contact IDs from local storage
            let count = 0
        
            var selectedContactIds = JSON.parse(localStorage.getItem('selectedContactIds')) || [];

            // Set the initial state of checkboxes based on local storage
            document.querySelectorAll('.selectCheckbox').forEach(function (checkbox) {
                var contactId = parseInt(checkbox.value);
                checkbox.checked = selectedContactIds.includes(contactId);
                count += 1

            });

            if(selectedContactIds.length){
                $('#hiretutorcount').text(count -selectedContactIds.length)

            }
           


  

            // Add event listener to checkboxes to update local storage
            document.getElementById('contactTable').addEventListener('change', function (event) {
                if (event.target.classList.contains('selectCheckbox')) {
                    var contactId = parseInt(event.target.value);
                    if (event.target.checked && !selectedContactIds.includes(contactId)) {
                        selectedContactIds.push(contactId);
                    } else if (!event.target.checked && selectedContactIds.includes(contactId)) {
                        selectedContactIds = selectedContactIds.filter(function (id) {
                            return id !== contactId;
                        });
                    }

                    // Update local storage with the latest selected contact IDs
                    localStorage.setItem('selectedContactIds', JSON.stringify(selectedContactIds));
                }
            });
        });
    </script>
    <script>
        $('#hiretutorcount').text(10)
    </script>

@endsection
