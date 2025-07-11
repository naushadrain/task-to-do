
@include('user.temp.header')
@include('user.temp.sidebar')


    <main class="main-content">
        <div class="container-fluid pt-4 mt-4">
            <h2 class="mb-4 text-white">Dashboard Overview</h2>
            @yield('content')
            
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Optional: Add JavaScript for sidebar toggle on smaller screens
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggler = document.querySelector('.navbar-toggler');
            const sidebarMenu = document.getElementById('sidebarMenu');

            if (sidebarToggler && sidebarMenu) {
                sidebarToggler.addEventListener('click', function() {
                    sidebarMenu.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>