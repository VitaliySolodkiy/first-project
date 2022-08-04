<nav class="navbar navbar-expand-lg sticky-top bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">First Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=contacts">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=upload">Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=galleries">Galleries</a>
                </li>

            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user']['login'];
                        } else {
                            echo 'Profile';
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '
                                <li><a class="dropdown-item" href="index.php?page=profile">User Profile</a></li>
                            <li><a class="dropdown-item" href="../pages/logout.php">Log Out</a></li>
                                ';
                        } else {
                            echo '
                            <li><a class="dropdown-item" href="index.php?page=signup">Sign Up</a></li>
                        <li><a class="dropdown-item" href="index.php?page=login">Login</a></li>
                            ';
                        }
                        ?>


                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>