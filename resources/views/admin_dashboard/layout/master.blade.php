<!doctype html>
<html lang="en" class="semi-dark" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('admin_dashboard/assets/images/logo.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin_dashboard/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
    <link href="{{ asset('admin_dashboard/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin_dashboard/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/css/bootstrap-extended.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" integrity="sha512-xnP2tOaCJnzp2d2IqKFcxuOiVCbuessxM6wuiolT9eeEJCyy0Vhcwa4zQvdrZNVqlqaxXhHqsSV1Ww7T2jSCUQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- loader-->
    <link href="{{ asset('admin_dashboard/assets/css/pace.min.css')}}" rel="stylesheet" />
    <meta content="{{csrf_token()}}" name="csrf-token" />
    <!--Theme Styles-->
    <link href="{{ asset('admin_dashboard/assets/css/semi-dark.css')}}" rel="stylesheet" />
    <title> @yield('Page_Title')   |  كاركيتس ادمن </title>
    <style>
        .tox-notifications-container,.tox-statusbar__branding
        {
            display:none !important;
        }
    </style>
    @stack('styles')



</head>

<body>

<!--start wrapper-->
<div class="wrapper">

    @include('admin_dashboard.layout.header')

    @include('admin_dashboard.layout.aside')



    <!--start content-->
    <main class="page-content">


        @include('errors.validation_error')

        @yield('content')



    </main>
    <!--end page main-->


    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->



</div>
<!--end wrapper-->


<!-- Bootstrap bundle JS -->
<script src="{{ asset('admin_dashboard/assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{ asset('admin_dashboard/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('admin_dashboard/assets/js/pace.min.js')}}"></script>

<script src="{{ asset('admin_dashboard/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('admin_dashboard/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<!--app-->
<script src="{{ asset('admin_dashboard/assets/js/app.js')}}"></script>

@stack('scripts')

<script>
    //Add New Row
    $(document).on('click','#addNewRow', function(){
        var row = $(this).parent().parent().find('#tr').clone();
        $(row).find("input").val("");
        $(row).appendTo( $(this).parent().parent().find('#lines'));
    });

    //Remove Row
    $(document).on('click','.removeRow', function(){
        if($("#lines").children().length >1){
            $(this).parent().parent().remove();
        }
    });

    $(document).on('click','#addNewRowTwo', function(){
        var row = $(this).parent().parent().find('#trTwo').clone();
        $(row).find("input").val("");
        $(row).appendTo( $(this).parent().parent().find('#linesTwo'));
    });

    //Remove Row
    $(document).on('click','.removeRowTwo', function(){
        if($("#linesTwo").children().length >1){
            $(this).parent().parent().remove();
        }
    });

</script>
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>

    $(".ckeditor").each(function () {
        let id = $(this).attr('id');
        CKEDITOR.replace(id);
    });


    setTimeout(function(){
        $('.div_errors').hide();
        $('.div_success').hide();
    },5000);


    function quickChange(element ,id, model, col)
    {
        var val = $(element).val();
        $.ajax({
        url: "{{route('admin.quickChange')}}",
        type: 'post',
        data: {_token: '{{csrf_token()}}',id:id, model:model, val:val, col:col},
        success: function(response) {
        if(response.success)
        {
            if(val === '1')
            {
                $(element).attr('value', '0');
            }
            else
            {
                $(element).attr('value', '1');
            }
        }
        },
            error: function (reject) {

        },
    });
    }


    $(document).ready(function(){
        $("#filter").keyup(function(){

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val();
            // Loop through the comment list
            $("table tbody tr").each(function(){
                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).hide();
                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).show();
                }
            });
        });
    });


</script>

</body>

</html>
