@extends('layouts.adminlayout')
@section('content')
 <!-- Page Content -->
 <div id="page-wrapper">
 <div class="container-fluid">
     <div class="row bg-title">
         <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
             <h4 class="page-title">Dashboard</h4> </div>
         <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
             <ol class="breadcrumb">
                 <li><a href="#">Dashboard</a></li>
                 <li class="active">Home</li>
             </ol>
         </div>
         <!-- /.col-lg-12 -->
     </div>
     <!-- .row -->
     <div class="row">
         <div class="col-lg-3 col-sm-6 col-xs-12">
             <div class="white-box analytics-info">
                 <h3 class="box-title">Total Visit</h3>
                 <ul class="list-inline two-part">
                     <li>
                         <div id="sparklinedash"></div>
                     </li>
                     <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">8659</span></li>
                 </ul>
             </div>
         </div>
         <div class="col-lg-3 col-sm-6 col-xs-12">
             <div class="white-box analytics-info">
                 <h3 class="box-title">Total Page Views</h3>
                 <ul class="list-inline two-part">
                     <li>
                         <div id="sparklinedash2"></div>
                     </li>
                     <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">7469</span></li>
                 </ul>
             </div>
         </div>
         <div class="col-lg-3 col-sm-6 col-xs-12">
             <div class="white-box analytics-info">
                 <h3 class="box-title">Unique Visitor</h3>
                 <ul class="list-inline two-part">
                     <li>
                         <div id="sparklinedash3"></div>
                     </li>
                     <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">6011</span></li>
                 </ul>
             </div>
         </div>
         <div class="col-lg-3 col-sm-6 col-xs-12">
             <div class="white-box analytics-info">
                 <h3 class="box-title">Bounce Rate</h3>
                 <ul class="list-inline two-part">
                     <li>
                         <div id="sparklinedash4"></div>
                     </li>
                     <li class="text-right"><i class="ti-arrow-down text-danger"></i> <span class="text-danger">18%</span></li>
                 </ul>
             </div>
         </div>
     </div>
     <!--/.row -->
    <div class="row">
         <div class="col-lg-6 col-sm-12 col-xs-12">
             
             <div class="row">
                 <div class="col-lg-6 col-sm-6 col-xs-12">
                     <div class="white-box">
                         <h3 class="box-title">Developers</h3>
                         <ul class="list-inline two-part">
                             <li><i class="icon-people text-info"></i></li>
                             <li class="text-right"><span class="counter">23</span></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-xs-12">
                     <div class="white-box">
                         <h3 class="box-title">SEEKERS</h3>
                         <ul class="list-inline two-part">
                             <li><i class="icon-people text-warning"></i></li>
                             <li class="text-right"><span class="counter">169</span></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-xs-12">
                     <div class="white-box">
                         <h3 class="box-title">POSTS</h3>
                         <ul class="list-inline two-part">
                             <li><i class="icon-folder-alt text-danger"></i></li>
                             <li class="text-right"><span class="counter">311</span></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-6 col-sm-6 col-xs-12">
                     <div class="white-box">
                         <h3 class="box-title">NEW Invoices</h3>
                         <ul class="list-inline two-part">
                             <li><i class="ti-wallet text-success"></i></li>
                             <li class="text-right"><span class="counter">117</span></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-6 col-sm-12 col-xs-12">
             
             <div class="news-slide m-b-15">
                 <div class="vcarousel slide">
                     <!-- Carousel items -->
                     <div class="carousel-inner">
                         <div class="active item">
                             <div class="overlaybg"><img src="/img/news/slide1.jpg" /></div>
                             <div class="news-content"><span class="label label-danger label-rounded">Primary</span>
                                 <h2>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h2> <a href="#">Read More</a></div>
                         </div>
                         <div class="item">
                             <div class="overlaybg"><img src="/img/news/slide1.jpg" /></div>
                             <div class="news-content"><span class="label label-primary label-rounded">Primary</span>
                                 <h2>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h2> <a href="#">Read More</a></div>
                         </div>
                         <div class="item">
                             <div class="overlaybg"><img src="/img/news/slide1.jpg" /></div>
                             <div class="news-content"><span class="label label-success label-rounded">Primary</span>
                                 <h2>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h2> <a href="#">Read More</a></div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
         <!-- .row -->
     <div class="row">
         <div class="col-md-12">
             <div class="white-box">
                 <div class="row">
                     <div class="col-md-4 col-sm-6 col-xs-12">
                         <h3 class="box-title">Sales in 2017</h3>
                         <p class="m-t-30">Lorem ipsum dolor sit amet, ectetur adipiscing elit. viverra tellus. ipsumdolorsitda amet, ectetur adipiscing elit.</p>
                         <p>
                             <br/> Ectetur adipiscing elit. viverra tellus.ipsum dolor sit amet, dag adg ecteturadipiscingda elitdglj. vadghiverra tellus.</p>
                     </div>
                     <div class="col-md-8 col-sm-6 col-xs-12">
                         <div id="morris-area-chart" style="height:250px;"></div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--/.row -->
     
     <!--row -->
     <div class="row">
         <div class="col-md-12 col-lg-6 col-sm-12">
             <div class="white-box">
                 <h3 class="box-title">Recent Posts</h3>
                 <div class="comment-center">
                     <div class="comment-body">
                         <div class="user-img"> <img src="/img/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                         <div class="mail-contnet">
                             <h5>Pavan kumar</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rouded label-info">PENDING</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                     </div>
                     <div class="comment-body">
                         <div class="user-img"> <img src="/img/users/sonu.jpg" alt="user" class="img-circle"> </div>
                         <div class="mail-contnet">
                             <h5>Sonu Nigam</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span><span class="label label-rouded label-success">APPROVED</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                     </div>
                     <div class="comment-body">
                         <div class="user-img"> <img src="/img/users/arijit.jpg" alt="user" class="img-circle"> </div>
                         <div class="mail-contnet">
                             <h5>Arijit Sinh</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat. </span><span class="label label-rouded label-danger">REJECTED</span><a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                     </div>
                     <div class="comment-body b-none">
                         <div class="user-img"> <img src="/img/users/pawandeep.jpg" alt="user" class="img-circle"></div>
                         <div class="mail-contnet">
                             <h5>Pavan kumar</h5> <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rouded label-info">PENDING</span> <a href="javacript:void(0)" class="action"><i class="ti-close text-danger"></i></a> <a href="javacript:void(0)" class="action"><i class="ti-check text-success"></i></a><span class="time pull-right">April 14, 2017</span></div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-md-12 col-lg-6">
             <div class="white-box" >
                 <h3 class="box-title">To Do List</h3>
                 <div  id="slimtest1">
                 <ul class="list-task list-group" data-role="tasklist" >
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputSchedule" name="inputCheckboxesSchedule">
                             <label for="inputSchedule"> <span>Schedule meeting</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputCall" name="inputCheckboxesCall">
                             <label for="inputCall"> <span>Call clients for follow-up</span> <span class="label label-danger">Today</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputBook" name="inputCheckboxesBook">
                             <label for="inputBook"> <span>Book flight for holiday</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputForward" name="inputCheckboxesForward">
                             <label for="inputForward"> <span>Forward important tasks</span> <span class="label label-warning">2 weeks</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                             <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                             <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                             <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                             <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                             <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                         </div>
                     </li>
                     <li class="list-group-item" data-role="task">
                         <div class="checkbox checkbox-info">
                             <input type="checkbox" id="inputRecieve" name="inputCheckboxesRecieve">
                             <label for="inputRecieve"> <span>Recieve shipment</span> </label>
                         </div>
                     </li>
                 </ul>
             </div>
             </div>
         </div>
     </div>
     <!-- /.row -->
 </div>
 <!-- /.container-fluid -->
 <footer class="footer text-center"> 2017 &copy; bidpro brought to you by CodeX </footer>
</div>
<!-- /#page-wrapper -->


@endsection