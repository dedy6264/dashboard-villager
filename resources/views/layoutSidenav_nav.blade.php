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
                <!-- Product Area -->
                @php
                    $productPages = ['product_type', 'product_category', 'product'];
                    $isProductActive = in_array($activePage ?? '', $productPages);
                @endphp
                <a class="{{ $isProductActive ? 'nav-link' : 'nav-link collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductArea" aria-expanded="{{ $isProductActive ? true : false }}" aria-controls="collapseProductArea">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Product Area
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="{{ $isProductActive ?'' : ' collapse' }}" id="collapseProductArea" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionProductArea">
                        <!-- Product Submenu -->
                        <a class="{{ $isProductActive ? 'nav-link' : 'nav-link collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="{{ $isProductActive ? true : false }}" aria-controls="collapseProduct">
                            <span>Product</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="{{ $isProductActive ? '' : ' collapse' }}" id="collapseProduct" data-bs-parent="#sidenavAccordionProductArea">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ ($activePage ?? '') == 'product_category' ? '' : ' collapsed' }}" href="{{ route('categoryProducts') }}">Category</a>
                                <a class="nav-link {{ ($activePage ?? '') == 'product_type' ? '' : ' collapsed' }}" href="{{ route('productTypes') }}">Product Type</a>
                                <a class="nav-link {{ ($activePage ?? '') == 'product' ? '' : ' collapsed' }}" href="{{ route('products') }}">Product</a>
                                <a class="nav-link" href="{{ route('trxs') }}">Transactions</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <!-- Saving Area -->
                @php
                    $accountPages = ['saving_type', 'saving_segment', 'saving_transaction','account','cifs'];
                    $isSavingActive = in_array($activePage ?? '', $accountPages);
                @endphp
                <a class="{{ $isSavingActive ? 'nav-link' : 'nav-link collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAccountArea" aria-expanded="{{ $isSavingActive ? true : false }}" aria-controls="collapseAccountArea">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Accounts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="{{ $isSavingActive ?'' : ' collapse' }}" id="collapseAccountArea" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="collapseAccountArea">
                        <a class="nav-link {{ ($activePage ?? '') == 'cifs' ? '' : ' collapsed' }}" href="{{ route('cifs') }}">CIFs</a>
                        <a class="nav-link {{ ($activePage ?? '') == 'saving_type' ? '' : ' collapsed' }}" href="{{ route('savingType.index') }}">Saving Type</a>
                        <a class="nav-link {{ ($activePage ?? '') == 'account' ? '' : ' collapsed' }}" href="{{ route('accounts') }}">Saving Account</a>
                        <a class="nav-link {{ ($activePage ?? '') == 'saving_segment' ? '' : ' collapsed' }}" href="{{ route('savingSegment.index') }}">Saving Segment</a>
                        <a class="nav-link {{ ($activePage ?? '') == 'saving_transaction' ? '' : ' collapsed' }}" href="{{ route('savingTransaction.index') }}">Saving Transaction</a>
                    </nav>
                </div>

                <!-- Addons -->
                {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a> --}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>