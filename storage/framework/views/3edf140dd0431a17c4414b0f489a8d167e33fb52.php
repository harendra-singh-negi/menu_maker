<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>



<?php $__env->startSection('styles'); ?>
    <style>
        @media  only screen and (max-width: 1500px) {
            .card-title {
                font-size: 15px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Order Details')); ?></h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="<?php echo e(route('user.dashboard')); ?>">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(url()->previous()); ?>"><?php echo e(__('Order Management')); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(url()->previous()); ?>"><?php echo e(__('Orders')); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(__('Details')); ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex justify-content-between">
                        <span><?php echo e(__('Order')); ?>  [ <?php echo e($order->order_number); ?> ]</span>
                        <?php if(!empty($order->token_no)): ?>
                            <span>Token No. <?php echo e($order->token_no); ?></span>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="payment-information">

                        <?php if(!empty($order->type)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Ordered From')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php if(strtolower($order->type) =='website'): ?>
                                        Website Menu
                                    <?php elseif(strtolower($order->type) =='qr'): ?>
                                        QR Menu
                                    <?php elseif(strtolower($order->type) =='pos'): ?>
                                        POS
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($order->serving_method)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Serving Method')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php if(strtolower($order->serving_method) == 'on_table'): ?>
                                        <?php echo e(__('On Table')); ?>

                                    <?php elseif(strtolower($order->serving_method) == 'home_delivery'): ?>
                                        <?php echo e(__('Home Delivery')); ?>

                                    <?php elseif(strtolower($order->serving_method) == 'pick_up'): ?>
                                        <?php echo e(__('Pick up')); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if($order->postal_code_status == 0): ?>

                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Shipping Method')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php if(!empty($order->shipping_method)): ?>
                                        <?php echo e($order->shipping_method); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php elseif($order->postal_code_status == 1): ?>

                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Postal Code')); ?> (Delivery Area) :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php if(!empty($order->postal_code)): ?>
                                        <?php echo e($order->postal_code); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Cart Total')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?> <?php echo e($order->coupon - $order->tax - $order->shipping_charge + $order->total); ?> <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                </div>
                            </div>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Discount')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?> <?php echo e($order->coupon); ?> <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Tax')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?> <?php echo e($order->tax); ?> <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>


                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Shipping Charge')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php if(!empty($order->shipping_charge)): ?>
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?> <?php echo e($order->shipping_charge); ?> <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                <?php else: ?>
                                    <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?>

                                    0 <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Total')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?> <?php echo e($order->total); ?> <?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Payment Gateway')); ?> :</strong>
                            </div>
                            <div class="col-lg-6 text-capitalize">
                                <?php echo e(convertUtf8($order->method)); ?>

                            </div>
                        </div>

                        <?php if(!empty($order->receipt)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Receipt')); ?> :</strong>
                                </div>
                                <div class="col-lg-6 text-capitalize">
                                    <a href="#" data-toggle="modal" data-target="#receiptModal">Show</a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Payment Status')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php if($order->payment_status =='Pending' || $order->payment_status == 'pending'): ?>
                                    <span class="badge badge-danger"><?php echo e(convertUtf8($order->payment_status)); ?>  </span>
                                <?php else: ?>
                                    <span class="badge badge-success"><?php echo e(convertUtf8($order->payment_status)); ?>  </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Order Status')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                    if($order->order_status == 'pending') {
                                        $badge = 'default';
                                    } elseif($order->order_status == 'received') {
                                        $badge = 'secondary';
                                    } elseif($order->order_status == 'preparing') {
                                        $badge = 'warning';
                                    } elseif($order->order_status == 'ready_to_pick_up') {
                                        $badge = 'primary';
                                    } elseif($order->order_status == 'picked_up') {
                                        $badge = 'info';
                                    } elseif($order->order_status == 'delivered') {
                                        $badge = 'success';
                                    } elseif($order->order_status == 'cancelled') {
                                        $badge = 'danger';
                                    } elseif($order->order_status == 'ready_to_serve') {
                                        $badge = 'white';
                                    } elseif($order->order_status == 'served') {
                                        $badge = 'light';
                                    }
                                ?>

                                <span
                                    class="badge badge-<?php echo e($badge); ?> text-capitalize"><?php echo e(convertUtf8(str_replace("_", " ", $order->order_status))); ?></span>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Complete')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php if(strtolower($order->completed) =='yes'): ?>
                                    <span class="badge badge-success"><?php echo e(__('Yes')); ?>  </span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?php echo e(__('No')); ?>  </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if($order->serving_method == 'home_delivery'): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Preferred Delivery Date')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e($order->delivery_date ? $order->delivery_date : '-'); ?>

                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Preferred Delivery Time Frame')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e($order->delivery_time_start); ?> - <?php echo e($order->delivery_time_end); ?>

                                </div>
                            </div>
                        <?php endif; ?>


                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Time')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php echo e($order->created_at); ?>

                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-lg-6">
                                <strong><?php echo e(__('Order Notes')); ?> :</strong>
                            </div>
                            <div class="col-lg-6">
                                <?php if(!empty($order->order_notes)): ?>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalNotes">
                                        Show
                                    </button>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </div>
                        </div>

                  
                        <div class="modal fade" id="modalNotes" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Order Notes</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo e($order->order_notes); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <?php if($order->serving_method == 'home_delivery' && $order->type != 'pos'): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title d-inline-block">Shipping Details</div>

                    </div>
                    <div class="card-body pt-5 pb-5">
                        <div class="payment-information">
                            <?php if(!empty($order->shipping_fname)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Name')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(convertUtf8($order->shipping_fname)); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($order->shipping_email)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Email')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(convertUtf8($order->shipping_email)); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($order->shipping_number)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Phone')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e($order->shipping_country_code); ?><?php echo e($order->shipping_number); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($order->shipping_city)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('City')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(convertUtf8($order->shipping_city)); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($order->shipping_address)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Address')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(convertUtf8($order->shipping_address)); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($order->shipping_country)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Country')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(convertUtf8($order->shipping_country)); ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>

        <?php endif; ?>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block">
                        <?php if($order->serving_method == 'home_delivery'): ?>
                            Billing Details
                        <?php else: ?>
                            Information
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="payment-information">
                        <?php if(!empty($order->billing_fname)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Name')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e(convertUtf8($order->billing_fname)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_email)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Email')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e(convertUtf8($order->billing_email)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_number)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Phone')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e($order->billing_country_code); ?><?php echo e($order->billing_number); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_city)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('City')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e(convertUtf8($order->billing_city)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_address)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Address')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e(convertUtf8($order->billing_address)); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($order->billing_country)): ?>
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Country')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php echo e(convertUtf8($order->billing_country)); ?>

                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($order->serving_method == 'on_table'): ?>
                            <?php if(!empty($order->table_number)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Table Number')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(convertUtf8($order->table_number)); ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <strong><?php echo e(__('Waiter Name')); ?> :</strong>
                                </div>
                                <div class="col-lg-6">
                                    <?php if(!empty($order->waiter_name)): ?>
                                        <?php echo e(convertUtf8($order->waiter_name)); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($order->serving_method == 'pick_up'): ?>
                            <?php if(!empty($order->pick_up_date)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Pick up Date')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(date("jS F, Y", strtotime($order->pick_up_date))); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($order->pick_up_time)): ?>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <strong><?php echo e(__('Pick up Time')); ?> :</strong>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php echo e(convertUtf8($order->pick_up_time)); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo e(__('Ordered Products')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive product-list">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Product')); ?></th>
                                <th><?php echo e(__('Product Title')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Total')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><img
                                            src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_FEATURED_IMAGE,$item->product->feature_image,$userBs)); ?>"
                                            alt="product" width="100">
                                    </td>
                                    <td>
                                        <strong class="mr-3"><?php echo e($item->productInfromation->title); ?></strong>
                                        <br>
                                        <?php
                                            $variations = json_decode($item->variations, true);
                                        ?>
                                        <?php if(!empty($variations)): ?>
                                            <strong class="mr-3"><?php echo e(__("Variation")); ?>:</strong>
                                            <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vKey => $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span
                                                    class="text-capitalize"><?php echo e(str_replace("_"," ",$vKey)); ?>:</span> <?php echo e($variation["name"]); ?>

                                                <?php if(!$loop->last): ?>
                                                    ,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <br>
                                        <?php endif; ?>
                                        <?php
                                            $addons = json_decode($item->addons, true);
                                        ?>
                                        <?php if(!empty($addons)): ?>
                                            <strong class="mr-3">Addons:</strong>
                                            <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($addon["name"]); ?>

                                                <?php if(!$loop->last): ?>
                                                    ,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong class="mr-2"><?php echo e(__("Product")); ?>:</strong>
                                        <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                        <span><?php echo e((float)$item->product_price); ?></span>
                                        <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                        <br>
                                        <?php if(is_array($variations)): ?>
                                            <strong class="mr-2"><?php echo e(__("Variation")); ?>: </strong>
                                            <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                            <span><?php echo e((float)$item->variations_price); ?></span>
                                            <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                            <br>
                                        <?php endif; ?>
                                        <?php if(is_array($addons)): ?>
                                            <strong class="mr-2"><?php echo e(__("Addons")); ?>: </strong>
                                            <?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?>

                                            <span><?php echo e((float)$item->addons_price); ?></span>
                                            <?php echo e($order->currency_code_position == 'right' ? $order->currency_code : ''); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->qty); ?></td>
                                    <td>
                                        <span><?php echo e($order->currency_code_position == 'left' ? $order->currency_code : ''); ?></span> <?php echo e($item->total); ?>

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

    <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Receipt Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?php echo e(Uploader::getImageUrl(Constant::WEBSITE_PRODUCT_RECEIPT,$order->receipt,$userBs)); ?>" alt="Receipt" width="200">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/product/order/details.blade.php ENDPATH**/ ?>