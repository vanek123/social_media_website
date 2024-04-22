<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    @vite(['resources/css/admin.css'])
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img class="logo-image" src="" alt="">
            </div>
        </div>

        <span class="logo_name">Laragram</span>

        <div class="menu-items">
            <ul class="nav=links">
                <li>
                    <a href="#">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil uil-users-alt"></i>
                        <span class="link-name">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Like</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Comments</span>
                    </a>
                </li>
            </ul>

            <ul class="logout-mod">
                <li>
                    <a href="#">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">

                    </div>
                </li>
            </ul>

        </div>

    </nav>

    


</body>
</html>