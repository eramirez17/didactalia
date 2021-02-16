
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="container">
            <!-- Titulo y encabezado del mapa-->
            <div class="row">
                <div class="col">
                    <h3>
                        Mapa: <?php echo e($mapas[0]['titulo']); ?>

                    </h3>

                    <h5>
                        <?php echo e($mapas[0]['subtitulo']); ?>

                    </h5>
                </div>
            </div>
            <!-- imagen del mapa-->
            <div class="row">
                <div class="col">
                    <img src="<?php echo e($mapas[0]['imagen']); ?>" class="img-fluid" alt="...">
                </div>
            </div>
            <!-- Detalles-->
              <div class="row">
                <div class="col">
                    Descripci&oacute;n:
                </div>
                <div class="col">
                    <p>
                        <?php echo e($mapas[0]['descripcion']); ?>

                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Localizaci&oacute;n:
                </div>
                <div class="col">
                    <h6>
                        Continente
                    </h6>
                    <p>
                        <a href="<?php echo e($mapas[0]['urlcontinente']); ?>" target="_blank">
                            <?php echo e($mapas[0]['continente']); ?>

                        </a>
                        
                    </p>
                    <h6>
                        Pa&iacute;s
                    </h6>
                    <p>
                        <a href="<?php echo e($mapas[0]['urlpais']); ?>" target="_blank">
                            <?php echo e($mapas[0]['pais']); ?>

                        </a>
                    </p>
                    <h6>
                        CCAA/Regi&oacute;n
                    </h6>
                    <p>
                        <a href="<?php echo e($mapas[0]['urlregion']); ?>" target="_blank">
                            <?php echo e($mapas[0]['region']); ?>

                        </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                  Tipo de Juego:
                </div>
                <div class="col">
                    <?php echo e($mapas[0]['tipojuego']); ?>

                </div>
              </div>
            </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\didactalia\resources\views/web/mapsdetalle.blade.php ENDPATH**/ ?>