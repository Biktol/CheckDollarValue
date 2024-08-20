<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js" defer></script>
    <script src="../js/logs.js" defer></script>
    <script src="../vendor/datatables/datatables.min.js" defer></script>
    <link type="text/css" href="../vendor/datatables/datatables.min.css" rel="stylesheet">
    <link type="text/css" href="../vendor/datatables/DataTables-1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>Chequear Dólar BCV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;500;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet" />
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sb-admin-2.min.css">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="flex min-h-screen flex-col bg-gradient-to-r from-[#999393] to-[#1f63ac] text-white">
        <nav class="mx-auto flex w-full max-w-4xl items-center justify-between space-x-6 px-2 pt-3 mb-11">
            <div class="flex space-x-2">
                <img class="w-32 hidden md:block" src="../img/lla-logo-removebg-preview.png" alt="" />
                <img class="w-24 hidden md:block" src="../img/logo_venilac-removebg-preview.png" alt="" />
            </div>
            <div class="flex justify-end space-x-7">
                <a class="hover:underline" href="./index.php">Inicio</a>
                <a class="hover:underline" href="#">Registros</a>
            </div>
        </nav>

        <h1 class="text-center text-3xl font-bold md:text-5xl">
            Registro de precios.
        </h1>

        <div id="wrapper">
            <div id="content-wrapper" class="container mt-5 mb-24">
                <?php
                include_once '../database/connection.php';
                $object = new Connection();
                $connection = $object->Connect();

                $query = "SELECT value, date FROM logs";
                $result = $connection->prepare($query);
                $result->execute();
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                print("
            <table id='logTable' class='table table-bordered table-condensed shadow table-striped' style='width:100%'>
            <thead class='text-center'>
                    <tr>
                        <td>Valor</td>
                        <td>Fecha</td>
                    </tr>
                </thead>
                <tbody>");

                foreach ($data as $dat) {
                ?>
                    <tr>
                        <td><?php echo $dat['value'], " Bs."?></td>
                        <td><?php echo $dat['date'] ?></td>
                    </tr>
                <?php
                }
                print("
        </tbody>
        </table>
            ");
                ?>
            </div>
        </div>
    </div>
</body>

</html>