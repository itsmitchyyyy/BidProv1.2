@extends('layouts.adminlayout')
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
                   <li class="active">Presentation</li>
               </ol>
           </div>
           <!-- /.col-lg-12 -->
           <div class="row">
           <div class="col-md-12 col-lg-12 col-sm-12">
               <div class="white-box">
                   <div class="row row-in">
                       <div class="col-lg-3 col-sm-6 row-in-br">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="mi-account-box"></i>
                                   <h5 class="text-muted vb">PENDING PRESENTATION</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-danger">{{ $controller->pendingPresentation()  }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $controller->pendingPresentation()  }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->pendingPresentation()  }}%"> </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                                   <h5 class="text-muted vb">DONE PRESENTATION</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-megna">{{ $controller->donePresentation() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="{{ $controller->donePresentation() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->donePresentation() }}%">  </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-3 col-sm-6 row-in-br">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                   <h5 class="text-muted vb">TOTAL PRESENTATION</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-primary">{{ $controller->totalPresentation() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ $controller->totalPresentation() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->totalPresentation() }}%"> </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <!-- <div class="col-lg-3 col-sm-6  b-0">
                           <div class="col-in row">
                               <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                                   <h5 class="text-muted vb">Reports</h5>
                               </div>
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <h3 class="counter text-right m-t-15 text-success">{{ $controller->userSeeker() }}</h3>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="progress">
                                       <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $controller->userSeeker() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $controller->userSeeker() }}%">  </div>
                                   </div>
                               </div>
                           </div>
                       </div> -->
                   </div>
               </div>
           </div>
       </div>
           <div class="col-sm-12">
                        <div class="white-box">
                            <!-- <h3 class="box-title m-b-0">Data Export</h3> -->
                            <!-- <ol class="breadcrumb">
                                <li ><a href="#" id="usersAll" class="active">All Users</a></li>
                                <li ><a href="#" id="usersBanned" class="not-active">Banned Users</a></li>
                            </ol> -->
                            <!-- ALL USERS -->
                            <div class="table-responsive" id="allUser">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Presentation ID</th>
                                            <th>Seeker</th>
                                            <th>Bidder</th>
                                            <th>Project Title</th>
                                            <th>Seeker Status</th>
                                            <th>Bidder Status</th>
                                            <th>Presentation Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Presentation ID</th>
                                            <th>Seeker</th>
                                            <th>Bidder</th>
                                            <th>Project Title</th>
                                            <th>Seeker Status</th>
                                            <th>Bidder Status</th>
                                            <th>Presentation Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($reports as $report)
                                        <tr>
                                            <td>{{ $report->id }}</td>
                                            <td>{{ ucfirst($controller->getUser($report->seeker_id)->firstname) }} {{ ucfirst($controller->getUser($report->seeker_id)->lastname) }}</td>
                                            <td>{{ ucfirst($controller->getUser($report->bidder_id)->firstname) }} {{ ucfirst($controller->getUser($report->bidder_id)->lastname) }}</td>
                                            <td>{{ ucwords($controller->getProject($report->project_id)->title) }}</td>
                                            <td>
                                                @if($report->seeker_status == 1)
                                                    Presented
                                                @else
                                                    Waiting for presentation
                                                @endif
                                            </td>
                                            <td>
                                            @if($report->bidder_status == 1)
                                                    Presented
                                                @else
                                                    Waiting for presentation
                                                @endif
                                            </td>
                                           <td>
                                           @if($report->seeker_status == 1 && $report->bidder_status == 1)
                                                     Done
                                                @else
                                                    Pending
                                                @endif
                                           </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END OF USERS -->
                        </div>
                    </div>
       </div>
</div>
@endsection