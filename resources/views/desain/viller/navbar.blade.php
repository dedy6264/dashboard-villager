 <nav class="px-0 bg-white navbar navbar-light fixed-bottom">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('viller.home') }}" class="text-center text-decoration-none text-primary">
                <i class="bi bi-house-door-fill fs-4"></i>
                <div class="small">Home</div>
            </a>
            <a href="{{ route('viller.history') }}"
                class="text-center text-decoration-none text-secondary">
                <i class="bi bi-clock-history fs-4"></i>
                <div class="small">History</div>
            </a>
            <a href="{{ route('viller.account') }}"
                class="text-center text-decoration-none text-secondary">
                <i class="bi bi-person-circle fs-4"></i>
                <div class="small">Akun</div>
            </a>
        </div>
</nav>