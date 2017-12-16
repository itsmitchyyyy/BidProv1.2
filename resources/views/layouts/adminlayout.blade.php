<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BidPro</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '/js/analytics.js', 'ga');
    ga('create', 'UA-19175540-9', 'auto');
    ga('send', 'pageview');
    </script>

</head>
<body>
    @if(Auth::user()->hasRoles('admin'))
    <div id="wrapper">
        @include('inc.adminNav')
        @include('inc.adminSide')
        @yield('content')
    </div>
    @else
        <script>
            window.location = "{{ URL::to('/') }}";
        </script>
    @endif
</body>
    <!-- jQuery -->
    <script src="{{ asset('js//bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <!--slimscroll JavaScript -->
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
     <!--Wave Effects -->
    <script src="{{ asset('js/waves.js') }}"></script>
      <!--weather icon -->
    <script src="{{ asset('js/bower_components/skycons/skycons.js') }}"></script>
        <!--Counter js -->
    <script src="{{ asset('js/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('js/bower_components/counterup/jquery.counterup.min.js') }}"></script>
     <!--Morris JavaScript -->
    <script src="{{ asset('js/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('js/bower_components/morrisjs/morris.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dashboard4.js') }}"></script>
    <script src="{{ asset('js/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
     <!-- Sparkline chart JavaScript -->
    <script src="{{ asset('js/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/jquery-sparkline/jquery.charts-sparkline.js') }}"></script>
     <!--Style Switcher -->
    <script src="{{ asset('js/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
     <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- Calendar JavaScript -->
    <script src="{{ asset('js/bower_components/calendar/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('js/bower_components/calendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/calendar/dist/cal-init.js') }}"></script>
      <!-- Sweet-Alert  -->
    <script src="{{ asset('js/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
     <!-- start - This is for export functionality only -->
    <script src="{{ asset('js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
  <!-- end - This is for export functionality only -->




    <!-- my own script here!!!-->
    <script type="text/javascript">
        function validation() {
              swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this event!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Deleted!", "Your event has been deleted.", "success"); 
        });
          };
        function good() {
              swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this event!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Deleted!", "Your event has been deleted.", "success"); 
        });
          };
    </script>
     <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>



</html>