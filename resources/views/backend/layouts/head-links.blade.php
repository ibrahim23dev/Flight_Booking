<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title','Admin panel') </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
     <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/files/bower_components/bootstrap/css/bootstrap.min.css">
        <!-- jquery file upload Frame work -->
        <link href="{{asset('assets/backend')}}\files\assets\pages\jquery.filer\css\jquery.filer.css" type="text/css" rel="stylesheet">
        <link href="{{asset('assets/backend')}}\files\assets\pages\jquery.filer\css\themes\jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet">
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\bower_components\font-awesome\css\font-awesome.min.css">
            <!-- light gallery css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\bower_components\lightgallery\css\lightgallery.min.css">
            <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\assets\pages\advance-elements\css\bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\bower_components\bootstrap-daterangepicker\css\daterangepicker.css">
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\bower_components\datedropper\css\datedropper.min.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\assets\icon\feather\css\feather.css">
    
    <!-- Style.css -->
        <!-- themify-icons line icon -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\assets\icon\themify-icons\themify-icons.css">
        <!-- ico font -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\assets\icon\icofont\css\icofont.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}\files\assets\css\jquery.mCustomScrollbar.css">
    <!-- Required Jquery -->
<script type="text/javascript" src="{{asset('assets/backend')}}\files\bower_components\jquery\js\jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
    .new-message-notification {
    background-color: #ff0000; /* Example background color */
    color: #ffffff; /* Example text color */
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    margin-left: 10px; /* Adjust the margin as needed */
}

.visible {
    display: inline;
}

.hidden {
    display: none;
}
.delete_conversation {
    opacity: 0;
    transition: opacity 0.3s;
  }
  .userlist-box:hover .delete_conversation {
    opacity: 1;
  }

  /*------------ CHECKBOX -------------*/

.toggle-switch {
  margin: 0 auto;
  /* width: 241px; */
  margin-top: 20px;
  position: relative;
}
.toggle-switch label {
  padding: 0;
}
.toggle-switch label:hover {
 cursor: pointer;
}
.toggle-switch input[type=checkbox] {
  display: none;
}
.toggle-switch label input + span {
    position: relative;
    display: inline-block;
    margin-right: 10px;
    width: 3rem;
    height: 1.5rem;
    background: #eb3422;
    border: 1px solid #eee;
    border-radius: 50px;
    transition: all 0.3s ease-in-out;
    box-shadow: inset 0 0 5px #eb3422;
}
.toggle-switch label input + span small {
    position: absolute;
    display: block;
    width: 1rem;
    height: 1rem;
    border-radius: 1.875rem;
    background: #fff;
    transition: all 0.3s ease-in-out;
    top: 0.2rem;
    left: 0.2rem;
}
.toggle-switch label input:checked + span {
  background-color: #0ac282;
}
.toggle-switch label input:checked + span small{
    left: 1.6rem;
    transition: left .25s;
}

.spinner-border {
            display: inline-block;
            width: 1.25rem;
            height: 1.25rem;
            vertical-align: text-bottom;
            border: 0.2em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }
    
        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }
        #toast_main,
        #toast_ajax {
            position: fixed;
            top: 0;
            right: 0;
            padding: 10px;
            z-index: 999999;
            border-radius: 10px;
            width: 15rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
       
         .close-icon-toast{
            position: absolute;
            right: 1rem;
            top: 0.5rem;
            cursor: pointer;
        }
        .hide{
            display: none;
        }
        .ck-editor{
      width: 100% !important;
    }
    
</style>

</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>




    