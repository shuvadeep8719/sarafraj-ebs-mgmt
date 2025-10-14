<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm no-print">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}"><i class="fas fa-university me-2"></i>EXPERTZ BANKING</a>
                
                <div class="navbar-nav ms-auto">
                    <!-- Multi-level Dropdown Menu -->
                    <!-- <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-1"></i>System
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-database me-2"></i>Database</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">
                                    <i class="fas fa-users me-2"></i>User Management
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Add User</a></li>
                                    <li><a class="dropdown-item" href="#">User Roles</a></li>
                                    <li><a class="dropdown-item" href="#">Permissions</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">
                                    <i class="fas fa-chart-bar me-2"></i>Reports
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Daily Reports</a></li>
                                    <li><a class="dropdown-item" href="#">Monthly Reports</a></li>
                                    <li><a class="dropdown-item" href="#">Annual Reports</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div> -->

                    <!-- User Dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="user-avatar me-2">{{ substr($user->name, 0, 1) }}</div>
                            <span>{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li> -->
                            <!-- <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li> -->
                            <!-- <li><hr class="dropdown-divider"></li> -->
                            <!-- <li><a class="dropdown-item" href="#" onclick="logout()"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li> -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>