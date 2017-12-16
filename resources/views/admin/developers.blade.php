@extends('layouts.adminlayout')
@section('content')
 <!-- Page Content -->
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Bidders</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="#">Bidders</a></li>
                            <li class="active">List of Bidders</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                 <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Data Export</h3>
                            <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th class="uniqye">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         <th>ID</th>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th>Contact</th>
                                             <th>Address</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                   @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ ucfirst($user->name) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td class="text-nowrap">
                                                <a href="edit-profile-bid.html" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-trash text-danger m-r-10"></i> </a>
                                                <a href="view-profile-bid.html" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-success m-r-10"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; bidpro brought to you by CodeX </footer>
        </div>
        <!-- /#page-wrapper -->

@endsection