<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Republic of the Philippines - National Treasury Portal</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter & Merriweather) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gov-primary: #800000;       /* Official deep red/maroon */
            --gov-dark: #4d0000;          /* Darker shade for contrast */
            --gov-gold: #c5a059;          /* Institutional gold accent */
            --gov-light: #f8f9fa;         
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 75px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f3f5;
            color: #212529;
            overflow-x: hidden;
        }

        /* --- REPUBLIC TOP UTILITY BAR --- */
        .republic-top-bar {
            background-color: #1a1a1a;
            color: #adb5bd;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 4px 0;
            border-bottom: 1px solid #333;
        }

        /* --- MAIN GOVERNMENT HEADER --- */
        .gov-navbar {
            background-color: var(--gov-primary);
            border-bottom: 4px solid var(--gov-gold);
            min-height: 75px;
            z-index: 1040;
        }

        .gov-brand-title {
            font-family: 'Merriweather', serif;
            font-size: 1.05rem;
            color: #ffffff;
            line-height: 1.2;
        }

        /* Header Navigation Links */
        .header-nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 4px;
            transition: all 0.2s;
            text-decoration: none;
            white-space: nowrap;
        }
        .header-nav-link:hover, .header-nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff !important;
        }

        /* --- RESPONSIVE SIDEBAR --- */
        .sidebar {
            position: fixed;
            top: 105px; /* Top bar + Navbar height */
            bottom: 0;
            left: 0;
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            z-index: 1030;
            overflow-y: auto;
            transition: width 0.3s ease, transform 0.3s ease;
        }

        .sidebar-section-title {
            font-size: 0.68rem;
            letter-spacing: 1px;
            color: #6c757d;
            padding: 0 20px;
            margin-top: 16px;
            margin-bottom: 6px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .sidebar .nav-link {
            color: #495057;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 10px 20px;
            margin: 4px 12px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #fdf2f2;
            color: var(--gov-primary);
        }

        .sidebar .nav-icon {
            font-size: 1.1rem;
            min-width: 30px;
            text-align: center;
        }

        /* --- MAIN CONTENT AREA --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            margin-top: 105px;
            min-height: calc(100vh - 105px);
            transition: margin-left 0.3s ease;
        }

        /* --- DESKTOP COLLAPSED STATE RULES --- */
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        body.sidebar-collapsed .sidebar .nav-text,
        body.sidebar-collapsed .sidebar .sidebar-section-title {
            display: none !important;
        }
        body.sidebar-collapsed .sidebar .nav-link {
            justify-content: center;
            padding: 10px 0;
            margin: 4px 8px;
        }
        body.sidebar-collapsed .sidebar .nav-icon {
            margin: 0;
        }

        /* --- MOBILE & TABLET MEDIA QUERIES --- */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
            }
            .sidebar.show-mobile-sidebar {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- ================================================================= -->
    <!-- 1. REPUBLIC OF THE PHILIPPINES TOP UTILITY BAR                    -->
    <!-- ================================================================= -->
    <div class="republic-top-bar px-3 d-flex justify-content-between align-items-center">
        <div>
            <span>🇵🇭 Republic of the Philippines</span> | <span class="text-white">National Government Portal</span>
        </div>
        <div class="d-none d-sm-block">
            <span>Standard Time: <strong id="ph-time">Manila, PH</strong></span>
        </div>
    </div>


    <!-- ================================================================= -->
    <!-- 2. MAIN GOVERNMENT HEADER NAVBAR                                  -->
    <!-- ================================================================= -->
    <nav class="navbar navbar-dark gov-navbar px-3 px-lg-4 fixed-top d-flex justify-content-between">
        
        <!-- Left: Sidebar Toggle Button & Brand Title -->
        <div class="d-flex align-items-center">
            <button class="btn btn-sm btn-outline-light me-3 px-2 py-1" id="sidebarToggle" title="Toggle Navigation Menu">
                <span id="toggleIcon" class="fs-5">☰</span>
            </button>
            
            <a class="navbar-brand d-flex align-items-center mb-0 text-decoration-none" href="#">
                <span class="fs-3 me-2">🥮</span> 
                <div>
                    <div class="gov-brand-title">EXPENSE TRACKER</div>
                    <small class="text-white-50 fw-normal" style="font-size: 0.65rem;">Integrated Expense & Disbursement Ledger</small>
                </div>
            </a>
        </div>

        <!-- Middle: Header Navigation Options (Identical to Sidebar) -->
        <!-- TIP: To experiment with a Sidebar-Only layout, you can comment out this <div> block -->
        <div class="d-none d-lg-flex align-items-center gap-1">
            <a href="{{ route('dashboard') }}" class="header-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">📊 Dashboard</a>
            <a href="{{ route('expenses.index') }}" class="header-nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">💳 Expenses</a>
            <a href="{{ route('categories.index') }}" class="header-nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">📁 Categories</a>
            <a href="#" class="header-nav-link">⚙️ Settings</a>
            <a href="#" class="header-nav-link text-warning fw-bold">🚪 Logout</a>
        </div>

        <!-- Right: Security Badge & Authorized User Avatar -->
        <div class="text-white d-flex align-items-center">
            <div class="me-3 text-end d-none d-md-block">
                <span class="badge bg-success bg-opacity-25 text-success border border-success px-2 py-1" style="font-size: 0.65rem;">● GOV-SECURE</span>
                <small class="d-block text-white-50 mt-1" style="font-size: 0.68rem;">PHP (₱) Currency</small>
            </div>
            <div class="bg-light text-danger rounded-circle fw-bold d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px; font-size: 0.8rem;" title="Authorized Signatory">
                SEC
            </div>
        </div>
    </nav>


    <!-- ================================================================= -->
    <!-- 3. FORMAL GOVERNMENT SIDEBAR NAVIGATION                           -->
    <!-- TIP: To experiment with a Header-Only layout, you can wrap this  -->
    <!-- whole <div class="sidebar">...</div> in HTML comments.             -->
    <!-- ================================================================= -->
    <div class="sidebar" id="appSidebar">
        <div class="pt-2 pb-4">
            
            <div class="sidebar-section-title">Navigation Menu</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    
                        <span class="nav-icon">📊</span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}" href="{{ route('expenses.index') }}">
                        <span class="nav-icon">💳</span>
                        <span class="nav-text">Expenses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <span class="nav-icon">📁</span>
                        <span class="nav-text">Categories</span>
                    </a>
                </li>
            </ul>

            <hr class="mx-3 my-3 text-muted opacity-25">

            <div class="sidebar-section-title">Account Settings</div>
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-icon">⚙️</span>
                        <span class="nav-text">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="#">
                        <span class="nav-icon">🚪</span>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>


    <!-- ================================================================= -->
    <!-- 4. DYNAMIC CONTENT CONTAINER                                      -->
    <!-- ================================================================= -->
    <main class="main-content">
        @yield('content')
    </main>


    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- ================================================================= -->
    <!-- RESPONSIVE TOGGLE & ICON SWITCH SCRIPT                             -->
    <!-- ================================================================= -->
    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');
        const sidebar = document.getElementById('appSidebar');
        const body = document.body;

        // Function to update the toggle icon (☰ vs ✕)
        function updateToggleIcon() {
            const isMobile = window.innerWidth < 992;
            const isOpened = isMobile 
                ? sidebar.classList.contains('show-mobile-sidebar') 
                : !body.classList.contains('sidebar-collapsed');

            toggleIcon.textContent = isOpened ? '✕' : '☰';
        }

        // Handle button click for Desktop & Mobile
        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('show-mobile-sidebar');
            } else {
                body.classList.toggle('sidebar-collapsed');
                const isCollapsed = body.classList.contains('sidebar-collapsed');
                localStorage.setItem('govSidebarState', isCollapsed ? 'collapsed' : 'expanded');
            }
            updateToggleIcon();
        });

        // Load saved state on desktop page load
        if (window.innerWidth >= 992 && localStorage.getItem('govSidebarState') === 'collapsed') {
            body.classList.add('sidebar-collapsed');
        }

        // Initialize icon state on load
        updateToggleIcon();

        // Adjust layout and icon dynamically on screen resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('show-mobile-sidebar');
            }
            updateToggleIcon();
        });
    </script>
</body>
</html>