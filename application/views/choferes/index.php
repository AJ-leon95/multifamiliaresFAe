<script>
    $("#menu_admin").addClass("active");
</script>
<br>
<?php if ($choferes) { ?>
    <div class="container">
        <div class="card card-warning">
            <div class="card-header">
                <center>

                    <h3 class="card-title">Lista de choferes generales</h3>
                </center>

                <div class="card-tools">
                    <button type="button" class="btn btn-dark" title="Collapse"> <!-- data-card-widget="collapse" -->
                        <i class="fas fa-plus"> <a href="<?php echo site_url("/choferes_controller/nuevoChofer") ?>" style="color: white;"> Nueva Chofer</a></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">

                <table class="table table-warning table-bordered table-striped table-hover" id="tbl">
                    <thead class="table-dark">
                        <tr>
                            <th>id</th>
                            <th>Foto</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>correo</th>
                            <th>cedula</th>
                            <th>Experiencia</th>
                            <th>Contraseñas</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Estado</th>
                           
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-warning">
                        <?php foreach ($choferes as $registro) { ?>

                            <tr>
                                <td><?php echo $registro->id_cho ?></td>

                                <td><?php if ($registro->foto_cho != "") { ?>
                                            <img src="<?php echo base_url("/uploads/chofer/$registro->foto_cho") ?>" alt="" style="border-radius: 80px; width:50px; height:60px"> <!--target="_blank" esta es para descargar  -->
                                            <!-- <h6  style="font-size: 8px;"><?php echo $registro->foto_cho ?></h6> -->
                                        <?php } else { ?>
                                            N/A
                                        <?php } ?>
                                    </td>
                                <td><?php echo $registro->nombres_cho ?></td>
                                <td><?php echo $registro->apellidos_cho ?></td>
                                <td><?php   echo $registro->correo_cho ?></td>
                                <td><?php echo $registro->cedula_cho  ?></td>
                                <td><?php echo $registro->experiencia_cho  ?></td>
                                <td><?php echo $registro->contrasenia_cho  ?></td>
                                <td><?php echo $registro->telefono_cho  ?></td>
                                <td><?php echo $registro->direccion_cho  ?></td>
                                <?php if($registro->estado_cho=="ACTIVO"){?>
                                <td style="color: green;"><?php echo $registro->estado_cho ?></td>
                                <?php } else{?>
                                    <td style="color: red;"><?php echo $registro->estado_cho ?></td>
                                    <?php  }  ?>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?php echo site_url("/choferes_controller/editarChofer/$registro->id_cho") ?>" title="Editar " class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo site_url("/choferes_controller/eliminarChofer/$registro->id_cho") ?>" title="Eliminar " class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <br>
        </div>
    <?php } else { ?>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Información: </h5>
                            <div class="card-tools d-flex justify-content-end">
                                <button type="button" class="btn btn-dark" title="Collapse">
                                    <a href="<?php echo site_url("/choferes_controller/nuevoChofer") ?>" style="color: white;">Nueva Chofer</a>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                            Actualmente no existen choferes en la base de datos.
                        </div>


                        <!-- Main content -->

                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    <?php } ?>

    <script type="text/javascript">
        $("#tbl")
            .DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }

                },
                responsive: true

            });
    </script>