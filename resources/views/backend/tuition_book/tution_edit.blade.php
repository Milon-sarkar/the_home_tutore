@extends('backend.layouts.app')
{{-- @dd($tuition); --}}
@section('content')
    <form action="{{ route('tuition_book.application_update', $tuition->id) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Basic Section</h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Class Dropdown -->
                            
                            <div class="form-group">
                                <label for="class">Class<span class="text-danger"></span></label>
                                <select id="class" name="tclass" class="form-control" required>
                                        @foreach($tclassOptions as  $key => $tclassOption)
        
                                        <option value="{{ $tclassOption->id }}" {{ count($tuition->classjeson) && $tclassOption->id == $tuition->classjeson[0]->id ? 'selected' : '' }}>
                                                {{ $tclassOption->name }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Medium Input -->
                            <div class="form-group">
                                <label for="medium">Medium<span class="text-danger"></span></label>
                                <input id="medium" type="text" value="{{ count($tuition->student_mediumjeson)? $tuition->student_mediumjeson[0]->name :'' }}"
                                    placeholder="Medium" name="medium" required class="form-control">
                            </div>
                            <!-- Subject Input -->
                            <div class="form-group">
                                <label for="subject">Subject<span class="text-danger"></span></label>
                                <select id="subject" name="subject_ids[]" class="form-control" multiple required>
                                    @foreach ($subjectOptions as $subjectOption)
                                        <option value="{{ $subjectOption->id }}"
                                            {{ in_array($subjectOption->id, $tuition->subject_ids) ? 'selected' : '' }}>
                                            {{ $subjectOption->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Gender Input -->
                            <div class="form-group">
                                <label for="gender">Gender<span class="text-danger"></span></label>
                                <input id="gender" type="text" value="{{ count($tuition->gender) ? $tuition->gender[0] :'' }}"
                                    placeholder="Gender" name="gender" required class="form-control">
                            </div>

                            <!-- PW Class Input -->
                            <div class="form-group">
                                <label for="pw_class">PW Class<span class="text-danger"></span></label>
                                <input id="pw_class" type="text" value="{{ count($tuition->weekly)?$tuition->weekly[0] :'' }}" placeholder="PW Class"
                                    name="weekly" required class="form-control">
                            </div>

                            <!-- Salary Input -->
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input id="salary" type="text" value="{{ $tuition->	salary_range }}" placeholder="Salary"
                                    name="	salary_range" required class="form-control">
                            </div>

                            <!-- Location Input -->
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input id="location" type="text" value="{{ $tuition->area->name }}"
                                    placeholder="Location" name="location" required class="form-control">
                            </div>

                            <!-- Offline/Online Dropdown -->
                            <div class="form-group">
                                <label for="class_type">Offline/Online</label>
                                <select class="form-control select2" name="class_type" id="class_type">
                                    <option value="{{ $tuition->class_type }}" selected>{{ $tuition->class_type }}
                                    </option>
                                    {{-- Add options dynamically if needed --}}
                                </select>
                            </div>

                            <!-- No. of Students Input -->
                            <div class="form-group">
                                <label for="student_number">No. of Students</label>
                                <input id="student_number" type="text" value="{{ count($tuition->subject_ids) ? $tuition->subject_ids[0]:''  }}"
                                    placeholder="No. of Students" name="subject_ids" required class="form-control">
                            </div>

                            <!-- Duration Input -->
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input id="duration" type="text" value="{{ $tuition->duration }}"
                                    placeholder="Duration" name="duration" required class="form-control">
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->

            <!-- Buttons -->
            <div class="form-group row">
                <div class="col-8 offset-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        Save
                    </button>
                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
