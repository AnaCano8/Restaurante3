<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Iniciar Sesión | Zargastro Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Panel de administración para restaurante" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Estilos -->
    <link href="<?= baseUrl(); ?>/templates/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= baseUrl(); ?>/templates/assets/css/icons.min.css" rel="stylesheet" />
    <link href="<?= baseUrl(); ?>/templates/assets/css/app.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: rgb(227, 235, 248);
            color: #dfe6ed;
        }

        .card {
            background-color: #3a4555;
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
        }
		.account-logo-box img,
        .btn-login {
            transition: transform 0.3s ease;
        }

        .account-logo-box img:hover,
        .btn-login:hover {
            transform: scale(1.05);
        }

        .account-logo-box {
            background-color: #2f3a4a;
            padding: 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid #4d5a6b;
        }

        .account-logo-box img {
            max-height: 70px;
        }

        .form-control {
            background-color: #2f3a4a;
            border: 1px solid #4d5a6b;
            color: #dfe6ed;
            border-radius: 8px;
        }

        .form-control::placeholder {
            color: #aab4c1;
        }

        .form-control:focus {
            background-color: #2f3a4a;
            color: #fff;
            border-color: #4c9aff;
            box-shadow: none;
        }

        .btn-login {
            background-color: #4c9aff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
        }

        .btn-login:hover {
            background-color: #3b8de0;
        }

        .text-muted,
        .custom-control-label {
            color: #bfcad9 !important;
        }

        a {
            color: #4c9aff;
        }

        a:hover {
            color: #76b7ff;
        }
    </style>
</head>

<body>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="account-logo-box">
                        <img src="<?= baseUrl(); ?>/templates/assets/images/logonuevo.png" alt="Zargastro Logo">
                        <small>Inicia sesión para acceder al sistema</small>
                    </div>

                    <div class="card-body p-4">
                        <?= validation_list_errors(); ?>
                        <?php $errors = validation_errors(); ?>

                        <form method="post" action="<?= baseUrl(); ?>/SiginController/loginAuth">

                            <div class="form-group mb-3">
                                <label for="username">Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" value="<?= set_value('username'); ?>">
                                <?php if (isset($errors['username'])): ?>
                                    <small class="text-danger"><?= validation_show_error('username'); ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Introduce Contraseña" value="<?= set_value('password'); ?>">
                                <?php if (isset($errors['password'])): ?>
                                    <small class="text-danger"><?= validation_show_error('password'); ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group mb-3 d-flex justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label" for="checkbox-signin">Recuérdame</label>
                                </div>
                            </div>

                            <div class="form-group text-center mb-0">
                                <button class="btn btn-login btn-block" type="submit">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="<?= baseUrl(); ?>/templates/assets/js/vendor.min.js"></script>
</body>

</html>