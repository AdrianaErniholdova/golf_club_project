<?php
session_start();
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
            <a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Member Login</a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_1">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_2">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_3">Membership</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="reservations.php">Reservations</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_5">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="events.php">Events</a>
                </li>
            </ul>

            <div class="d-none d-lg-block ms-lg-3">
    <?php if (isset($_SESSION['login'])): ?>
        <a class="btn custom-btn custom-border-btn" href="db/logout.php">Logout (<?= htmlspecialchars($_SESSION['rola']) ?>)</a>
    <?php else: ?>
        <a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Member Login</a>
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
        <form class="custom-form member-login-form" action="db/login.php" method="post" role="form">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

            <div class="member-login-form-body">
                <div class="mb-4">
                    <label class="form-label mb-2" for="member-login-number">Username</label>

                    <input type="text" name="member-login-number" id="member-login-number" class="form-control" placeholder="11002560" required>
                </div>

                <div class="mb-4">
                    <label class="form-label mb-2" for="member-login-password">Password</label>

                    <input type="password" name="member-login-password" id="member-login-password" pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Password" required="">
                </div>

                <div class="col-lg-5 col-md-7 col-8 mx-auto">
                    <button type="submit" class="form-control" >Login</button>
                </div>
            </div>
        </form>
    </div>
