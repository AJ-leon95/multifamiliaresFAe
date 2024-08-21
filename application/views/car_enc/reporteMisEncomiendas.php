<script>
    $("#menu_encomiendas").addClass("active");
</script>
<br>
<?php if ($carreras) { ?>
    <section class="content">
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h4>PETICIONES DE ENCOMIENDAS</h4>
                        </center>
                        <br>
                    </div>
                    <?php foreach ($carreras as $index => $registro) { ?>
                        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <strong>Fecha:</strong> <?php echo $registro->fecha_carrera ?><br>
                                            <strong>Hora:</strong> <?php echo $registro->hora_carrera ?><br>
                                            <strong>Solicitado por:</strong> <?php echo $registro->solicitante_nombres . " " . $registro->solicitante_apellidos ?><br>
                                            <strong>Teléfono:</strong> <?php echo $registro->solicitante_telefono ?><br>
                                            <strong>Distancia:</strong> <?php echo $registro->distancia . " km." ?><br>
                                        </div>
                                        <div class="col-6">
                                            <strong>Fecha de entrega:</strong> <?php echo $registro->fecha_entrega ?><br>
                                            <strong>Hora de entrega:</strong> <?php echo $registro->hora_entrega ?><br>
                                            <strong>Precio estimado:</strong> $<?php echo $registro->precio_carrera ?><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <center>
                                                <h6 class="text-uppercase" style="color: 
                                                    <?php 
                                                        switch ($registro->estadoCarrera) {
                                                            case "POR ACEPTAR":
                                                                echo 'darkblue';
                                                                break;
                                                            case "RECHAZADO":
                                                                echo 'green';
                                                                break;
                                                            case "FINALIZADO":
                                                                echo 'darkslategray';
                                                                break;
                                                            case "CANCELADO":
                                                                echo 'red';
                                                                break;
                                                            case "ACEPTADO":
                                                                echo '#2a9914';
                                                                break;
                                                            default:
                                                                echo 'black';
                                                        }
                                                    ?>">
                                                    <?php echo $registro->estadoCarrera ?>
                                                </h6>
                                            </center>
                                        </div>
                                    </div>
                                    <div id="misCarreras-<?php echo $index; ?>" style="width:100%; height:250px; border:2px solid black;" class="mt-3"></div>
                                    <div id="distancia-<?php echo $index; ?>" class="mt-2"></div>
                                    <div class="mt-2"><?php echo $registro->descripcion_encomienda ?></div>
                                </div>
                                <div class="card-footer">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <a class="btn btn-warning btn-block" href="<?php echo site_url("/Carerras_encomiendas_controller/Aceptar/$registro->id_car") ?>" role="button">Aceptar</a>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-success btn-block" onclick="openGoogleMaps(<?php echo $registro->latitud_carrera ?>, <?php echo $registro->longitud_carrera ?>, <?php echo $registro->latitud_entrega ?>, <?php echo $registro->longitud_entrega ?>)">Abrir en Google Maps</button><br>
                                            <br> <a class="btn btn-primary btn-block" href="<?php echo site_url("/Carerras_encomiendas_controller/Finalizado/$registro->id_car") ?>" role="button">Entregado</a>

                                        </div>
                                        <div class="col-4">
                                            <a class="btn btn-danger btn-block" href="<?php echo site_url("/Carerras_encomiendas_controller/Rechazar/$registro->id_car") ?>" role="button">Rechazar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } else { ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <div>
                            <i class="fas fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> <?php echo date('H:i:s') ?></span>
                                <h3 class="timeline-header"> Encomiendas </h3>
                                <div class="timeline-body">
                                    Buenas estimad@ <?php echo $this->session->userdata("conectado")->nombres; ?>, por el momento usted no cuenta con ningún pedido de servicio de encomiendas.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<script type="text/javascript">
    function initMaps() {
        console.log('initMaps se ha llamado correctamente');
        <?php foreach ($carreras as $index => $registro) { ?>
            var coordenada<?php echo $index; ?> = new google.maps.LatLng(-0.9180487872636021, -78.62032359810698);
            var misCarreras<?php echo $index; ?> = new google.maps.Map(
                document.getElementById('misCarreras-<?php echo $index; ?>'), {
                    center: coordenada<?php echo $index; ?>,
                    zoom: 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            );

            var coordenadaInicio = new google.maps.LatLng(<?php echo $registro->latitud_carrera ?>, <?php echo $registro->longitud_carrera ?>);
            var marcadorInicio = new google.maps.Marker({
                position: coordenadaInicio,
                title: "Salida",
                map: misCarreras<?php echo $index; ?>,
                icon: "<?php echo base_url('/assets/img/ubicacionNegro.png') ?>"
            });

            var coordenadaLlegada = new google.maps.LatLng(<?php echo $registro->latitud_entrega ?>, <?php echo $registro->longitud_entrega ?>);
            var marcadorLlegada = new google.maps.Marker({
                position: coordenadaLlegada,
                title: "Llegada",
                map: misCarreras<?php echo $index; ?>
            });

            var directionsService<?php echo $index; ?> = new google.maps.DirectionsService();
            var directionsRenderer<?php echo $index; ?> = new google.maps.DirectionsRenderer({
                map: misCarreras<?php echo $index; ?>
            });

            var request = {
                origin: coordenadaInicio,
                destination: coordenadaLlegada,
                travelMode: 'DRIVING'
            };

            directionsService<?php echo $index; ?>.route(request, function(result, status) {
                if (status == 'OK') {
                    directionsRenderer<?php echo $index; ?>.setDirections(result);
                    var distancia = result.routes[0].legs[0].distance.text;
                    document.getElementById('distancia-<?php echo $index; ?>').innerText = 'Distancia: ' + distancia;
                } else {
                    console.error('Directions request failed due to ' + status);
                }
            });
        <?php } ?>
    }

    function openGoogleMaps(latInicio, lngInicio, latLlegada, lngLlegada) {
        var url = 'https://www.google.com/maps/dir/?api=1&origin=' + latInicio + ',' + lngInicio + '&destination=' + latLlegada + ',' + lngLlegada + '&travelmode=driving';
        window.open(url, '_blank');
    }

    window.onload = initMaps;
</script>
