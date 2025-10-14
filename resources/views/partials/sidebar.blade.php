
                    <nav class="sidebar">
                        <div class="p-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                        <i class="fas fa-users me-2"></i>Customers
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="showPage('business')">
                                        <i class="fas fa-briefcase me-2"></i>Target Business
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="showPage('queries')">
                                        <i class="fas fa-question-circle me-2"></i>Banking Queries
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" onclick="showPage('invoice')">
                                        <i class="fas fa-file-invoice me-2"></i>Invoice
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
