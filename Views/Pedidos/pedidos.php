<?php 

    headerAdmin($data); 

    // getModal('modalProductos',$data);
   
?>

    <!-- Activar el modal -->
    <div id="divModal"></div>

    
    <main class="app-content">
      <div class="app-title">
        <div>

          <!-- HEADER=> BOTON AGREGARA -->
          <h1><i class="fas fa-box"></i> <?= $data['page_title'];?> </h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>/pedidos"><?= $data['page_title'];?></a></li>
        </ul>
      </div>
    
      <!-- BODY => TABLAS   -->
      
      <!-- Tablas de DataTables -->
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablePedidos">
                  <thead>
                    <tr>

                      <th>ID</th>
                      <th>Ref. / Transacción</th>
                      <th>Fecha</th>
                      <th>Monto</th>
                      <th>Tipo Pago</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


    </main>
<!-- FOOTER  -->
<?php  footerAdmin($data); ?>