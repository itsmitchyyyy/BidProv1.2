<div class="navbar-default sidebar" role="navigation">
<div class="sidebar-nav navbar-collapse slimscrollsidebar">
    <ul class="nav" id="side-menu">
        <li class="sidebar-search hidden-sm hidden-md hidden-lg">
            <!-- input-group -->
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
<button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
</span> </div>
            <!-- /input-group -->
        </li>
       <!-- <li class="user-pro">
            <a href="#" class="waves-effect">
            @if(Auth::user()->avatar == null)
            <img src="/uploads/blank.png" alt="user-img" class="img-circle">
            @else 
            <img src="{{ Auth::user()->avatar }}" alt="user-img" class="img-circle">
            @endif
            <span class="hide-menu"> {{ Auth::user()->name }}<span class="fa arrow"></span></span>
            </a>
            <ul class="nav nav-second-level">
                <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
                <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
        </li>-->
        <li class="nav-small-cap m-t-10"><center>----- Main Menu -----</center></li>
        <li> <a href="{{ route('admin') }}" class="waves-effect{{ Request::is('admin') ? ' active' : ''}}"><i class="fa fa-dashboard fa-fw text-danger" ></i> <span class="hide-menu"> Dashboard  </span></a>
        </li>
        <li>
            <a href="http://" class="waves-effect"><i class="fa fa-sticky-note-o fa-fw text-danger"></i><span class="hide-menu"> Reports</span></a>
        </li>
        <li> <a href="{{ route('bidderAdmin') }}" class="waves-effect{{ Request::is('bidderAdmin') ? ' active' : ''}} "><i class="fa fa-user-o fa-fw  text-danger" ></i> <span class="hide-menu"> Bidders </span></a>
            
        </li>
        <li><a href="{{ route('adminSeeker') }}" class="waves-effect "><i class="fa fa-user-o  fa-fw text-danger"></i> <span class="hide-menu">Seekers</span></a>
            
        </li>
      <!--  <li><a href="" class="waves-effect"><i class="zmdi zmdi-apps zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Calendar</span></a>
            
        </li>-->
        <!--
        <li class="nav-small-cap">--- Proffessional</li>
        <li> <a href="#" class="waves-effect"><i class="zmdi zmdi-copy zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Sample Pages<span class="fa arrow"></span><span class="label label-rouded label-purple pull-right">30</span></span></a>
            <ul class="nav nav-second-level">
                <li><a href="starter-page.html">Starter Page</a></li>
                <li><a href="blank.html">Blank Page</a></li>
                <li><a href="javascript:void(0)" class="waves-effect">Email Templates<span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li> <a href="http://eliteadmin.themedesigner.in/demos/email-templates/basic.html">Basic</a></li>
                        <li> <a href="http://eliteadmin.themedesigner.in/demos/email-templates/alert.html">Alert</a></li>
                        <li> <a href="http://eliteadmin.themedesigner.in/demos/email-templates/billing.html">Billing</a></li>
                        <li> <a href="http://eliteadmin.themedesigner.in/demos/email-templates/password-reset.html">Reset Pwd</a></li>
                    </ul>
                </li>
                <li><a href="lightbox.html">Lightbox Popup</a></li>
                <li><a href="treeview.html">Treeview</a></li>
                <li><a href="search-result.html">Search Result</a></li>
                <li><a href="utility-classes.html">Utility Classes</a></li>
                <li><a href="custom-scroll.html">Custom Scrolls</a></li>
                <li><a href="login.html">Login Page</a></li>
                <li><a href="login2.html">Login v2</a></li>
                <li><a href="animation.html">Animations</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="invoice.html">Invoice</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="pricing.html">Pricing</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="register2.html">Register v2</a></li>
                <li><a href="register3.html">3 Step Registration</a></li>
                <li><a href="recoverpw.html">Recover Password</a></li>
                <li><a href="lock-screen.html">Lock Screen</a></li>
                <li><a href="400.html">Error 400</a></li>
                <li><a href="403.html">Error 403</a></li>
                <li><a href="404.html">Error 404</a></li>
                <li><a href="500.html">Error 500</a></li>
                <li><a href="503.html">Error 503</a></li>
            </ul>
        </li>
        <li> <a href="#" class="waves-effect"><i class="zmdi zmdi-chart zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Charts<span class="fa arrow"></span></span></a>
            <ul class="nav nav-second-level">
                <li> <a href="flot.html">Flot Charts</a> </li>
                <li><a href="morris-chart.html">Morris Chart</a></li>
                <li><a href="chart-js.html">Chart-js</a></li>
                <li><a href="peity-chart.html">Peity Charts</a></li>
                <li><a href="knob-chart.html">Knob Charts</a></li>
                <li><a href="sparkline-chart.html">Sparkline charts</a></li>
                <li><a href="extra-charts.html">Extra Charts</a></li>
            </ul>
        </li>
        <li> <a href="tables.html" class="waves-effect"><i class="zmdi zmdi-border-all zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Tables<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">7</span></span></a>
            <ul class="nav nav-second-level">
                <li><a href="basic-table.html">Basic Tables</a></li>
                <li><a href="table-layouts.html">Table Layouts</a></li>
                <li><a href="data-table.html">Data Table</a></li>
                <li class="hidden"><a href="crud-table.html">Crud Table</a></li>
                <li><a href="bootstrap-tables.html">Bootstrap Tables</a></li>
                <li><a href="responsive-tables.html">Responsive Tables</a></li>
                <li><a href="editable-tables.html">Editable Tables</a></li>
                <li><a href="foo-tables.html">FooTables</a></li>
                <li><a href="jsgrid.html">JsGrid Tables</a></li>
            </ul>
        </li>
        <li> <a href="widgets.html" class="waves-effect"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Widgets</span></a> </li>
        <li> <a href="#" class="waves-effect"><i class="zmdi zmdi-mood zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Icons<span class="fa arrow"></span></span></a>
            <ul class="nav nav-second-level">
                <li> <a href="fontawesome.html">Font awesome</a> </li>
                <li> <a href="themifyicon.html">Themify Icons</a> </li>
                <li> <a href="simple-line.html">Simple line Icons</a> </li>
                <li> <a href="material-icons.html">Material Icons</a> </li>
                <li><a href="linea-icon.html">Linea Icons</a></li>
                <li><a href="weather.html">Weather Icons</a></li>
            </ul>
        </li>
        <li> <a href="map-google.html" class="waves-effect"><i class="zmdi zmdi-pin-drop zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Google Map</span></a> </li>
        <li> <a href="map-vector.html" class="waves-effect"><i class="zmdi zmdi-pin zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Vector Map</span></a> </li>
        <li> <a href="calendar.html" class="waves-effect"><i class="zmdi zmdi-calendar-check zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Calendar</span></a></li>
        <li> <a href="javascript:void(0)" class="waves-effect"><i class="zmdi zmdi-view-list zmdi-hc-fw fa-fw"></i> <span class="hide-menu">Multi-Level Dropdown<span class="fa arrow"></span></span></a>
            <ul class="nav nav-second-level">
                <li> <a href="javascript:void(0)">Second Level Item</a> </li>
                <li> <a href="javascript:void(0)">Second Level Item</a> </li>
                <li> <a href="javascript:void(0)" class="waves-effect">Third Level <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li> <a href="javascript:void(0)">Third Level Item</a> </li>
                        <li> <a href="javascript:void(0)">Third Level Item</a> </li>
                        <li> <a href="javascript:void(0)">Third Level Item</a> </li>
                        <li> <a href="javascript:void(0)">Third Level Item</a> </li>
                    </ul>
                </li>
            </ul>
        </li>
-->
    </ul>
</div>
</div>