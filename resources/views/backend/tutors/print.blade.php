{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Curriculum Vitae - {{ $tutor->user->name ?? '' }}</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #ffffff;
            z-index: 1000;
        }

        .cv-container {
            background-color: #ffffff;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .cv-title {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .cv-image {
            width: 200px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .table td, .table th {
            padding: 1rem;
        }

        .cv-card {
            margin-top: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <header class="d-flex justify-content-center w-100">
        <div style="width: 100%">
            <h1 class="text-center"><strong>Curriculum Vitae</strong></h1>
        </div>
    </header>

    <div class="container cv-container">
        <div class="card cv-card">
            <div class="card-body">
                <div class="row cv-title">
                    <div class="col-md-12 text-center">
                        <h2><strong>Tutor Code: {{ $tutor->tutor_code ?? '' }}</strong></h2>
                        <h4>Name: {{ $tutor->user->name ?? '' }}</h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if ($tutor->user->avatar)
                            <img src="{{ $tutor->user->avatar }}" class="cv-image" id="wizardPicturePreview" title="Profile Image">
                        @endif
                    </div>

                    <div class="col-md-8">
                        <table class="table">
                            <!-- Tutor Information -->
                            <tr>
                                <th>Tutor ID</th>
                                <td>:</td>
                                <td>{{ $tutor->tutor_code ?? '' }}</td>
                                <td rowspan="4">
                                    <span class="d-flex justify-content-end">
                                        @if ($tutor->user->avatar)
                                            <img src="{{ $tutor->user->avatar }}" class="picture-src" id="wizardPicturePreview" title="" style="width: 200px">
                                        @endif
                                    </span>
                                </td>
                            </tr>
            <tr>
                <th>Confirmed Name</th>
                <td>:</td>
                <td>{{ $tutor->user->name ?? '' }}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>:</td>
                <td>{{ $tutor->gender ?? '' }}</td>
            </tr>
            <tr>
                <th>Home District</th>
                <td>:</td>
                <td> {{ $tutor->permanent_district->name ?? '' }}</td>
            </tr>
            <tr>
                <th>Present District</th>
                <td>:</td>
                <td> {{ $tutor->district->name ?? '' }}</td>
            </tr>
            <tr>
                <th>Present Thana</th>
                <td>:</td>
                <td>  {{ $tutor->thana->name ?? '' }}</td>
            </tr>
            <tr class="mb-3">
                <th>Present Area</th>
                <td>:</td>
                <td> {{ $tutor->area->name ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="3" style="border: none"></td>
            </tr>
            <tr>
                <th>Institute/University</th>
                <td>:</td>
                <td>{{ $tutor->institution }}</td>
            </tr>
            <tr>
                <th>Faculty</th>
                <td>:</td>
                <td>{{ $tutor->faculty }}</td>
            </tr>
            <tr>
                <th>Subject/Department</th>
                <td>:</td>
                <td> {{ $tutor->subject_name }}</td>
            </tr>
            <tr>
                <th>Session</th>
                <td>:</td>
                <td> {{ $tutor->session }}</td>
            </tr>
            <tr>
                <td colspan="3" style="border: none"></td>
            </tr>
            <tr>
                <th>HSC Institute</th>
                <td>:</td>
                <td> {{ $tutor->hsc_institute }}</td>
            </tr>
            <tr>
                <th>HSC Group</th>
                <td>:</td>
                <td> {{ $tutor->hsc_group }}</td>
            </tr>
            <tr>
                <th>HSC Medium</th>
                <td>:</td>
                <td> {{ $tutor->hsc_medium }}</td>
            </tr>
            <tr>
                <th>HSC Result</th>
                <td>:</td>
                <td>  {{ $tutor->hsc_result }}</td>
            </tr>

            <tr>
                <td colspan="3" style="border: none"></td>
            </tr>
            <tr>
                <th>SSC Institute</th>
                <td>:</td>
                <td> {{ $tutor->ssc_institute }}</td>
            </tr>
            <tr>
                <th>SSC Group</th>
                <td>:</td>
                <td>{{ $tutor->ssc_group }}</td>
            </tr>
            <tr>
                <th>SSC Medium</th>
                <td>:</td>
                <td>{{ $tutor->ssc_medium }}</td>
            </tr>
            <tr>
                <th>SSC Result</th>
                <td>:</td>
                <td>{{ $tutor->ssc_result }}</td>
            </tr>
        </table>
        @if ($urgency)
            <div class="row mt-5">
                <div class="col-md-12 text-start">
                    <p><strong>Tutor Qualification for this Tuition</strong></p>
                    {!! $urgency !!}
                </div>
            </div>
        @endif
        <div class="row mt-5">
            <div class="col-md-12 text-start">
                <p><strong>Tuition Experience</strong></p>
                {{ $tutor->details }}
            </div>
        </div>



    </div>



</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>
    window.print();
</script>
</body>
</html> --}}

{{-- <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <title>Curriculum Vitae - {{ $tutor->user->name ?? '' }}</title>
     <style>
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #fff;
            z-index: 1000;
        }

        @media print {
            @page {
                margin-top: 80px;
                margin-bottom: 0;
            }
            body {
                padding-top: 72px;
                padding-bottom: 72px;
            }
            header {
                display: none;
            }
        }

        .table td, .table th {
            padding: 0.5rem;
        }
    </style>
 </head>
 <body>
     <div class="card" style="border: none !important;">
         <div class="card-body" style="border: none !important;">
             <header class="d-flex justify-content-center w-100" style="padding-top: 50px !important; padding-bottom: 50px !important;">
                 <div style="width: 100%">
                     <h1 class="text-center"><strong>Curriculum Vitae</strong></h1>
                 </div>
             </header>
             <table class="table" style="margin-top: 100px">
                 <!-- Tutor Information -->
                 <tr>
                     <th>Tutor ID</th>
                     <td>:</td>
                     <td>{{ $tutor->tutor_code ?? '' }}</td>
                     <td rowspan="4">
                         <span class="d-flex justify-content-end">
                             @if ($tutor->user->avatar)
                                 <img src="{{ $tutor->user->avatar }}" class="picture-src" id="wizardPicturePreview" title="" style="width: 200px">
                             @endif
                         </span>
                     </td>
                 </tr>
                 <tr>
                     <th>Confirmed Name</th>
                     <td>:</td>
                     <td>{{ $tutor->user->name ?? '' }}</td>
                 </tr>
                 <tr>
                     <th>Gender</th>
                     <td>:</td>
                     <td>{{ $tutor->gender ?? '' }}</td>
                 </tr>
                 <!-- Add more rows for other tutor information -->
 
                 <!-- Education Information -->
                 <tr>
                     <td colspan="3" style="border: none"></td>
                 </tr>
                 <tr>
                     <th>Institute/University</th>
                     <td>:</td>
                     <td>{{ $tutor->institution }}</td>
                 </tr>
                 <!-- Add more rows for other education information -->
 
                 <!-- HSC Information -->
                 <tr>
                     <td colspan="3" style="border: none"></td>
                 </tr>
                 <tr>
                     <th>HSC Institute</th>
                     <td>:</td>
                     <td>{{ $tutor->hsc_institute }}</td>
                 </tr>
                 <!-- Add more rows for other HSC information -->
 
                 <!-- SSC Information -->
                 <tr>
                     <td colspan="3" style="border: none"></td>
                 </tr>
                 <tr>
                     <th>SSC Institute</th>
                     <td>:</td>
                     <td>{{ $tutor->ssc_institute }}</td>
                 </tr>
                 <!-- Add more rows for other SSC information -->
             </table>
 
             <!-- Additional Information -->
             @if ($urgency)
                 <div class="row mt-5">
                     <div class="col-md-12 text-start">
                         <p><strong>Tutor Qualification for this Tuition</strong></p>
                         {!! $urgency !!}
                     </div>
                 </div>
             @endif
 
             <!-- Tuition Experience -->
             <div class="row mt-5">
                 <div class="col-md-12 text-start">
                     <p><strong>Tuition Experience</strong></p>
                     {{ $tutor->details }}
                 </div>
             </div>
         </div>
     </div>
 
     <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
     <!-- Print the document -->
     <script>
         window.print();
     </script>
 </body>
 </html>
  --}}


  <!DOCTYPE html>
  <html lang="en">
  
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <title>Curriculum Vitae - {{ $tutor->user->name ?? '' }}</title>
      <style>
          body {
              background-color: #f8f9fa;
          }
  
          .cv-container {
              background-color: #ffffff;
              margin: 20px;
              border-radius: 10px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              padding: 20px;
          }
  
          .cv-title {
              padding-top: 30px;
              padding-bottom: 30px;
              text-align: center;
              color: #e2136e;
              /* Updated color */
          }
  
          .cv-image {
              width: 200px;
              height: 200px;
              border-radius: 50%;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          }
  
          .basic-info,
          .education-info,
          .location,
          .educational-result,
          .additional-info,
          .tuition-experience {
              padding: 20px;
          }
  
          .section-title {
              border-bottom: 2px solid #e2136e;
              /* Updated color */
              padding-bottom: 10px;
              margin-bottom: 20px;
          }
  
          .qualification-list {
              list-style-type: none;
              padding: 0;
          }
      </style>
  </head>
  
  <body>
      <div class="container cv-container justy-content-center">
          <div class="row cv-title">
              <div class="col-md-12">
                  <h1><strong>Curriculum Vitae</strong></h1>
              </div>
          </div>
  
          <div class="row">
              <div class="col-md-4 col-sm-4 text-center">
                  <img src="{{ $tutor->user->avatar }}" class="cv-image" id="wizardPicturePreview" title="Profile Image">
              </div>
              <div class="col-md-8 col-sm-4">
                  <table class="table">
                      <tr>
                          <th>Tutor ID</th>
                          <td>:</td>
                          <td>{{ $tutor->tutor_code ?? '' }}</td>
                      </tr>
                      <tr>
                          <th>Confirmed Name</th>
                          <td>:</td>
                          <td>{{ $tutor->user->name ?? '' }}</td>
                      </tr>
                  </table>
              </div>
          </div>
  
          <div class="row">
              <div class="col-md-4 col-sm-4 basic-info">
                  <h3 class="section-title">Basic Information</h3>
                  <p><strong>Name:</strong> {{ $tutor->user->name ?? '' }}</p>
                  <p><strong>Gender:</strong> {{ $tutor->gender ?? '' }}</p>
                  <p><strong>Home District:</strong> {{ $tutor->permanent_district->name ?? '' }}</p>
              </div>
              <div class="col-md-8 education-info">
                  <h3 class="section-title">Education Information</h3>
                  <p><strong>SSC Institute:</strong> {{ $tutor->ssc_institute }}</p>
                  <p><strong>HSC Institute:</strong> {{ $tutor->hsc_institute }}</p>
                  <p><strong>Institution/University:</strong> {{ $tutor->institution }}</p>
              </div>
          </div>
  
          <div class="row">
              <div class="col-md-4 col-sm-4 location">
                  <h3 class="section-title">Location</h3>
                  <p><strong>Home District:</strong> {{ $tutor->permanent_district->name ?? '' }}</p>
                  <p><strong>Present District:</strong> {{ $tutor->district->name ?? '' }}</p>
                  <p><strong>Present Thana:</strong> {{ $tutor->thana->name ?? '' }}</p>
              </div>
              <div class="col-md-8 educational-result">
                  <h3 class="section-title">Educational Result</h3>
                  <p><strong>HSC Result:</strong> {{ $tutor->hsc_result }}</p>
                  <p><strong>SSC Result:</strong> {{ $tutor->ssc_result }}</p>
              </div>
          </div>
  
          <!-- Additional Information -->
          {{-- @if ($urgency)
              <div class="row mt-5 additional-info">
                  <div class="col-md-12 col-sm-4 text-start">
                      <h3 class="section-title">Tutor Qualification for this Tuition</h3>
                      {!! $urgency !!}
                  </div>
              </div>
          @endif --}}
  
          <!-- Tuition Experience -->
          <div class="row mt-5 tuition-experience">
              <div class="col-md-12  col-sm-4text-start">
                  <h3 class="section-title">Tuition Experience</h3>
                  {{ $tutor->details }}
              </div>
          </div>
      </div>
  
      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
          integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
          crossorigin=""></script>
  
      <script>
          window.print();
      </script>
  </body>
  
  </html>
  