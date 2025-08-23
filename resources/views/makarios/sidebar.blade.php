<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Core -->
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('homes') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Home
                </a>

                <!-- Admin -->
                <div class="sb-sidenav-menu-heading">Admin</div>
                {{-- user --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    User
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUser" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('users') }}">Users</a>
                        <a class="nav-link" href="{{ route('groups') }}">Permission</a>
                    </nav>
                </div>
                {{-- hirarchy --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseManagement" aria-expanded="false" aria-controls="collapseManagement">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Management Tree
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseManagement" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('makarios.client') }}">Client</a>
                        <a class="nav-link" href="{{ route('makarios.group') }}">Group</a>
                        <a class="nav-link" href="{{ route('makarios.merchant') }}">Merchant</a>
                        <a class="nav-link" href="{{ route('makarios.merchantoutlet') }}">Merchant Outlet</a>
                    </nav>
                </div>
                <!-- Product -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductArea" aria-expanded="false" aria-controls="collapseProductArea">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Product
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProductArea" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionProductArea">
                        <!-- Product -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                            <span>Product</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduct" data-bs-parent="#sidenavAccordionProductArea">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('makarios.productcategory') }}">Category</a>
                                <a class="nav-link" href="{{ route('makarios.producttype') }}">Product Type</a>
                                <a class="nav-link" href="{{ route('makarios.product') }}">Product</a>
                            </nav>
                        </div>
                        <!--Product Provider -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProvider" aria-expanded="false" aria-controls="collapseProvider">
                            <span>Provider</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProvider" data-bs-parent="#sidenavAccordionProductArea">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('makarios.provider') }}">Provider</a>
                                <a class="nav-link" href="{{ route('makarios.productprovider') }}">Product Provider</a>
                            </nav>
                        </div>
                        <!--Product Segment -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSegment" aria-expanded="false" aria-controls="collapseSegment">
                            <span>Segment</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseSegment" data-bs-parent="#sidenavAccordionProductArea">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('makarios.segment') }}">Segment</a>
                                <a class="nav-link" href="{{ route('makarios.productsegment') }}">Product Segment</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                 {{-- Accounts --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAccount" aria-expanded="false" aria-controls="collapseAccount">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Account
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAccount" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('makarios.account') }}">Accounts</a>
                        <a class="nav-link" href="{{ route('makarios.accountsaving') }}">Saving Account</a>
                    </nav>
                </div>
                <!-- Addons -->
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>