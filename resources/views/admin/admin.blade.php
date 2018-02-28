@extends('layouts.adminlayout')
@push('css')
<style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
@endpush
@section('content')
@inject('controller', 'App\Http\Controllers\AdminController')
   <!-- Page Content -->
   <div id="page-wrapper">
   <div class="container-fluid">
       <div class="row bg-title">
           <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
               <h4 class="page-title">Dashboard</h4>
           </div>
           <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
               
               <ol class="breadcrumb">
                   <li><a href="#">Dashboard</a></li>
                   <li class="active">Statistics</li>
               </ol>
           </div>
           <!-- /.col-lg-12 -->
       </div>
       <!-- /.row -->
       <div class="row">
           <div class="col-md-12 col-lg-12 col-sm-12">
               <div class="white-box">
                   <div class="row row-in">
                       <div class="col-lg-3 col-sm-6 row-in-br">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="mi-account-box"></i>
                                   <h5 class="text-muted vb">TOTAL CLIENTS</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-danger">{{ $controller->totalUsers()  }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $controller->totalUsers()  }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->totalUsers()  }}%"> </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                                   <h5 class="text-muted vb">DAILY PROJECTS</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-megna">{{ $controller->newProjects() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="{{ $controller->newProjects() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->newProjects() }}%">  </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3 col-sm-6 row-in-br">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                   <h5 class="text-muted vb">All  Projects</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-primary">{{ $controller->totalProjects() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ $controller->totalProjects() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->totalProjects() }}%"> </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3 col-sm-6  b-0">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                                   <h5 class="text-muted vb">Reports</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3  class="counter text-right m-t-15 text-success">{{ $controller->totalReports() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $controller->totalReports() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->totalReports() }}%">  </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!--row -->
       <!-- /.row -->
       <div class="row">
           <div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">
               <div class="white-box">
                   <h3 class="box-title">Monthly Commision</h3>
                   <h4 class="float-right">Total: <span>&#8369;</span> {{ number_format($controller->totalCommision(),2) }}</h4>
                  <!--  <ul class="list-inline text-right">
                       <li>
                           <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>iPhone</h5>
                       </li>
                       <li>
                           <h5><i class="fa fa-circle m-r-5" style="color: #fb9678;"></i>iPad</h5>
                       </li>
                       <li>
                           <h5><i class="fa fa-circle m-r-5" style="color: #9675ce;"></i>iPod</h5>
                       </li>
                   </ul> -->
                   <!-- <div id="morris-area-chart" style="height: 340px;"></div> -->
                   <div style="width:100%;">
                        <canvas id="canvas"></canvas>
                   </div>
               </div>
           </div>
           <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
               <div class="row">
                   <div class="col-md-12">
                       <div class="bg-theme-dark m-b-15">
                           <div class="row weather p-20">
                               <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
                                   <h3>&nbsp;</h3>
                                   <h1>31<sup>°C</sup></h1>
                                   <p class="text-white">Cebu City, Philippines</p>
                               </div>
                               <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="wi wi-day-cloudy-high"></i>
                                   <br/>
                                   <br/>
                                   <b class="text-white">Partly Sunny</b>
                                   <p class="w-title-sub">March 1</p>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-12">
                       <div class="bg-theme m-b-15">
                           <div id="myCarouse2" class="carousel vcarousel slide p-20">
                               <!-- Carousel items -->
                               <div class="carousel-inner ">
                                   <div class="active item">
                                       <h3 class="text-white">Technology is best when it brings <span class="font-bold">people</span> together</h3>
                                       <div class="twi-user"><img src="{{ asset('img/matt.jpg') }}" alt="user" class="img-circle img-responsive pull-left">
                                           <h4 class="text-white m-b-0">Matt Mullenweg</h4>
                                           <p class="text-white">Developer of WordPress </p>
                                       </div>
                                   </div>
                                   <div class="item">
                                       <h3 class="text-white">An <span class="font-bold">Entrepreneur </span>is someone who jumps off a cliff, and builds a plane on his way down.</h3>
                                       <div class="twi-user"><img src="{{ asset('img/reid.png') }}" alt="user" class="img-circle img-responsive pull-left">
                                           <h4 class="text-white m-b-0">Reid Hoffman</h4>
                                           <p class="text-white">Executive Chairman, LinkedIn</p>
                                       </div>
                                   </div>
                                   <div class="item">
                                       <h3 class="text-white">The ones who are <span class="font-bold">crazy</span> enough to think that they can change the world, are the ones who do.</h3>
                                       <div class="twi-user"><img src="{{ asset('img/steve.jpg') }}" alt="user" class="img-circle img-responsive pull-left">
                                           <h4 class="text-white m-b-0">Steve Jobs</h4>
                                           <p class="text-white">CEO, Apple</p>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!--row -->
       
    
      
   <!-- /.container-fluid -->
 <!-- <footer class="footer text-center"> 2017 &copy; bidpro brought to you by CodeX </footer> -->
</div>
<!-- /#page-wrapper -->

@push('scripts')
<script src="{{ asset('js/charts/chart.js') }}"></script>
<script src="{{ asset('js/charts/utils.js') }}"></script>
<script>
        $(function(){
            $.ajax({
                type:"get",
                url: "{{ route('user.report.list') }}",
                dataType: "json",
                cache:false,
                success:function(response){
                  swal({
                      title:"Today's Report",
                      text: "Total Reports: "+response.length,
                      icon: "warning",
                      timer:2000
                  });
                }
            });
        });
    </script>
<script>
    $(function(){
        $.ajax({
            type: "get",
            url: "{{ route('admin.commission') }}",
            dataType: "json",
            cache:false,
            success:function(response){
                var data = [];
                for(var i = 0; i < response.length; i++){
                    data.push(response[i].monthly_commission);
                }
                var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
                datasets: [{
                    label: "Commision",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: data,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    // text:'Min and Max Settings'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 1000,
                            max: 10000
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
        };
            }
        });
    });
</script>
<!-- <script>
 var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
                datasets: [{
                    label: "Commision per month",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [10000, 30000, 50000, 20000, 25000, 44440, 35000,25000,14800,32010,17000,-10000],
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    // text:'Min and Max Settings'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 10000,
                            max: 50000
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
        };
</script> -->
@endpush
@endsection