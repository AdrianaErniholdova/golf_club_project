<section class="membership-section section-padding" id="section_3">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center mx-auto mb-lg-5 mb-4" id="register">
                <h2><span>Membership</span> at Tiya</h2>
            </div>

            <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                <h4 class="mb-4 pb-lg-2">Membership Fees</h4>

                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th style="width: 34%;">Yearly Access</th>

                            <th style="width: 22%;">T1 $420</th>

                            <th style="width: 22%;">T2 $640</th>

                            <th style="width: 22%;">T3 $860</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <th scope="row" class="text-start">Golf Insurance</th>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">Club Facilities</th>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">Country Club</th>

                            <td>
                                <i class="bi-x-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">Weekend Seasonal</th>

                            <td>
                                <i class="bi-x-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">Premium Courses</th>

                            <td>
                                <i class="bi-x-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-x-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">Pro's Networking</th>

                            <td>
                                <i class="bi-x-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-x-circle-fill"></i>
                            </td>

                            <td>
                                <i class="bi-check-circle-fill"></i>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-5 col-12 mx-auto">
                <h4 class="mb-4 pb-lg-2">Please join us!</h4>
                <form action="auth/register.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                    <h4 class="text-white mb-4">Become a member</h4>

                    <div class="form-floating">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="">

                        <label for="floatingInput">Username</label>
                    </div>

                    <div class="form-floating">
                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">

                        <label for="floatingInput">Email address</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">

                        <label for="floatingInput">Password</label>
                    </div>
                    <?php if (isset($_SESSION['register_error'])): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($_SESSION['register_error']) ?>
                        </div>
                        <?php unset($_SESSION['register_error']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['register_success'])): ?>
                        <div class="alert alert-success text-center">
                            <?= htmlspecialchars($_SESSION['register_success']) ?>
                        </div>
                        <?php unset($_SESSION['register_success']); ?>
                    <?php endif; ?>
                    <button type="submit" class="form-control">Register</button>
            </div>
            </form>
        </div>

    </div>
    </div>
</section>