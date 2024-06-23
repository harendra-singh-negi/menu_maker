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
            font-size: 14px;
        }

        .order-summary {
            border-top: 1px dashed #000;
            padding-top: 15px;
        }

        .order-summary .info {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .order-summary .info.total {
            font-size: 18px;
        }

        .item-name {
            max-width: 190px;
        }

        .serving-method {
            position: absolute;
            border: 2px dashed #000000;
            font-size: 20px;
            font-weight: 500;
            padding: 2px 5px;
            transform: rotate(-54deg);
            top: 46px;
            left: 2px;
        }
    </style>
</head>
<body>

<div>
    <div class="receipt-title">
        <?php if(Session::has('pos_serving_method') && !empty(Session::get('pos_serving_method'))): ?>
            <div class="serving-method"><?php echo e(Session::get('pos_serving_method')); ?></div>
        <?php endif; ?>
        <h2 class="my-0"><?php echo e($userBs->website_title); ?></h2>
        <span class="my-0">(Customer Copy)</span>
        <?php
            $addresses = explode(PHP_EOL, $userBs->contact_address);
        ?>

        <p class="my-0" style="max-width: 200px; margin: 0 auto;"><?php echo e($addresses[0]); ?></p>
        <p class="my-0"><?php echo e(\Carbon\Carbon::now()); ?></p>
        <p class="my-0"><?php echo e(request()->getHttpHost()); ?></p>
    </div>

    <?php if(!empty($cart)): ?>
        <div id="cartTable">

            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $id = $item["id"];
                    $product = \App\Models\User\Product::findOrFail($id);
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
                                        <span class="text-capitalize"><?php echo e(str_replace("_"," ",$vKey)); ?>:</span> <?php echo e($variation["name"]); ?>

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
                    <div class="item-total">
                        <?php echo e($userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : ''); ?>

                        <?php echo e($item['total']); ?>

                        <?php echo e($userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : ''); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <div class="order-summary">
            <div class="info">
                <div>Subtotal:</div>
                <div>
                    <?php echo e($userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : ''); ?>

                    <?php echo e(posCartSubTotal()); ?>

                    <?php echo e($userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : ''); ?>

                </div>
            </div>
            <div class="info">
                <div>Tax:</div>
                <div>
                    +
                    <?php echo e($userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : ''); ?>

                    <?php echo e(posTax()); ?>

                    <?php echo e($userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : ''); ?>

                </div>
            </div>
            <div class="info">
                <div>Delivery Charge:</div>
                <div>
                    +
                    <?php echo e($userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : ''); ?>

                    <?php echo e(posShipping()); ?>

                    <?php echo e($userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : ''); ?>

                </div>
            </div>
            <div class="info total">
                <div>Total:</div>
                <div>
                    <?php echo e($userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : ''); ?>

                    <?php echo e(posCartSubTotal() + posTax() + posShipping()); ?>

                    <?php echo e($userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : ''); ?>

                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

</body>
</html>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pos/partials/customer-copy.blade.php ENDPATH**/ ?>