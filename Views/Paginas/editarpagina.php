<?php  
        headerAdmin($data);
        
        $option = $data['infoPage']['status'];

        $fotoActual = $data['infoPage']['portada'];

        $fotoRemove = 0;  
        /* <img id="img" src="<?= media(); ?>/images/uploads/portada_categoria.png">*/ 

        $imgPortada = $fotoActual != "" ? '<img id="img" src="'.media()."/images/uploads/".$fotoActual.'">' : "";

        //Ruta de Pagina

        $pageRuta = base_url().'/'.$data['infoPage']['ruta'];

    ?>
    <main class="app-content">

 
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'];?>

          <?php if($_SESSION['permisosMod']['w']){ ?>

            <a href="<?= base_url()?>/paginas/crear" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Crear Página</a>  

          <?php } ?>
          </h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>/paginas">Páginas</a> | 
          <a href="<?= $pageRuta ?>" target="_blank"><i class="fa fas fa-globe" aria-hidden="true"></i> Ver Página</a> </li>
        </ul>
      </div>
    

      <!-- Tablas de DataTables -->
      <div class="row">
        <div class="col-md-12">
          <div class="tile">

          

          <form id="formPaginas" name="formPaginas" class="form-horizontal">
                <input type="hidden" id="idPost" name="idPost" value="<?= $data['infoPage']['idpost'] ?>">
                <input type="hidden" id="foto_actual" name="foto_actual" value="<?= $fotoActual ?>">
                <input type="hidden" id="foto_remove" name="foto_remove" value="<?= $fotoRemove ?>">
                
                <p class="text-primary">Los Campos con Asterisco(<span class="required">*</span>) son Obligatorios</p>

                <div class="row">

                    <!-- Fila 1 -->
                    <div class="col-md-10">

                        
                        <div class="form-group">
                            <label class="control-label">Titulo <span class="required">*</span></label>
                            <input class="form-control" name="txtTitulo" id="txtTitulo" value="<?= $data['infoPage']['titulo'] ?>" type="text" required="">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Contenido<span class="required">*</span></label>
                            <textarea class="form-control" id="txtContenido" name="txtContenido"><?= $data['infoPage']['contenido'] ?></textarea>
                            
                        </div>
                        

                    </div>

                    <!-- Fila 2 -->
                    <div class="col-md-2">

                        <div class="row">

                            <!-- Estado -->
                            <div class="form-group col-md-12">
                                
                                <label for="listStatus">Estado <span class="required">*</span></label>

                                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">

                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>

                                    </select>
                                
                            </div>

                        </div>

                        <!-- Botones -->
                        <div class="row">

                            <div class="form-group col-md-12">
                                <button  id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                            </div>
                          

                        </div>
                    

                    </div>

                </div>

                <!-- Galeria de Fotos Inicio -->
                <div class="tile-footer">

                  <div class="form-group col-md-12">

                    <div id="containerGallery">

                      <h4>Portada</h4>
                      <span>Tamaño Sugerido (1920px X 239px)</span>
                    

                    </div>

                    <hr>

                    <div id="containerImages">

                    <div class="photo">

                 

                        <div class="prevPhoto prevPortada">

                            <span class="delPhoto notBlock">X</span>
                            <label for="foto"></label>

                            <div>
                              <!-- <img id="img" src="<?= media(); ?>/images/uploads/portada_categoria.png"> -->

                              <?=   $imgPortada ?>
                            </div>

                        </div>

                        <div class="upimg">

                          <input type="file" name="foto" id="foto">

                        </div>

                        <div id="form_alert"> 

                        </div>

                      </div>

                    </div>

                  </div>

                </div>
                <!-- FIN Galeria Foto -->

                
          </form>


          </div>
        </div>
      </div>


    </main>

<?php  footerAdmin($data); ?>


<script>

  document.querySelector("#listStatus").value = <?= $option?>;

</script>