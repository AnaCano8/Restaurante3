<header id="topnav">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <div class="container-fluid">
                            <ul class="list-unstyled topnav-menu float-right mb-0">
    
                                <li class="dropdown notification-list">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>
    
    
                                
    
                                
                               
    
                                <li class="dropdown notification-list">
                                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        
										<span class="ml-1 d-none d-sm-inline-block">
        <?= session('usuario') ?> <!-- Muestra el nombre del usuario -->
        <i class="mdi mdi-chevron-down"></i>
    </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
<!--
                                        <div class="dropdown-header noti-title">
                                            <h6 class="text-overflow m-0">Welcome !</h6>
                                        </div>
-->
    
                                        <!-- item-->
<!--
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="mdi mdi-account-outline"></i>
                                            <span>Profile</span>
                                        </a>
-->
    
                                        <!-- item-->
<!--
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="mdi mdi-settings-outline"></i>
                                            <span>Settings</span>
                                        </a>
-->
    
                                        <!-- item-->
<!--
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="mdi mdi-lock-outline"></i>
                                            <span>Lock Screen</span>
                                        </a>
-->
    
                                        <div class="dropdown-divider"></div>
    
                                        <!-- item-->
                                        <a href="<?= site_url('logout') ?>" class="dropdown-item notify-item">
                                            <i class="mdi mdi-logout-variant"></i>
                                            <span>Cerrar Sesión</span>
                                        </a>
    
                                    </div>
                                </li>
    
                                <li class="dropdown notification-list">
                                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                        <i class="mdi mdi-settings-outline noti-icon"></i>
                                    </a>
                                </li>
    
                            </ul>
    
                            <!-- LOGO -->
                            <div class="logo-box">
                                <a href="" class="logo text-center">
                                    <span class="logo-lg">
                                        <img src="<?php echo base_url('templates/assets/images/logonuevo.png');?>" alt="" height="90">
                                        <!-- <span class="logo-lg-text-light">Zircos</span> -->
                                    </span>
                                    <span class="logo-sm">
                                        <!-- <span class="logo-sm-text-dark">Z</span> -->
                                        <img src="<?php echo baseUrl();?>/templates/assets/images/logo-sm.png" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                
    
                            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
    
                               
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- end Topbar -->
    
                    <div class="topbar-menu">
                        <div class="container-fluid">
                            <div id="navigation">
                                <!-- Navigation Menu-->
                                <ul class="navigation-menu">
									
    
                                    <li class="has-submenu">
                                        <a href="<?php echo baseUrl();?>/dashboard"> <i class="mdi mdi-view-dashboard"></i>Dashboard</a>
                                       
                                    </li>
									
									<?php if (session('role') === 'Administrador'): ?>
									<li class="has-submenu">
                                        <a href="#"> <i class="mdi mdi-account-supervisor-outline"></i>Roles
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo baseUrl();?>/roles">Listado</a></li>
                                            <li><a href="<?php echo baseUrl();?>/roles/nuevo">Nuevo</a></li>
                                        
                                        </ul>
                                    </li>
									<?php endif; ?>
                                    
									<?php if (session('role') === 'Administrador'): ?>
                                    <li class="has-submenu">
                                        <a href="#"> <i class="fas fa-user-alt"></i>Usuarios
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo baseUrl();?>/usuarios">Listado</a></li>
                                            <li><a href="<?php echo baseUrl();?>/usuarios/nuevo">Nuevo</a></li>
                                        
                                        </ul>
                                    </li>
									<?php endif; ?>
                                    
                                    <li class="has-submenu">
                                        <a href="#"> <i class="fas fa-door-open"></i>Salones
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo baseUrl();?>/salones">Listado</a></li>
											
                                            <?php if (session('role') === 'Administrador'): ?>
											<li><a href="<?php echo baseUrl();?>/salones/nuevo">Nuevo</a></li>
											<?php endif; ?>
                                        
                                        </ul>
                                    </li>
									
									<li class="has-submenu">
                                        <a href="#"> <i class="mdi mdi-food-fork-drink"></i>Menus
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo baseUrl();?>/menus">Listado</a></li>
											
                                            <?php if (session('role') === 'Administrador'): ?>
											<li><a href="<?php echo baseUrl();?>/menus/nuevo">Nuevo</a></li>
											<?php endif; ?>
                                        
                                        </ul>
                                    </li>
									
									<li class="has-submenu">
                                        <a href="#"> <i class="ion ion-md-notifications"></i>Notificaciones
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo baseUrl();?>/notificaciones">Listado</a></li>
											<li><a href="<?php echo baseUrl();?>/notificaciones/nueva">Nuevo</a></li>
											
                                        
                                        </ul>
                                    </li>
									
									<?php if (session('role') === 'Administrador'): ?>
                                    <li class="has-submenu">
                                        <a href="#"> <i class="mdi mdi-eye"></i>Auditorias
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo baseUrl();?>/auditorias">Listado</a></li>
                                        
                                        </ul>
                                    </li>
									<?php endif; ?>
									
									<li class="has-submenu">
                                        <a href="#"> <i class="fas fa-calendar-check"></i>Eventos
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo baseUrl();?>/eventos">Listado</a></li>
											<li><a href="<?php echo baseUrl();?>/eventos/nuevo">Nuevo</a></li>
											
                                        
                                        </ul>
                                    </li>
                            
    
                                </ul>
                                <!-- End navigation menu -->
    
                                <div class="clearfix"></div>
                            </div>
                            <!-- end #navigation -->
                        </div>
                        <!-- end container -->
                    </div>
                    <!-- end navbar-custom -->
                </header>