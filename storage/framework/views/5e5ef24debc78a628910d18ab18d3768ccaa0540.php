<?php
    use App\Models\User\Product;
    use Illuminate\Support\Facades\Auth;
?>


<?php $__env->startSection('sidebar', 'overlay-sidebar'); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/calculator.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row" id="outsidePrintScreen">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-12 px-0">
                            <form>
                                <div class="form-group pt-0">
                                    <input name="search" type="text" class="form-control"
                                        placeholder="Search by Item Name here...">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="posCatItems" style="display: block;">
                        <?php if ($__env->exists('user.pos.partials.cats-items')) echo $__env->make('user.pos.partials.cats-items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div id="posItems" style="display: none;">
                        <?php if ($__env->exists('user.pos.partials.items')) echo $__env->make('user.pos.partials.items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body px-2">
                            <form id="ajaxForm" action="<?php echo e(route('user.pos.placeOrder')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group p-0 pb-2">
                                    <div class="ui-widget">
                                        <label for="">Customer Phone</label>
                                        <input class="form-control" type="text" name="customer_phone"
                                            placeholder="Customer Phone Number" value="<?php echo e(old('customer_phone')); ?>"
                                            onchange="loadCustomerName(this.value)">
                                        <p class="text-warning mb-0">Use <strong>Country Code</strong> in phone number
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group p-0 pb-2">
                                    <div class="ui-widget">
                                        <label for="">Customer Name</label>
                                        <input class="form-control" name="customer_name" type="text"
                                            placeholder="Customer Name" value="<?php echo e(old('customer_name')); ?>" disabled>
                                        <small class="text-warning">Enter customer phone first.</small>
                                    </div>
                                </div>
                                <div class="form-group p-0 pb-2">
                                    <div class="ui-widget">
                                        <label for="">Customer Email</label>
                                        <input class="form-control" name="customer_email" type="email"
                                            placeholder="Customer Email" value="<?php echo e(old('customer_email')); ?>" disabled>
                                        <small class="text-warning">Enter customer email first.</small>
                                    </div>
                                </div>
                                <div class="form-group p-0 pb-2">
                                    <label for="">Serving Method **</label>
                                    <select class="form-control" name="serving_method" required>
                                        <?php $__currentLoopData = $smethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($packagePermissions) && in_array($smethod->name, $packagePermissions)): ?>
                                                <option value="<?php echo e($smethod->value); ?>"
                                                    <?php echo e($smethod->value == old('serving_method') ? 'selected' : ''); ?>>
                                                    <?php echo e($smethod->name); ?>

                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group p-0 pb-2">
                                    <label for="">Payment Method </label>
                                    <select class="form-control select2" name="payment_method">
                                        <option value="" selected disabled>Select Payment Method</option>
                                        <?php $__currentLoopData = $pmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pmethod->name); ?>"
                                                <?php echo e($pmethod->name == old('payment_method') ? 'selected' : ''); ?>>
                                                <?php echo e($pmethod->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group p-0 pb-2">
                                    <label for="">Payment Status **</label>
                                    <select class="form-control" name="payment_status" required>
                                        <option value="Pending" <?php echo e('Pending' == old('payment_status') ? 'selected' : ''); ?>>
                                            Pending
                                        </option>
                                        <option value="Completed"
                                            <?php echo e('Completed' == old('payment_status') ? 'selected' : ''); ?>>
                                            Completed
                                        </option>
                                    </select>
                                </div>
                                <div id="on_table" class="d-none extra-fields">
                                    <div class="form-group p-0 pb-2">
                                        <label for="">Table No</label>
                                        <select class="form-control select2" name="table_no">
                                            <option value="" selected disabled>Select Table No</option>
                                            <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($table->table_no); ?>"
                                                    <?php echo e($table->table_no == old('table_no') ? 'selected' : ''); ?>>
                                                    Table - <?php echo e($table->table_no); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="pick_up" class="d-none extra-fields">
                                    <div class="form-group p-0 pb-2">
                                        <label for="">Pickup Date</label>
                                        <input name="pick_up_date" type="text" class="form-control pickupdatepicker"
                                            placeholder="Pickup Date" autocomplete="off">
                                    </div>
                                    <div class="form-group p-0 pb-2">
                                        <label for="">Pickup Time</label>
                                        <input name="pick_up_time" type="text" class="form-control timepicker"
                                            placeholder="Pickup Time" autocomplete="off">
                                    </div>
                                </div>

                                <div id="home_delivery" class="d-none extra-fields">
                                    <?php if($userBe->delivery_date_time_status == 1): ?>
                                        <div class="form-group p-0 pb-2">
                                            <label>Delivery Date <?php echo e($userBe->delivery_date_time_required == 1 ? '*' : ''); ?>

                                            </label>
                                            <div
                                                class="field-input cross <?php echo e(!empty(old('delivery_date')) ? 'cross-show' : ''); ?>">
                                                <input class="form-control delivery-datepicker" type="text"
                                                    name="delivery_date" autocomplete="off"
                                                    value="<?php echo e(old('delivery_date')); ?>">
                                                <i class="far fa-times-circle"></i>
                                            </div>
                                        </div>
                                        <div class="form-group p-0 pb-2">
                                            <label>Delivery Time
                                                <?php echo e($userBe->delivery_date_time_required == 1 ? '*' : ''); ?></label>
                                            <select id="deliveryTime" class="form-control" name="delivery_time" disabled>
                                                <option value="" selected disabled>Select a time frame</option>
                                            </select>
                                        </div>
                                    <?php endif; ?>

                                    <div id="shippingPostCharges">
                                        <?php if(
                                            $userBs->postal_code == 0 ||
                                                (is_array($packagePermissions) && !in_array('Postal Code Based Delivery Charge', $packagePermissions))): ?>

                                            <?php if(count($scharges) > 0): ?>
                                                <div id="shippingCharges" class="form-group p-0 pb-2">
                                                    <label><?php echo e(__('Shipping Charges')); ?></label>
                                                    <?php $__currentLoopData = $scharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="form-check p-0 pl-4">
                                                            <input class="form-check-input" type="radio"
                                                                data="<?php echo e(!empty($scharge->free_delivery_amount) && posCartSubTotal() >= $scharge->free_delivery_amount ? 0 : $scharge->charge); ?>"
                                                                name="shipping_charge" id="scharge<?php echo e($scharge->id); ?>"
                                                                value="<?php echo e($scharge->id); ?>"
                                                                <?php echo e($loop->first ? 'checked' : ''); ?>

                                                                data-free_delivery_amount="<?php echo e($scharge->free_delivery_amount); ?>">
                                                            <label class="form-check-label mb-0"
                                                                for="scharge<?php echo e($scharge->id); ?>"><?php echo e($scharge->title); ?></label>
                                                            +
                                                            <strong>
                                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e($scharge->charge); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                            </strong>
                                                        </div>

                                                        <?php if(!empty($scharge->free_delivery_amount)): ?>
                                                            <p class="mb-0 pl-2">(<?php echo app('translator')->get('Free Delivery for Orders over'); ?>
                                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e($scharge->free_delivery_amount - 1); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                                )</p>
                                                        <?php endif; ?>
                                                        <p class="mb-0 text-warning pl-2">
                                                            <small><?php echo e($scharge->text); ?></small>
                                                        </p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="form-group p-0 pb-2">
                                                <label><?php echo e(__('Postal Code')); ?> (Delivery Area)</label>
                                                <select name="postal_code" class="select2 form-control">
                                                    <?php $__currentLoopData = $postcodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postcode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($postcode->id); ?>"
                                                            data="<?php echo e($postcode->charge); ?>"
                                                            data-free_delivery_amount="<?php echo e($postcode->free_delivery_amount); ?>">
                                                            <?php if(!empty($postcode->title)): ?>
                                                                <?php echo e($postcode->title); ?> -
                                                            <?php endif; ?>
                                                            <?php echo e($postcode->postcode); ?>


                                                            (<?php echo e(__('Delivery Charge')); ?>

                                                            -
                                                            <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e($postcode->charge); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                            <?php if(!empty($postcode->free_delivery_amount)): ?>
                                                                , <?php echo app('translator')->get('Free Delivery for Orders over'); ?>
                                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?><?php echo e($postcode->free_delivery_amount - 1); ?><?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                            <?php endif; ?>)
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="card-footer text-center">
                            <button id="submitBtn" class="btn btn-success" type="button">Place Order</button>
                            <?php if(!empty($onTable) && $onTable->pos == 1): ?>
                                <p class="mb-0 text-warning">Token No. print option (for '<?php echo e($onTable->name); ?>' orders)
                                    will be shown after placing order.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4>Ordered Foods</h4>
                                </div>
                            </div>


                            <div id="divRefresh">
                                <?php if(empty($cart)): ?>
                                    <div class="text-center py-5 mt-4">
                                        <h4>NO ITEMS ADDED</h4>
                                    </div>
                                <?php else: ?>
                                    <div id="cartTable">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Price
                                                        (<?php echo e($userBe->base_currency_symbol); ?>)
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $id = $item['id'];
                                                        $user = getRootUser();
                                                        $product = Product::query()
                                                            ->where('user_id', $user->id)
                                                            ->findOrFail($id);
                                                    ?>
                                                    <tr class="cart-item">
                                                        <td width="55%" class="item">
                                                            <h5>
                                                                <?php echo e(strlen($item['name']) > 27 ? mb_substr($item['name'], 0, 27, 'UTF-8') . '...' : $item['name']); ?>


                                                            </h5>
                                                            <?php if(!empty($item['variations'])): ?>
                                                                <p><strong><?php echo e(__('Variation')); ?>:</strong>
                                                                    <br>
                                                                    <?php
                                                                        $variations = $item['variations'];
                                                                    ?>
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

                                                            <?php if(!empty($item['addons'])): ?>
                                                                <p>
                                                                    <strong><?php echo e(__('Addons')); ?>:</strong>
                                                                    <?php
                                                                        $addons = $item['addons'];
                                                                    ?>
                                                                    <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php echo e($addon['name']); ?>

                                                                        <?php if(!$loop->last): ?>
                                                                            ,
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </p>
                                                            <?php endif; ?>
                                                            <i class="fas fa-times text-danger item-remove"
                                                                data-href="<?php echo e(route('user.cart.item.remove', $key)); ?>"></i>
                                                        </td>
                                                        <td width="25%"
                                                            style="padding-left: 0 !important;padding-right: 0 !important;">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text sub decreaseQty"
                                                                        data-key="<?php echo e($key); ?>">
                                                                        <i class="fas fa-minus"></i>
                                                                    </span>
                                                                </div>
                                                                <input name="quantity" type="number"
                                                                    class="form-control" value="<?php echo e($item['qty']); ?>"
                                                                    data-key="<?php echo e($key); ?>">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text add increaseQty"
                                                                        data-key="<?php echo e($key); ?>">
                                                                        <i class="fas fa-plus"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="20%">
                                                            <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                            <?php echo e($item['total']); ?>

                                                            <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Subtotal
                                            <span>
                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                <span id="subtotal"><?php echo e(posCartSubTotal()); ?></span>
                                                <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Tax
                                            <span>
                                                +
                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                <span id="tax"><?php echo e(posTax()); ?></span>
                                                <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Shipping Charge
                                            <span>
                                                +
                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                <span id="shipping"><?php echo e(posShipping()); ?></span>
                                                <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                            </span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-primary text-white">
                                            <strong>Total</strong>
                                            <span>
                                                <?php echo e($userBe->base_currency_symbol_position == 'left' ? $userBe->base_currency_symbol : ''); ?>

                                                <span
                                                    class="grandTotal"><?php echo e(posCartSubTotal() + posTax() + posShipping()); ?></span>
                                                <?php echo e($userBe->base_currency_symbol_position == 'right' ? $userBe->base_currency_symbol : ''); ?>

                                            </span>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <div class="row no-gutters">
                                <div class="col-lg-4">
                                    <button id="calcModalBtn" type="button" class="btn btn-primary btn-block"
                                        data-toggle="tooltip" data-placement="bottom" title="Calculator">
                                        <i class="fas fa-calculator"></i>
                                        Calculator
                                    </button>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-success btn-block" id="printBtn">Print Receipt</button>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-danger btn-block" id="clearCartBtn">Clear Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

   
    <div class="modal fade" id="calcModal" tabindex="-1" role="dialog" aria-labelledby="calcModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Calculator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <form>
                            <input readonly id="display1" type="text" class="form-control-lg text-right">
                            <input readonly id="display2" type="text" class="form-control-lg text-right">
                        </form>

                        <div class="d-flex justify-content-between button-row">
                            <button id="left-parenthesis" type="button" class="operator-group">&#40;</button>
                            <button id="right-parenthesis" type="button" class="operator-group">&#41;</button>
                            <button id="square-root" type="button" class="operator-group">&#8730;</button>
                            <button id="square" type="button" class="operator-group">&#120;&#178;</button>
                        </div>

                        <div class="d-flex justify-content-between button-row">
                            <button id="clear" type="button">&#67;</button>
                            <button id="backspace" type="button">&#9003;</button>
                            <button id="ans" type="button" class="operand-group">&#65;&#110;&#115;</button>
                            <button id="divide" type="button" class="operator-group">&#247;</button>
                        </div>


                        <div class="d-flex justify-content-between button-row">
                            <button id="seven" type="button" class="operand-group">&#55;</button>
                            <button id="eight" type="button" class="operand-group">&#56;</button>
                            <button id="nine" type="button" class="operand-group">&#57;</button>
                            <button id="multiply" type="button" class="operator-group">&#215;</button>
                        </div>


                        <div class="d-flex justify-content-between button-row">
                            <button id="four" type="button" class="operand-group">&#52;</button>
                            <button id="five" type="button" class="operand-group">&#53;</button>
                            <button id="six" type="button" class="operand-group">&#54;</button>
                            <button id="subtract" type="button" class="operator-group">&#8722;</button>
                        </div>


                        <div class="d-flex justify-content-between button-row">
                            <button id="one" type="button" class="operand-group">&#49;</button>
                            <button id="two" type="button" class="operand-group">&#50;</button>
                            <button id="three" type="button" class="operand-group">&#51;</button>
                            <button id="add" type="button" class="operator-group">&#43;</button>
                        </div>

                   
                        <label class="switch" style="display: none;">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <div class="d-flex justify-content-between button-row">
                            <button id="percentage" type="button" class="operand-group">
                              

                            </button>
                            <button id="zero" type="button" class="operand-group">&#48;</button>
                            <button id="decimal" type="button" class="operand-group">&#46;</button>
                            <button id="equal" type="button">&#61;</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php if ($__env->exists('user.pos.variation-modal')) echo $__env->make('user.pos.variation-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  

    <div id="customerCopy">
        <iframe id="customerReceipt" src="<?php echo e(url('user/print/customer-copy')); ?>" style="display:none;"></iframe>
    </div>
    <div id="kitchenCopy">
        <iframe id="kitchenReceipt" src="<?php echo e(url('user/print/kitchen-copy')); ?>" style="display:none;"></iframe>
    </div>
    <div id="tokenNo">
        <iframe id="tokenNoPrintable" src="<?php echo e(url('user/print/token-no')); ?>" style="display:none;"></iframe>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
    <script src="<?php echo e(asset('assets/admin/js/plugin/math.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/plugin/calculator/calculator.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/plugin/printthis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/front/js/plugin.min.js')); ?>"></script>


    <?php if(
        !empty($onTable) &&
            $onTable->pos == 1 &&
            Session::has('success') &&
            Session::has('previous_serving_method') &&
            Session::get('previous_serving_method') == 'on_table'): ?>
        <script>
            var tokenFrame = document.getElementById("tokenNoPrintable");
            tokenFrame.focus();
            tokenFrame.contentWindow.print();
        </script>
    <?php endif; ?>

      <script>
    const postalCode = "<?php echo e($userBs->postal_code); ?>";
        let getServingMethod = "";
        var cartRoute = "<?php echo e(route('user.cart.clear')); ?>";
        var timeFramesRoute = "<?php echo e(route('user.pos.timeframes')); ?>";
        var shippingChargeRoute = "<?php echo e(route('user.pos.shippingCharge')); ?>";
    </script>
    <script src="<?php echo e(asset('assets/tenant/js/pos.js')); ?>"></script>
  

    <script>
        var textPosition = "<?php echo e($userBe->base_currency_text_position); ?>";
        var currText = "<?php echo e($userBe->base_currency_text); ?>";
        var posAudio = new Audio("<?php echo e(asset('assets/front/files/beep-07.mp3')); ?>");
        var select = "<?php echo e(__('Select')); ?>";
    </script>
   
    <script src="<?php echo e(asset('assets/admin/js/cart.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/pos/index.blade.php ENDPATH**/ ?>