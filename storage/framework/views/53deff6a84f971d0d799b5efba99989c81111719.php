<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title">
            <?php if(request()->path() == 'user/table/reservations/all'): ?>
                All
            <?php elseif(request()->path() == 'user/table/reservations/pending'): ?>
                Pending
            <?php elseif(request()->path() == 'user/table/reservations/accepted'): ?>
                Accepted
            <?php elseif(request()->path() == 'user/table/reservations/rejected'): ?>
                Rejected
            <?php endif; ?>
            Table Reservations
        </h4>
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
                <a href="#">Table Reservations</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">
                    <?php if(request()->path() == 'user/table/reservations/all'): ?>
                        All
                    <?php elseif(request()->path() == 'user/table/reservations/pending'): ?>
                        Pending
                    <?php elseif(request()->path() == 'user/table/reservations/accepted'): ?>
                        Accepted
                    <?php elseif(request()->path() == 'user/table/reservations/rejected'): ?>
                        Rejected
                    <?php endif; ?>
                    Table Reservations
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-title">
                                <?php if(request()->path() == 'user/table/reservations/all'): ?>
                                    All
                                <?php elseif(request()->path() == 'table/reservations/pending'): ?>
                                    Pending
                                <?php elseif(request()->path() == 'user/table/reservations/accepted'): ?>
                                    Accepted
                                <?php elseif(request()->path() == 'user/table/reservations/rejected'): ?>
                                    Rejected
                                <?php endif; ?>
                                Table Reservations
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-danger float-right btn-md ml-4 d-none bulk-delete"
                                data-href="<?php echo e(route('user.bulk.delete.table.reservations')); ?>"><i
                                    class="flaticon-interface-5"></i> Delete</button>
                            <form action="<?php echo e(url()->current()); ?>" class="d-inline-block float-right">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($tables) == 0): ?>
                                <h3 class="text-center">NO RESERVATION REQUEST FOUND</h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="bulk-check" data-val="all">
                                                </th>

                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Details</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="bulk-check"
                                                            data-val="<?php echo e($reservation->id); ?>">
                                                    </td>
                                                    <td><?php echo e(convertUtf8($reservation->name)); ?></td>
                                                    <td><?php echo e(convertUtf8($reservation->email)); ?></td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                            data-target="#detailsModal<?php echo e($reservation->id); ?>"><i
                                                                class="fas fa-eye"></i> View</button>
                                                    </td>
                                                    <td>
                                                        <form id="statusForm<?php echo e($reservation->id); ?>" class="d-inline-block"
                                                            action="<?php echo e(route('user.status.table.reservations')); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="table_id"
                                                                value="<?php echo e($reservation->id); ?>">
                                                            <select
                                                                class="form-control  <?php if($reservation->status == 1): ?> bg-warning  <?php elseif($reservation->status == 2): ?> bg-success <?php elseif($reservation->status == 3): ?>  bg-danger <?php endif; ?>  "
                                                                name="status"
                                                                onchange="document.getElementById('statusForm<?php echo e($reservation->id); ?>').submit();">
                                                                <option value="1"
                                                                    <?php echo e($reservation->status == 1 ? 'selected' : ''); ?>>
                                                                    Pending</option>
                                                                <option value="2"
                                                                    <?php echo e($reservation->status == 2 ? 'selected' : ''); ?>>
                                                                    Accepted</option>
                                                                <option value="3"
                                                                    <?php echo e($reservation->status == 3 ? 'selected' : ''); ?>>
                                                                    Rejected</option>
                                                            </select>
                                                        </form>
                                                    </td>


                                                    <td>
                                                        <form class="deleteform d-inline-block"
                                                            action="<?php echo e(route('user.delete.table.reservations')); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="table_id"
                                                                value="<?php echo e($reservation->id); ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                                                <span class="btn-label">
                                                                    <i class="fas fa-trash"></i>
                                                                </span>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <?php if ($__env->exists('user.reservations.reservation-details')) echo $__env->make('user.reservations.reservation-details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="d-inline-block mx-auto">
                            <?php echo e($tables->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/reservations/reservations.blade.php ENDPATH**/ ?>