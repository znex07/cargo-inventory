@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center ">

<div class="card" style="margin-top: 150px">
    <div class="card-body px-4 relative">
        <h1>Electronic Data Interface</h1>
        <form method="POST" action="view-search">
        @csrf
            <input type="text" name="cargo_code" id="country" placeholder="Enter cargo code" class="form-control my-4" autocomplete="off">
            <button class="btn btn-info  btn-block" name="btn-search" >View Status</button>
            <div id="country_list"></div>

        </form>
    </div>
</div>
</div>
<script type="text/javascript">
// $(document).ready(function () {

//     $('#country').on('keyup',function() {
//         var query = $(this).val();
//         $.ajax({

//             url:"{{ route('search') }}",

//             type:"GET",

//             data:{'cargo':query},

//             success:function (data) {
//                 console.log(data);
//                 $('#country_list').html(data);
//             }
//         })
//         // end of ajax call
//     });


//     $(document).on('click', 'li', function(){

//         var value = $(this).text();
//         $('#country').val(value);
//         $('#country_list').html("");
//     });
// });
</script>
@endsection

