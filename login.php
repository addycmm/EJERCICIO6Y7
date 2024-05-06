<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdadriana";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['correo'];
    $password = $_POST['contrasenia'];
    $sql = "SELECT tipo FROM persona WHERE correo = '$username' AND contrasenia = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $tipo = $row['tipo'];
        $_SESSION['tipo'] = $tipo;
        if ($tipo == 'director bancario') {
            header('Location: admin.php');
            exit;
        } elseif ($tipo == 'Cliente') {
            header('Location: cliente.php');
            exit;
        }
    } else {
        $error_message = "Credenciales incorrectas.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Iniciar Sesión</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error_message)) echo "<p class='text-danger'>$error_message</p>"; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="correo">Usuario:</label>
                                <input type="text" id="correo" name="correo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="contrasenia">Contraseña:</label>
                                <input type="password" id="contrasenia" name="contrasenia" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
