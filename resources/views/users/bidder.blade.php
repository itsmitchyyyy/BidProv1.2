@extends('layouts.bidderapp')
@section('content')
 <div class="container-fluid">
 <h3>Project List</h3>
 <table id="myTable" class="table-striped table-bordered table" width="100%" cellspacing="0">
  <thead>
  <tr>
  <th>PROJECT</th>
    <th>BIDS</th>
    <th>ENDS</th>
    <th>PRICE(PHP)</th>
  </tr>
  </thead>
  <tbody>
    @foreach($projects as $project)
      <tr>
        <td>
        <h2><a href="#">{{ ucwords($project->title) }}</a></h2> <a href="#" style="text-decoration:none;color:black">{{ str_limit(ucfirst($project->details), $limit = 100, $end = '...') }}</a>
        </td>
        <td><i class="fa fa-trophy"></i> 0 Entries</td>
        <td>
        <i class="fa fa-clock-o"></i>
        <?php
          $formatted = Carbon\Carbon::parse($project->duration);
          echo $formatted->diffForHumans();
        ?>
        </td>
        <td>
        <span>&#8369;</span>{{ $project->min }} - <span>&#8369;</span>{{ $project->max }}
        </td>
      </tr>
    @endforeach
  </tbody>
 </table>
<!-- END TABLE -->
 </div>
@endsection
@section('scripts')
<script src="{{ asset('js/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable();
    });
  </script>
@endsection