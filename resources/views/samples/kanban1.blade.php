@extends('layouts.seekerapp')
@push('css')
<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

  <!-- <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css"> -->
  <style>
      /* body {font-family:Arial !important; } */
  /* h2 {margin:5px !important;} */
  /* input[type=text] {margin:10px !important;} */
  /* input[type=button] {margin:10px !important;}   */
  .container {width: 20% !important; float:left !important;clear: right !important;margin:0px !important; border-radius: 5px !important; }
  .sortable { list-style-type: none !important; margin:0 !important; padding:2px !important; min-height:50px !important; border-radius: 5px !important;}
  .sortable li { margin: 3px 3px 3px 3px !important; padding: 1.4em !important; padding-left: 1.5em !important; font-size: 1.4em !important; height: 18px !important;}
  .sortable li span { position: absolute !important; margin-left: -1.3em !important; }
 
  .card{background-color:white !important;border-radius:3px !important; position:relative !important;}
  </style>
@endpush
@section('content')
<div>
<div class="container" style="background-color:pink;">
<h2>TODO</h2>
<ul class="sortable connectedSortable">
  <li class="card">Activity A1</li>
  <li class="card">Activity A2</li>
  <li class="card">Activity A3</li>
</ul>
<div class="link-div">
    <input type="text" id="new_text" value=""/>
    <input type="button" name="btnAddNew" value="Add" class="add-button"/>
</div>
</div>
<div class="container" style="background-color:orange;">
<h2>In Progress</h2>
<ul class="sortable connectedSortable" >
  <li class="card">Activity B1</li>
  <li class="card">Activity B2</li>
</ul>
</div>
<div class="container" style="background-color:yellow;">
<h2>Verification</h2>
<ul class="sortable connectedSortable" >
  <li class="card">Activity C1</li>
  <li class="card">Activity C2</li>
</ul>
</div>
<div class="container" style="background-color:green;">
<h2>Done</h2>
<ul class="sortable connectedSortable" >
</ul>
</div>
</div>
@endsection
@push('scripts')
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( ".sortable" ).sortable({
      connectWith: ".connectedSortable",
      receive: function( event, ui ) {
          alert(ui);
        $(this).css({"background-color":"blue"});
      }
    }).disableSelection();
    $('.add-button').click(function() {
        var txtNewItem = $('#new_text').val();
        $(this).closest('div.container').find('ul').append('<li class="card">'+txtNewItem+'</li>');
    });    
  });
  </script>      
</head>
@endpush