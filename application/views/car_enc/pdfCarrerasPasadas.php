<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de mis carreras pasadas</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px; /* Reducir tamaño de fuente para ajustarse mejor */
        }

        .contenedor {
            position: relative;
            width: 100%;
            padding: 10px; /* Reducir padding */
        }

        .contenedor img {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 100px; /* Reducir tamaño de la imagen */
            height: 100px;
        }

        .contenedor .text {
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: right;
        }

        p {
            text-align: justify;
        }

        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            width: 100%;
        }

        table {
            width: 95%; /* Ancho máximo de la tabla */
            border-collapse: collapse;
            margin: auto;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px; /* Reducir padding */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1, h4 {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <?php foreach($empresa as $registro){ ?>
        <img src="<?php echo base_url("/uploads/empresa/$registro->logo_emp") ?>" alt="Logo">
        <div class="text">
            <center>
                <h4>
                    COOPERATIVA DE TAXIS <br><?php echo $registro->nombre ?><br>
                    RUC: <?php echo $registro->ruc ?><br>
                    Correo: <?php echo $registro->correo_emp ?><br>
                    Dirección: <?php echo $registro->direccion_emp ?><br>
                </h4>
            </center>
            <?php } ?>
        </div>
    </div>

    <center>
        <h1>Carreras pasadas a la fecha de<br> <?php $fecha_actual = date('Y-m-d'); echo $fecha_actual;  ?></h1>
    </center>
<br><br><br><br><br>
    <div class="table-container">
        <table>
            <thead>
            <tr>
                            <th>Fecha de creacion</th>
                            <th>Hora de creacion</th>
                            <th>Fecha de entrega</th>
                            <th>Hora de entrega</th>
                            <th>Servicio</th>
                            <th>distancia</th>
                            <th>Precio</th>
                            <th>Solicitante</th>
                            <th>Numero solicitante</th>
                            <th>estado de la carrera</th>
                        
                          
                        </tr>
            </thead>
            <tbody>
                <?php $cont = 1; foreach ($CarrerasPasadas as $registro) { ?>
                   
                        <tr>
                                <td><?php echo $registro->fecha_carrera ?></td>

                                <td><?php echo $registro->hora_carrera ?></td>
                                <td><?php echo $registro->fecha_entrega ?></td>
                                <td><?php echo $registro->hora_entrega ?></td>
                                <td><?php echo $registro->tipo_ce ?></td>
                                <td><?php echo $registro->distancia ?></td>
                                <td><?php echo $registro->precio_carrera ?></td>
                                <td><?php echo $registro->solicitante_nombres." ".$registro->solicitante_apellidos ?></td>
                                <td><?php echo $registro->solicitante_telefono ?></td>
                                <td><?php echo $registro->estadoCarrera ?></td>
                              
                            </tr>
             
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>
