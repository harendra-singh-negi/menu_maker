<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px
            }
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        @media (min-width: 992px) {
            .col-lg-6 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%
            }

            .col-lg-12 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%
            }
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent
        }

        .table td,
        .table th {
            padding: 8px;
            vertical-align: top;
            border-top: 1px solid #dee2e6
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6
        }

        .table .table {
            background-color: #fff
        }

        .table-sm td,
        .table-sm th {
            padding: .3rem
        }

        .table-bordered {
            border: 1px solid #dee2e6
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05)
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, .075)
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar
        }

        .table-responsive>.table-bordered {
            border: 0
        }

        .bg-primary {
            background-color: #007bff !important
        }

        a.bg-primary:focus,
        a.bg-primary:hover,
        button.bg-primary:focus,
        button.bg-primary:hover {
            background-color: #0062cc !important
        }

        .text-center {
            text-align: center !important
        }
        .color-dark{
            color: #1e2021 !important;
        }
        .color-white{
            color: #fff !important;
        }
        .font-b{
            font-weight: bold !important;
        }
        .m-0{
            margin: 0 !important;
        }
        .p-0{
            padding: 0 !important;
        }
        .mb-0{
            margin-bottom: 0 !important;
        }
        .pb-0{
            padding-bottom: 0 !important;
        }
        .mt-0{
            margin-top: 0 !important;
        }
        .pt-0{
            padding-top: 0 !important;
        }
        .mb-10 {
            margin-bottom: 10px !important;
        }
        .mb-20{
            margin-bottom: 20px !important;
        }
        .pb-20{
            padding-bottom: 20px !important;
        }
        .pb-10{
            padding-bottom: 10px !important;
        }
        .mt-10 {
            margin-top: 10px !important;
        }
        .mt-20{
            margin-top: 20px !important;
        }
        .pt-20{
            padding-top: 20px !important;
        }
        .pt-10{
            padding-top: 10px !important;
        }
        .m-10{
            margin: 10px !important;
        }
        .mtb-10{
            margin-block: 10px !important;
        }
        .p-10{
            padding: 10px !important;
        }
        .ptb-10{
            padding-block: 10px !important;
        }
    </style>
</head>

<body>
    <div class="order-comfirmation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo text-center mb-20 pt-20">
                        <?php if($userBs->logo): ?>
                            <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_LOGO, $userBs->logo, $userBs)); ?>"
                                alt="">
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/restaurant/images/logo.png')); ?>" alt="Logo">
                        <?php endif; ?>
                    </div>
                    <div class="confirmation-message bg-primary p-0 mb-20">
                        <h2 class="text-center"><strong class="color-white"><?php echo e($keywords['ORDER INVOICE'] ?? __('ORDER INVOICE')); ?></strong>
                        </h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <h3><strong><?php echo e($keywords['Order Details'] ?? __('Order Details')); ?></strong></h3>
                            </div>
                            <table class="table table-striped">
                                <tbody>
                                    <?php if(!empty($order->token_no)): ?>
                                        <tr>
                                            <th scope="row"><?php echo e($keywords['Token No'] ?? __('Token No')); ?>:</th>
                                            <td>#<?php echo e($order->token_no); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th scope="row"><?php echo e($keywords['Order Number'] ?? __('Order Number')); ?>:</th>
                                        <td>#<?php echo e($order->order_number); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php echo e($keywords['Order Date'] ?? __('Order Date')); ?>:</th>
                                        <td><?php echo e($order->created_at->format('d-m-Y')); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php echo e($keywords['Serving Method'] ?? __('Serving Method')); ?>:
                                        </th>
                                        <td>
                                            <?php if(strtolower($order->serving_method) == 'on_table'): ?>
                                                <?php echo e($keywords['On Table'] ?? __('On Table')); ?>

                                            <?php elseif(strtolower($order->serving_method) == 'home_delivery'): ?>
                                                <?php echo e($keywords['Home Delivery'] ?? __('Home Delivery')); ?>

                                            <?php elseif(strtolower($order->serving_method) == 'pick_up'): ?>
                                                <?php echo e($keywords['Pick up'] ?? __('Pick up')); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php echo e($keywords['Payment Method'] ?? __('Payment Method')); ?>:
                                        </th>
                                        <td class="text-capitalize">
                                            <?php echo e($order->method); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><?php echo e($keywords['Payment Status'] ?? __('Payment Status')); ?>:
                                        </th>
                                        <td class="text-capitalize">
                                            <?php echo e($order->payment_status); ?>

                                        </td>
                                    </tr>
                                    <?php if(!empty($order->shipping_method)): ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Shipping Method'] ?? __('Shipping Method')); ?>:</th>
                                            <td class="text-capitalize">
                                                <?php echo e($order->shipping_method); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!empty($order->shipping_method)): ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Shipping Charge'] ?? __('Shipping Charge')); ?>:</th>
                                            <td class="text-capitalize">
                                                <span><?php echo e($userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : ''); ?></span>
                                                <?php echo e($order->shipping_charge); ?>

                                                <span><?php echo e($userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : ''); ?></span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th scope="row"><?php echo e($keywords['Grand Total'] ?? __('Grand Total')); ?>:</th>
                                        <td class="text-capitalize">
                                            <span><?php echo e($userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : ''); ?></span>
                                            <?php echo e($order->total); ?>

                                            <span><?php echo e($userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : ''); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <h3>
                                    <strong>
                                        <?php if($order->serving_method == 'home_delivery'): ?>
                                            <?php echo e($keywords['Billing Details'] ?? __('Billing Details')); ?>

                                        <?php else: ?>
                                            <?php echo e($keywords['Information'] ?? __('Information')); ?>

                                        <?php endif; ?>
                                    </strong>
                                </h3>
                            </div>
                            <table class="table table-striped">
                                <tbody>
                                    <?php if(!empty($order->billing_lname)): ?>
                                        <tr>
                                            <th scope="row"><?php echo e($keywords['Billing Name'] ?? __('Billing Name')); ?>:
                                            </th>
                                            <td><?php echo e($order->billing_fname); ?> <?php echo e($order->billing_lname); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!empty($order->billing_email)): ?>
                                        <tr>
                                            <th scope="row"><?php echo e($keywords['Billing Email'] ?? __('Billing Email')); ?>:
                                            </th>
                                            <td><?php echo e($order->billing_email); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!empty($order->billing_number)): ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Billing Number'] ?? __('Billing Number')); ?>:</th>
                                            <td><?php echo e($order->billing_number); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!empty($order->billing_address)): ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Billing Address'] ?? __('Billing Address')); ?>:</th>
                                            <td><?php echo e($order->billing_address); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!empty($order->billing_city)): ?>
                                        <tr>
                                            <th scope="row"><?php echo e($keywords['Billing City'] ?? __('Billing City')); ?>:
                                            </th>
                                            <td><?php echo e($order->billing_city); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!empty($order->billing_country)): ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Billing Country'] ?? __('Billing Country')); ?>:</th>
                                            <td><?php echo e($order->billing_country); ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if($order->serving_method == 'on_table'): ?>
                                        <?php if(!empty($order->table_number)): ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo e($keywords['Table Number'] ?? __('Table Number')); ?>:</th>
                                                <td><?php echo e($order->table_number); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if(!empty($order->waiter_name)): ?>
                                            <tr>
                                                <th scope="row"><?php echo e($keywords['Waiter Name'] ?? __('Waiter Name')); ?>:
                                                </th>
                                                <td><?php echo e($order->waiter_name); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($order->serving_method == 'pick_up'): ?>
                                        <?php if(!empty($order->pick_up_date)): ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo e($keywords['Pick up Date'] ?? __('Pick up Date')); ?>:</th>
                                                <td><?php echo e($order->pick_up_date); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if(!empty($order->pick_up_time)): ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo e($keywords['Pick up Time'] ?? __('Pick up Time')); ?>:</th>
                                                <td><?php echo e($order->pick_up_time); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if($order->serving_method == 'home_delivery'): ?>
                            <div class="col-lg-6">
                                <div>
                                    <h3><strong><?php echo e($keywords['Shipping Details'] ?? __('Shipping Details')); ?></strong>
                                    </h3>
                                </div>
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo e($keywords['Shipping Name'] ?? __('Shipping Name')); ?>:
                                            </th>
                                            <td><?php echo e($order->shipping_fname); ?> <?php echo e($order->shipping_lname); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Shipping Email'] ?? __('Shipping Email')); ?>:</th>
                                            <td><?php echo e($order->shipping_email); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Shipping Number'] ?? __('Shipping Number')); ?>:</th>
                                            <td><?php echo e($order->shipping_number); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Shipping Address'] ?? __('Shipping Address')); ?>:</th>
                                            <td><?php echo e($order->shipping_address); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?php echo e($keywords['Shipping City'] ?? __('Shipping City')); ?>:
                                            </th>
                                            <td><?php echo e($order->shipping_city); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <?php echo e($keywords['Shipping Country'] ?? __('Shipping Country')); ?>:</th>
                                            <td><?php echo e($order->shipping_country); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <h3><strong><?php echo e($keywords['Ordered Products'] ?? __('Ordered Products')); ?></strong></h3>
                            </div>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Title</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $order->orderitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th><?php echo e($key + 1); ?></th>
                                            <td>
                                                <h4><strong><?php echo e($item->title); ?></strong></h4>
                                                <?php
                                                    $variations = json_decode($item->variations, true);
                                                ?>
                                                <?php if(!empty($variations)): ?>
                                                    <p><strong><?php echo e($keywords['Variation'] ?? __('Variation')); ?>:</strong>
                                                        <br>
                                                        <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vKey => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span
                                                                class="text-capitalize"><?php echo e(str_replace('_', ' ', $vKey)); ?>:</span>
                                                            <?php echo e($variation['name']); ?>

                                                            <?php if(!$loop->last): ?>
                                                                ,
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php
                                                    $addons = json_decode($item->addons, true);
                                                ?>
                                                <?php if(!empty($addons)): ?>
                                                    <p>
                                                        <strong><?php echo e($keywords['Addons'] ?? __('Addons')); ?>:</strong>
                                                        <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($addon['name']); ?>

                                                            <?php if(!$loop->last): ?>
                                                                ,
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <p>
                                                    <strong><?php echo e($keywords['Product'] ?? __('Product')); ?>:</strong>
                                                    <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                                    <span><?php echo e((float) $item->product_price); ?></span>
                                                    <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                                </p>
                                                <?php if(is_array($variations)): ?>
                                                    <p>
                                                        <strong><?php echo e($keywords['Variation'] ?? __('Variation')); ?>:
                                                        </strong>
                                                        <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                                        <span><?php echo e((float) $item->variations_price); ?></span>
                                                        <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                                    </p>
                                                <?php endif; ?>
                                                <?php if(is_array($addons)): ?>
                                                    <p>
                                                        <strong><?php echo e($keywords['Addons'] ?? __('Addons')); ?>: </strong>
                                                        <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                                        <span><?php echo e((float) $item->addons_price); ?></span>
                                                        <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                                    </p>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($item->qty); ?></td>
                                            <td>
                                                <span><?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?></span>
                                                <?php echo e($item->total); ?>

                                                <span><?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pdf/product.blade.php ENDPATH**/ ?>