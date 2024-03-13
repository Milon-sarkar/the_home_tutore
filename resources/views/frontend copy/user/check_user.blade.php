@extends('frontend.layouts.app')
@section('content')
    <!-- user dashboard start -->
    <div class="dashboard_wrapper" id="myTab3" style="min-height: 500px">
        <div class="container">



      <button type="button" class="btn btn-link " data-toggle="modal" data-target="#myModal">
      </button>
      <div class="modal" id="myModal" style="margin-top: 50px">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Registration For</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('user_type') }}" method="POST">
                {{ csrf_field() }}
            <div class="modal-body">
             <select name="user_type" id="" class="form-control">
                <option value="student">Student</option>
                <option value="guardian">Guardian</option>
                <option value="tutor">Tutor</option>
             </select>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
          </div>
        </div>
      </div>
        </div>


      </div>
      </div>

    <!-- user dashboard end -->

        <script type="text/javascript">
            window.addEventListener("scroll", function(){
                var header = document.querySelector("nav");
                header.classList.toggle("sticky", window.scrollY > 0);
            })
        </script>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>
@endsection
