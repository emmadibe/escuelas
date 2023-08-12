    <?php

        include "conexion.php";

        $sql ="SELECT * FROM docentes";
        $res = mysqli_query($link, $sql);
        $mostrar = mysqli_fetch_array($res);

    ?>
    
    <!-- --------------------------- MODAL EDITAR DOCENTE ------------------------------------->
    <div class="modal" tabindex="-1" id="modal_editar_docente">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title ">Editar docente!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            
                <form action="../acc/acc_editar_docente_2do_plano.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Usuario</label>
                        <input type="text" class="form-control" id="modal_editar_docente_docente" name="nombre" placeholder="Ej.: Emma" required>
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" id="modal_editar_docente_pass" name="contraseña" placeholder="<?php echo $mostrar["contraseña"]?>" required>
                    </div>
                    <div class="form-group">
                        <label for="rol_id">Rol</label>
                        <select class="form-control" name="rol_id" id="modal_editar_docente_rol">
                                <?php if(($mostrar["rol_id"]) == 1){ ?>
                                    <option value="1" selected>Administrador</option>
                                <?php}else{ ?>
                                    <option value="1">Administrador</option>
                                <?php } ?>
                                <?php if(($mostrar["rol_id"]) == 2){ ?>
                                    <option value="2" selected>Usuario</option>
                                <?php }else{ ?>
                                    <option value="2">Usuario</option>
                                <?php } ?>
                                    <!-- O sea, selecciono (selected) para que aparezca como mi primera opción el rol original del docente. Se estila que al usuario le aparezcan el valor original de sus datos al momento de editarlos. -->
                                    <!-- Ejemplo: Si el rol_id del docente es igual 1, como opción predeterminada aparecerá "Administrador"; sino, "Administrador" será una opción más, pero no aparecerá como predeterminado (selected) -->
                        </select>
                    </div>
                </form>
           

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a id="modal_editar_docente_guardar" class="btn btn-success">Guardar cambios</a>
            </div>
        </div>
        </div>
    </div>

                            <!-------------------------------------- FIN MODAL EDITAR DOCENTE ------------------------------------- -->
