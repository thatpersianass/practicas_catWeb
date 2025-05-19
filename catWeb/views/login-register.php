<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../styles/style.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/7.css"> -->
</head>

<body>
    <div class="profile-photo">
        <img src="../img/usr_placeholder.webp" alt="user-pfp" class="usr-photo">
    </div>

    <div class="content">
        <div class="form-box active" id="login-form">
            <div class="title-content">
                <h1>Inicio de Sesión</h1>
            </div>
            <div class="form-content">
                <form method="POST">

                    <div class="data-insertion">
                        <label for="user">Usuario:</label>
                        <input type="text" name="user" placeholder="  Inserte su usuario..." required>

                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" placeholder="  Inserte su contraseña..." required>
                    </div>

                    <div class="bottom-buttons">
                        <input type="submit" value="Iniciar Sesión" class="button-primary">
                        <button class="button-secondary" onclick="showForm('register-form')">Registrarse</button>
                    </div>
            </div>
            </form>
        </div>

        <div class="form-box" id="register-form">
            <div class="title-content">
                <h1>Registrarse</h1>
            </div>
            <div class="form-content">
                <form method="POST">

                    <div class="data-insertion">
                        <label for="user">Nombre(s):</label>
                        <input type="text" name="user" placeholder="  Inserte su(s) nombre(s)..." required>

                        <label for="user">Primer apellido:</label>
                        <input type="text" name="user" placeholder="  Inserte su primer apellido..." required>

                        <label for="user">Segundo apellido:</label>
                        <input type="text" name="user" placeholder="  Inserte su segundo apellido..." required>

                        <label for="user">DNI:</label>
                        <input type="text" name="user" placeholder="  Inserte su DNI..." required>

                        <label for="user">Nombre de usuario:</label>
                        <input type="text" name="user" placeholder="  Inserte su usuario..." required>

                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" placeholder="  Inserte su contraseña..." required>
                    </div>

                    <div class="bottom-buttons">
                        <input type="submit" value="Registrarse" class="button-primary">
                        <button class="button-secondary" onclick="showForm('login-form')">Iniciar sesión</button>

                    </div>
                </form>
            </div>

        </div>

        <script type="text/javascript">
        function showForm(formId) {
            document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
            document.getElementById(formId).classList.add("active");
        }
        </script>
</body>

</html>