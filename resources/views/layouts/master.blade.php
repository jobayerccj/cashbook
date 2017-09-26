<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cashbook Solutions</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('resources/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('resources/assets/css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset('resources/assets/css/timeline.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('resources/assets/css/startmin.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('resources/assets/css/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('resources/assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Cashbook</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Vatic Soft Ltd</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                @if (Auth::guest())
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    </ul>
                @else
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url('/auth/edit_profile') }}"><i class="fa fa-user fa-fw"></i> Update Profile</a>
                        </li>
                        <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>-->
                        
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                @endif
                
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <!--Account Title Section Menu Start-->
	                    <li>
                        <a href="#"><i class="glyphicon glyphicon-folder-open"></i>  Accounts<span class="fa arrow"></span></a>
	                        <ul class="nav nav-second-level">
	                            <li>
	                                <a href="{{ URL('accounts/create') }}"><i class="glyphicon glyphicon-plus"></i> Add Accounts Title</a>
	                            </li>
	                            <li>
	                                <a href="{{ URL('accounts') }}"><i class="glyphicon glyphicon-th-list"></i> Accounts List</a>
	                            </li>
	                            
	                        </ul>
                    	</li>
                    <!--Account Title Section Menu End-->
                    
                     <!--Parties Section Menu Start-->
	                    <li>
                        <a href="#"><i class="glyphicon glyphicon-user glyphicon"></i>  Parties<span class="fa arrow"></span></a>
	                        <ul class="nav nav-second-level">
	                            <li>
	                                <a href="{{ URL('parties/create') }}"><i class="glyphicon glyphicon-plus"></i> Add Parties</a>
	                            </li>
	                            <li>
	                                <a href="{{ URL('parties') }}"><i class="glyphicon glyphicon-th-list"></i> Parties List</a>
	                            </li>
	                            
	                        </ul>
                    	</li>
                    <!--Parties Title Section Menu End-->
                    
                    <!--Accounts Receivables Section Menu Start-->
	                    <li>
                        <a href="#"><i class="glyphicon glyphicon-book"></i>  Accounts Receivables<span class="fa arrow"></span></a>
	                        <ul class="nav nav-second-level">
	                            <li>
	                                <a href="{{ URL('accountsReceivables/create') }}"><i class="glyphicon glyphicon-plus"></i> Add Accounts Receivables</a>
	                            </li>
	                            <li>
	                                <a href="{{ URL('accountsReceivables') }}"><i class="glyphicon glyphicon-th-list"></i> Accounts Receivables List</a>
	                            </li>
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-search"></i> Reports</a>
	                            </li>
	                            
	                        </ul>
                    	</li>
                    <!--Accounts Receivables Section Menu End-->
                    
                    <!--Accounts Payables Section Menu Start-->
	                    <li>
                        <a href="#"><i class="glyphicon glyphicon-modal-window"></i>  Accounts Payables<span class="fa arrow"></span></a>
	                        <ul class="nav nav-second-level">
	                            <li>
	                                <a href="{{ URL('accountsPayables/create') }}"><i class="glyphicon glyphicon-plus"></i> Add Accounts Payables</a>
	                            </li>
	                            <li>
	                                <a href="{{ URL('accountsPayables') }}"><i class="glyphicon glyphicon-th-list"></i> Accounts Payables List</a>
	                            </li>
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-search"></i> Reports</a>
	                            </li>
	                            
	                        </ul>
                    	</li>
                    <!--Accounts Payables Section Menu End-->
                    
                    <!--Cash Receipts Section Menu Start-->
	                    <li>
                        <a href="#"><i class="glyphicon glyphicon-euro"></i>  Cash Receipts<span class="fa arrow"></span></a>
	                        <ul class="nav nav-second-level">
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-plus"></i> Receive Cash</a>
	                            </li>
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-th-list"></i> Cash Received List</a>
	                            </li>
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-search"></i> Cash Receipts Statements</a>
	                            </li>
	                            
	                        </ul>
                    	</li>
                    <!--Accounts Receipts Section Menu End-->
                    
                    <!--Cash Payments Section Menu Start-->
	                    <li>
                        <a href="#"><i class="glyphicon glyphicon-minus"></i>  Cash Payments<span class="fa arrow"></span></a>
	                        <ul class="nav nav-second-level">
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-plus"></i> Payment in Cash</a>
	                            </li>
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-th-list"></i> Cash Paid List</a>
	                            </li>
	                            <li>
	                                <a href="#"><i class="glyphicon glyphicon-search"></i> Cash Payments Statements</a>
	                            </li>
	                            
	                        </ul>
                    	</li>
                    <!--Accounts Payments Section Menu End-->
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Added Later<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                	
                    	@yield('page_title')
                    
                </div>
            </div>

            <!-- ... Your content goes here ... -->
             <div class="row">
                <div class="col-lg-12">
                    
                        @yield('content')
                    
                </div>
            </div>

            		
        </div>
    </div>

</div>



<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset('resources/assets/js/metisMenu.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ asset('resources/assets/js/startmin.js') }}"></script>

</body>
</html>
