<div class="header">
    <nav class="navbar top-navbar navbar-expand-md navbar-light" style="background-color: #303540; color: white;">
        <div class="navbar-header" style="background-color: #303540;">
            <a href="<?php echo base_url("dashboard")?>" style="color: white; text-decoration: none;">
                <span class="fa fa-home"></span>
            </a>
            <a class="navbar-brand" href="<?php echo base_url("dashboard")?>" style="margin-left: 10px;">
                <span style="color: white;"><b>DataKu</b></span>
            </a>
        </div>

        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0">
                <li class="nav-item">
                    <a class="nav-link nav-toggler hidden-md-up text-muted " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> 
                </li>
                <li class="nav-item m-l-10"> 
                    <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> 
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin:0px;">
                        <i class="fa fa-cog" style="color: white;font-weight: bold;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                        <ul class="dropdown">
                            <li><a href="<?php echo base_url('changepassword')?>"><i class="fa fa-cog"></i>&nbsp;&nbsp;Ganti Password</a></li>
                            <li><a href="<?php echo base_url('login/logout')?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
            </ul>
        </div>
    </nav>
</div>

<style type="text/css">
    .ti-menu, .mdi-menu{
        color: white;
    }

    ul.dropdown li a{
        color: black;
    }
</style>
