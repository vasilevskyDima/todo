<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="/view/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
</head>
<body>
<header data-bs-theme="dark">
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <?php if (!isset($_SESSION['user'])) { ?>
                <a href="/login" class="navbar-brand d-flex align-items-center">
                    <strong>Log in</strong>
                </a>
            <?php } else { ?>
                <a href="/login.out" class="navbar-brand d-flex align-items-center">
                    <strong>Log out</strong>
                </a>
            <?php } ?>
        </div>
    </div>
</header>