@extends('backend.layouts.main')
@section('main-container')

<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body chat-bg ">
            <div class="page-wrapper">
                <div id="main-chat" class="container-fluid">

                    <!-- Page-header start -->
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <div class="d-inline">
                                        <h4>Chat System </h4>
                                        <span>You can do chat here</span>
                                    </div>
                                </div>

                                @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Pages</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Sample page</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-header end -->


                    <div class="page-body">
                        <div class="row">
                            <div class="chat-box">
                                <ul class="text-right boxs" id="chat_boxes">
                                        {{-- chat boxes will append gere by ajax  --}}
                                </ul>
                                
                                <div id="sidebar" class="users p-chat-user">
                                    <div class="had-container">
                                        <div class="card card_main p-fixed users-main ">
                                            
                                            <div class="card-block">
                                                <div class="right-icon-control">
                                                    <input type="text" class="form-control  search-text" placeholder="Search User">
                                                    <div class="form-icon">
                                                        <i class="icofont icofont-search"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <div class="right-icon-control">
                                                    <select name="user_id" id="" class="form-control">
                                                        <option value="">Select User </option>
                                                        @foreach (getOtherUsers() as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                            
                                                </div>
                                            </div>

                                            <div class="user-box">

                                                
                                                    {{-- conversaions will go here  --}}
                                         
                       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="page-error">
                        <div class="card text-center">
                            <div class="card-block">
                                <div class="m-t-10">
                                    <i class="icofont icofont-warning text-white bg-c-yellow"></i>
                                    <h4 class="f-w-600 m-t-25">Not supported</h4>
                                    <p class="text-muted m-b-0">Chat not supported in this device</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div id="styleSelector">
        </div> --}}
    </div>
</div>


@endsection
