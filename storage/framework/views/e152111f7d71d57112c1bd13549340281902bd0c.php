
<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Mapas de Didactalia</h1>
        <div class="container">
        <?php $__currentLoopData = $mapas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card">
              <img src="<?php echo e($mapa['imagen']); ?>"width="200" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo e($mapa['titulo']); ?></h5>
                <p class="card-text"><?php echo e($mapa['subtitulo']); ?></p>
                <a href="<?php echo e(route('maps.show',$mapa['link'])); ?>" class="btn btn-primary">Entrar</a>
              </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\didactalia\resources\views/web/maps.blade.php ENDPATH**/ ?>