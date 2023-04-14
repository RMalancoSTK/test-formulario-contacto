<?php

require_once('mail.php');

$status = '';

function validate($name, $email, $subject, $message)
{
    return !empty($name) && !empty($email) && !empty($subject) && !empty($message);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['Nombre'];
    $email = $_POST['email'];
    $subject = $_POST['Asunto'];
    $message = $_POST['Mensaje'];

    if (validate($name, $email, $subject, $message)) {
        $status = 'success';
        $response = '¡Mensaje enviado! Gracias por contactarnos.';

        $body = "Nombre: $name <br> Email: $email <br> Mensaje: $message";
        sendMail($subject, $body, $email, $name, true);
    } else {
        $status = 'error';
        $response = '¡Error! Por favor, complete el formulario y vuelva a intentarlo.';
        header("Location: index.php?status=$status&response=$response");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="border border-3 border-primary"></div>
                    <div class="card bg-white">
                        <div class="card-body p-5">
                            <form class="mb-3 mt-md-4" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <h2 class="fw-bold mb-2 text-uppercase ">Formulario de contacto</h2>
                                <p class=" mb-5">Por favor, rellene el siguiente formulario para contactar con nosotros.</p>
                                <div class="mb-3">
                                    <label for="email" class="form-label ">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="ingrese su email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="ingrese su nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Asunto" class="form-label">Asunto</label>
                                    <input type="text" class="form-control" name="Asunto" id="Asunto" placeholder="ingrese su asunto" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Mensaje" class="form-label">Mensaje</label>
                                    <textarea class="form-control" name="Mensaje" id="Mensaje" rows="3" placeholder="ingrese su mensaje" required></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                                <?php if ($status === 'success') : ?>
                                    <div class="alert alert-success mt-3" role="alert">
                                        <strong>¡Mensaje enviado!</strong> Gracias por contactarnos.
                                    </div>
                                <?php elseif ($status === 'error') : ?>
                                    <div class="alert alert-danger mt-3" role="alert">
                                        <strong>¡Error!</strong> Por favor, complete el formulario y vuelva a intentarlo.
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>