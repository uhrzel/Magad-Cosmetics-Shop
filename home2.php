<?php require_once('config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page">
    <script>
        start_loader()
    </script>
    <style>
        body {
            background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
            background-size: cover;
            background-repeat: no-repeat;
            backdrop-filter: contrast(1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        #page-title {
            text-shadow: 6px 4px 7px black;
            font-size: 3.5em;
            color: #fff4f4 !important;
            background: rgba(128, 128, 128, 0.3);
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }

        .account-box {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .box-container {
            display: grid;
            grid-template-columns: repeat(3, 150px);
            grid-gap: 20px;
            margin-top: 20px;
        }

        .box {
            width: 150px;
            height: 100px;
            background-color: #4CAF50;
            border: 2px solid black;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: white;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .box:hover {
            background-color: #45a049;
        }

        .box a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            text-align: center;
            width: 100%;
            /* Make link fill the box */
            height: 100%;
            /* Make link fill the box */
            display: flex;
            /* Flexbox for centering */
            justify-content: center;
            /* Center text */
            align-items: center;
            /* Center text */
        }

        .box i {
            font-size: 1.5em;
            margin-bottom: 5px;
        }

        /* Admin Box at Top Right Corner */
        #admin-box {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 150px;
            height: 100px;
            background-color: #4CAF50;
            border: 2px solid black;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        #admin-box a {
            text-decoration: none;
            color: white;
        }

        #admin-box:hover {
            background-color: #45a049;
        }
    </style>

    <h1 class="text-center text-white px-4 py-5" id="page-title"><b><?php echo $_settings->info('name') ?></b></h1>

    <div class="account-box">
        <div class="box-container">
            <div class="box">
                <i class="fas fa-user"></i>
                <a href="http://localhost/cosmetics-shop/">Customer</a>
            </div>
            <div class="box">
                <i class="fas fa-leaf"></i>
                <a href="http://localhost/cosmetics-shop/superadmin/login.php">Superadmin</a>
            </div>
            <div class="box">
                <i class="fas fa-user"></i>
                <a href="http://localhost/cosmetics-shop/staff/login.php">Staff</a>
            </div>
            <div id="box">
                <i class="fas fa-user-shield"></i>
                <a href="http://localhost/cosmetics-shop/admin/login.php">Admin</a>
            </div>

        </div>
    </div>



    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            end_loader();
        })
    </script>
</body>

</html>