<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . '/../config/functions.php';
?>

<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="images/logo.png" class="navbar-brand-image img-fluid" alt="Tiya Golf Club">
            <span class="navbar-brand-text">
                Tiya
                <small>Golf Club</small>
            </span>
        </a>

        <div class="d-lg-none ms-auto me-3">
            <?php if (isset($_SESSION['login'])): ?>
                <a class="btn custom-btn custom-border-btn" href="auth/logout.php">
                    Logout (<?= htmlspecialchars($_SESSION['rola']) ?>)
                </a>
            <?php else: ?>
                <a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    Member Login
                </a>
            <?php endif; ?>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-auto">
                <?php printNavbarItems(); ?>
            </ul>

            <div class="d-none d-lg-block ms-lg-3">
                <?php if (isset($_SESSION['login'])): ?>
                    <a class="btn custom-btn custom-border-btn" href="auth/logout.php">
                        Logout (<?= htmlspecialchars($_SESSION['login']) ?>)
                    </a>
                <?php else: ?>
                    <a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        Member Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Member Login</h5>

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <form class="custom-form member-login-form" action="auth/login.php" method="post" role="form">

            <div class="member-login-form-body">
                <div class="mb-4">
                    <label class="form-label mb-2" for="member-login-number">Username</label>

                    <input type="text" name="member-login-number" id="member-login-number" class="form-control" placeholder="Username" required>
                </div>

                <div class="mb-4">
                    <label class="form-label mb-2" for="member-login-password">Password</label>

                    <input type="password" name="member-login-password" id="member-login-password" pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Password" required="">
                </div>
                <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasExample'));
                            offcanvas.show();
                        });
                    </script>
                    <div class="alert alert-danger text-center">
                        Incorrect username or password.
                    </div>
                <?php endif; ?>
                <div class="col-lg-5 col-md-7 col-8 mx-auto">
                    <button type="submit" class="form-control" >Login</button>
                </div>
            </div>
        </form>
    </div>