

<?php $__env->startSection('content'); ?>


    <section class="banner_favorite">
    </section>
    <!-- end banner -->
<?php 
?>
    <section>
        <div class="container section-margin-top">

            <div class="row">
                <?php $__currentLoopData = $favorite; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 col-xxs-12 mb-5">
                    <div class="tm-home-box-2">
                        <img src="<?php echo e(asset('')); ?>img/hotel/<?php echo e($value->image); ?>" alt="image" class="img-responsive">
                        <h3><?php echo e($value->name); ?></h3>
                        <div class="d-flex">
                            <div class="w-50">
                            <p class="tm-date"><?php
                                $date = date_create($value->created_at);
                                echo date_format($date, 'Y-m-d');
                                
                            ?></p>
                            </div>
                            <div class="w-50 text-right">
                                <div class="wrapper">
                                    <input name="ratingRadio" type="radio" id="st1" value="1" />
                                    <label for="st1"></label>
                                    <input name="ratingRadio" type="radio" id="st2" value="2" />
                                    <label for="st2"></label>
                                    <input name="ratingRadio" type="radio" id="st3" value="3" />
                                    <label for="st3"></label>
                                    <input name="ratingRadio" type="radio" id="st4" value="4" />
                                    <label for="st4"></label>
                                    <input name="ratingRadio" type="radio" id="st5" value="5" />
                                    <label for="st5"></label>
                                </div>
                            </div>

                        </div>
                        <div class="location">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?php echo e($value->address); ?> 
                        </div>
                        <div class="tm-home-box-2-container">
                        <div id="favorites" class="tm-home-box-2-link active"><i class="fa fa-heart tm-home-box-2-icon border-right"></i></div>
                            <a href="detail.html" class="tm-home-box-2-link"><span
                                    class="tm-home-box-2-description">Travel</span></a>
                            <a href="detail.html" class="tm-home-box-2-link"><i
                                    class="fa fa-edit tm-home-box-2-icon border-left"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <li><a href="#">&lt;</a></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&gt;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.index-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\training-php\resources\views/Frontend/layout/favorite/index.blade.php ENDPATH**/ ?>