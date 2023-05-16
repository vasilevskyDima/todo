<?php
include_once __DIR__ . '/header.php';
?>
    <main class="form-signin w-100 m-auto mt-5">
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                The password is wrong
            </div>
        <?php } ?>
        <form action="login.auth" method="post">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="user" value="" name="user">
                <label for="floatingInput">User</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                       name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
    </main>
<?php
include_once __DIR__ . '/footer.php';
?>