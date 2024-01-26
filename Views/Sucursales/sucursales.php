<?php

    headerTienda($data);
    
	$banner = $data['page']['portada'];

	$idpagina = $data['page']['idpost'];

?>


<script>
    document.querySelector('header').classList.add('header-v4');
</script>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url(<?= $banner?>);">
		<h2 class="ltext-105 cl0 txt-center">
		<?= $data['page']['titulo']?>
		</h2>
</section>	

<!-- <section class="py-5 text-center">
    <div class="container">
        <p>Visitamos y Obten Los Mejores precios del Mercado, Cualquier artículo que necesitas para Vivir Mejor</p>
        <a href="" class="btn btn-info">VER PRODUCTO</a>
    </div>
</section> -->

<!-- <div class="py-5 bg-light">
    <div class="container">

       
        <div class="row">

            
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">

                    <img src="<?= media();?>/images/s1.jpg" alt="">

                <div class="card-body">
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis quibusdam rerum dolore ut. 
                        Laudantium mollitia aut numquam aperiam, illo, fugiat optio voluptatibus dicta eveniet itaque
                         voluptatem porro possimus esse in.
                    </p>

                    <p>Direción: Calle 28 de Julio Nro. 725 San Martin de Pangoa <br>
                        Telefono: 934027842 <br>
                        Correo: stiveroncal@gmail.com
                    </p>
                </div>

                </div>

            </div>

            
             <div class="col-md-4">
                <div class="card mb-4 box-shadow">

                    <img src="<?= media();?>/images/s2.jpg" alt="">

                <div class="card-body">
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis quibusdam rerum dolore ut. 
                        Laudantium mollitia aut numquam aperiam, illo, fugiat optio voluptatibus dicta eveniet itaque
                         voluptatem porro possimus esse in.
                    </p>

                    <p>Direción: Calle 28 de Julio Nro. 725 San Martin de Pangoa <br>
                        Telefono: 934027842 <br>
                        Correo: stiveroncal@gmail.com
                    </p>
                </div>

                </div>

            </div>

             <div class="col-md-4">
                <div class="card mb-4 box-shadow">

                    <img src="<?= media();?>/images/s1.jpg" alt="">

                <div class="card-body">
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis quibusdam rerum dolore ut. 
                        Laudantium mollitia aut numquam aperiam, illo, fugiat optio voluptatibus dicta eveniet itaque
                         voluptatem porro possimus esse in.
                    </p>

                    <p>Direción: Calle 28 de Julio Nro. 725 San Martin de Pangoa <br>
                        Telefono: 934027842 <br>
                        Correo: stiveroncal@gmail.com
                    </p>
                </div>

                </div>

            </div>

        </div>
    </div>
</div> -->


<?php

	if(viewPage($idpagina)){

		echo $data['page']['contenido'];

	}else{

?>
<div>
	<div class="container-fluid py-5 text-center">
		<img src="<?= media()?>/images/construction.png" alt="En Construcción">
		<h3>Estamos trabajando Para Usted.</h3>
	</div>
</div>
<?php

	}
	
	footerTienda($data);
 ?>