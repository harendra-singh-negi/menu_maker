<?php use App\Models\User\Product;use Carbon\Carbon;use Illuminate\Support\Facades\Auth; ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Copy</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'VT323', monospace;
        }

        .receipt-title {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .my-0 {
            margin-bottom: 0px;
            margin-top: 0px;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mt-0 {
            margin-top: 0px;
        }

        p, h1, h2, h3, h4, h5, h6 {
            margin: 0;
        }

        .cart-item .item {
            display: flex;
        }

        .cart-item .item .qty {
            margin-right: 29px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .order-summary {
            border-top: 1px dashed #000;
            padding-top: 15px;
        }

        .order-summary .info {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .order-summary .info.total {
            font-size: 24px;
        }
    </style>
</head>
<body>

<div>
    <div class="receipt-title">
        <h2 class="my-0"><?php echo e($userBs->website_title); ?></h2>
        <span class="my-0">(Kitchen Copy)</span>
        <p class="my-0"><?php echo e(Carbon::now()); ?></p>
    </div>

    <?php if(!empty($cart)): ?>
        <div id="cartTable">

            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $id = $item["id"];
                    $product = Product::query()->where('user_id', Auth::guard('web')->user()->id)->findOrFail($id);
                ?>
                <div class="cart-item">
                    <div class="item">
                        <div class="qty">
                            <?php echo e($item['qty']); ?> X
                        </div>
                        <div class="item-name">
                            <p class="text-white"><?php echo e(convertUtf8($item['name'])); ?></p>
                            <?php if(!empty($item["variations"])): ?>
                                <p><?php echo e(__("Variation")); ?>: <br>
                                    <?php
                                        $variations = $item["variations"];
                                    ?>
                                    <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vKey => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span
                                            class="text-capitalize"><?php echo e(str_replace("_"," ",$vKey)); ?>:</span> <?php echo e($variation["name"]); ?>

                                        <?php if(!$loop->last): ?>
                                            ,
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            <?php endif; ?>
                            <?php if(!empty($item["addons"])): ?>
                                <p>
                                    <?php echo e(__("Addons")); ?>:
                                    <?php
                                        $addons = $item["addons"];
                                    ?>
                                    <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($addon["name"]); ?>

                                        <?php if(!$loop->last): ?>
                                            ,
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    <?php endif; ?>
</div>

</body>
</html>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pos/partials/kitchen-copy.blade.php ENDPATH**/ ?>