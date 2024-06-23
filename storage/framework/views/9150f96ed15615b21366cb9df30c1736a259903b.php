<?php $__env->startSection('content'); ?>
<div class="page-header">
   <h4 class="page-title">Plugins</h4>
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
         <a href="#">Settings</a>
      </li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
         <a href="#">Plugins</a>
      </li>
   </ul>
</div>
<div class="row">
   <div class="col-lg-12">
         <div class="row">
            <?php if(!empty($features) && in_array('Live Orders',$features) || in_array('Call Waiter',$features)): ?>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Pusher Setup</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.pusher.update')); ?>" method="POST" id="pusherForm">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label>Pusher App ID</label>
                                 <input class="form-control" name="pusher_app_id" value="<?php echo e($userBe->pusher_app_id); ?>">
                                 <?php if($errors->has('pusher_app_id')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('pusher_app_id')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Pusher App key</label>
                                 <input class="form-control" name="pusher_app_key" value="<?php echo e($userBe->pusher_app_key); ?>">
                                 <?php if($errors->has('pusher_app_key')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('pusher_app_key')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Pusher App Secret</label>
                                 <input class="form-control" name="pusher_app_secret" value="<?php echo e($userBe->pusher_app_secret); ?>">
                                 <?php if($errors->has('pusher_app_secret')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('pusher_app_secret')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Pusher App Cluster</label>
                                 <input class="form-control" name="pusher_app_cluster" value="<?php echo e($userBe->pusher_app_cluster); ?>">
                                 <?php if($errors->has('pusher_app_cluster')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('pusher_app_cluster')); ?></p>
                                 <?php endif; ?>
                                 <p class="text-warning mb-0">Pusher credentials needed for Realtime notification after <strong class="text-warning">new order & call waiter</strong> in your Dashboard  with sound</p>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button type="submit" form="pusherForm" class="btn btn-success">Update</button>
                  </div>
               </div>
            </div>
            <?php else: ?>
            <?php endif; ?>

           <?php if(!empty($features) && in_array('Online Order',$features)): ?>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Facebook Login</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.fblogin.update')); ?>" id="fbLoginForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label>Status</label>
                                 <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_facebook_login" value="1" class="selectgroup-input" <?php echo e($userBe->is_facebook_login == 1 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_facebook_login" value="0" class="selectgroup-input" <?php echo e($userBe->is_facebook_login == 0 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Deactive</span>
                                    </label>
                                 </div>
                                 <?php if($errors->has('is_facebook_login')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('is_facebook_login')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Facebook App ID</label>
                                 <input class="form-control" name="facebook_app_id" value="<?php echo e($userBe->facebook_app_id); ?>">
                                 <?php if($errors->has('facebook_app_id')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('facebook_app_id')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Facebook App Secret</label>
                                 <input class="form-control" name="facebook_app_secret" value="<?php echo e($userBe->facebook_app_secret); ?>">
                                 <?php if($errors->has('facebook_app_secret')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('facebook_app_secret')); ?></p>
                                 <?php endif; ?>
                                 <p class="text-warning mb-0">Facebook App ID & App Secret are required for Facebook Login.</p>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button class="btn btn-success" type="submit" form="fbLoginForm">Update</button>
                  </div>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Google Login</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.googlelogin.update')); ?>" method="POST" id="googleLoginForm">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label>Status</label>
                                 <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_google_login" value="1" class="selectgroup-input" <?php echo e($userBe->is_google_login == 1 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_google_login" value="0" class="selectgroup-input" <?php echo e($userBe->is_google_login == 0 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Deactive</span>
                                    </label>
                                 </div>
                                 <?php if($errors->has('is_google_login')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('is_google_login')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Google Client ID</label>
                                 <input class="form-control" name="google_client_id" value="<?php echo e($userBe->google_client_id); ?>">
                                 <?php if($errors->has('google_client_id')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('google_client_id')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Google Client Secret</label>
                                 <input class="form-control" name="google_client_secret" value="<?php echo e($userBe->google_client_secret); ?>">
                                 <?php if($errors->has('google_client_secret')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('google_client_secret')); ?></p>
                                 <?php endif; ?>
                                 <p class="text-warning mb-0">Google Client ID & Client Secret are required for Google Login.</p>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button type="submit" class="btn btn-success" form="googleLoginForm">Update</button>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <?php if(!empty($features) && in_array('Whatsapp Order & Notification',$features) ): ?>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Twilio Credentials</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.twilio.update')); ?>" id="twilioForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                              <div class="form-group">
                                 <label>Account SID</label>
                                 <input class="form-control" name="twilio_sid" value="<?php echo e($abex->twilio_sid ?? null); ?>">
                                 <?php if($errors->has('twilio_sid')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('twilio_sid')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Auth token</label>
                                 <input class="form-control" name="twilio_token" value="<?php echo e($abex->twilio_token ?? null); ?>">
                                 <?php if($errors->has('twilio_token')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('twilio_token')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Phone Number (with country code)</label>
                                 <input class="form-control" name="twilio_phone_number" value="<?php echo e($abex->twilio_phone_number ?? null); ?>">
                                 <?php if($errors->has('twilio_phone_number')): ?>
                                 <p class="text-danger"><?php echo e($errors->first('twilio_phone_number')); ?></p>
                                 <?php endif; ?>
                                 <p class="text-warning mb-0">Twilio credentials will be used to send whatsapp notification of orders</p>
                                 <p class="text-warning mb-0">You have to enable whatsapp notification from <a href="<?php echo e(route('user.order.settings')); ?>" target="_blank">Order Management > Settings</a> </p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>

               <div class="card-footer text-center">
                  <button type="submit" form="twilioForm" class="btn btn-success">Update</button>
               </div>
            </div>
         </div>

            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="card-title">WhatsApp Chat Button</div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.whatsapp.update')); ?>" method="POST" id="waForm">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                           <label>Status</label>
                           <div class="selectgroup w-100">
                              <label class="selectgroup-item">
                              <input type="radio" name="is_whatsapp" value="1" class="selectgroup-input" <?php echo e($userBs->is_whatsapp == 1 ? 'checked' : ''); ?>>
                              <span class="selectgroup-button">Active</span>
                              </label>
                              <label class="selectgroup-item">
                              <input type="radio" name="is_whatsapp" value="0" class="selectgroup-input" <?php echo e($userBs->is_whatsapp == 0 ? 'checked' : ''); ?>>
                              <span class="selectgroup-button">Deactive</span>
                              </label>
                           </div>
                           <p class="text-warning mb-0">If you enable WhatsApp, then Tawk.to must be disabled.</p>
                        </div>
                        <div class="form-group">
                           <label>WhatsApp Number</label>
                           <input class="form-control" type="text" name="whatsapp_number" value="<?php echo e($userBs->whatsapp_number); ?>">
                           <p class="text-warning mb-0">Enter Phone number with Country Code</p>
                        </div>
                        <div class="form-group">
                           <label>WhatsApp Header Title</label>
                           <input class="form-control" type="text" name="whatsapp_header_title" value="<?php echo e($userBs->whatsapp_header_title); ?>">
                           <?php if($errors->has('whatsapp_header_title')): ?>
                           <p class="mb-0 text-danger"><?php echo e($errors->first('whatsapp_header_title')); ?></p>
                           <?php endif; ?>
                        </div>
                        <div class="form-group">
                           <label>WhatsApp Popup Message</label>
                           <textarea class="form-control" name="whatsapp_popup_message" rows="2"><?php echo e($userBs->whatsapp_popup_message); ?></textarea>
                           <?php if($errors->has('whatsapp_popup_message')): ?>
                           <p class="mb-0 text-danger"><?php echo e($errors->first('whatsapp_popup_message')); ?></p>
                           <?php endif; ?>
                        </div>
                        <div class="form-group">
                           <label>Popup</label>
                           <div class="selectgroup w-100">
                              <label class="selectgroup-item">
                              <input type="radio" name="whatsapp_popup" value="1" class="selectgroup-input" <?php echo e($userBs->whatsapp_popup == 1 ? 'checked' : ''); ?>>
                              <span class="selectgroup-button">Active</span>
                              </label>
                              <label class="selectgroup-item">
                              <input type="radio" name="whatsapp_popup" value="0" class="selectgroup-input" <?php echo e($userBs->whatsapp_popup == 0 ? 'checked' : ''); ?>>
                              <span class="selectgroup-button">Deactive</span>
                              </label>
                           </div>
                           <?php if($errors->has('whatsapp_popup')): ?>
                           <p class="mb-0 text-danger"><?php echo e($errors->first('whatsapp_popup')); ?></p>
                           <?php endif; ?>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button type="submit" class="btn btn-success" form="waForm">Update</button>
                  </div>
               </div>
            </div>
             <?php endif; ?>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Tawk.to</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.tawk.update')); ?>" id="tawkForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label>Tawk.to Status</label>
                                 <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_tawkto" value="1" class="selectgroup-input" <?php echo e($userBs->is_tawkto == 1 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_tawkto" value="0" class="selectgroup-input" <?php echo e($userBs->is_tawkto == 0 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Deactive</span>
                                    </label>
                                 </div>
                                 <p class="mb-0 text-warning">If you enable Tawk.to, then WhatsApp must be disabled.</p>
                                 <?php if($errors->has('is_tawkto')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('is_tawkto')); ?></p>
                                 <?php endif; ?>
                              </div>
                            
                               <div class="form-group">
                         <label><?php echo e(__('Tawk.to Direct Chat Link')); ?></label>
                         <input class="form-control" name="tawkto_direct_chat_link" value="<?php echo e($userBs->tawkto_direct_chat_link); ?>">
                         <?php if($errors->has('tawkto_direct_chat_link')): ?>
                         <p class="mb-0 text-danger"><?php echo e($errors->first('tawkto_direct_chat_link')); ?></p>
                         <?php endif; ?>
                      </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button class="btn btn-success" form="tawkForm" type="submit">Update</button>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Disqus</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.disqus.update')); ?>" id="disqusForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                               <div class="form-group">
                         <label><?php echo e(__('Disqus Status')); ?></label>
                         <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                            <input type="radio" name="is_disqus" value="1" class="selectgroup-input" <?php echo e($userBs->is_disqus == 1 ? 'checked' : ''); ?>>
                            <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                            </label>
                            <label class="selectgroup-item">
                            <input type="radio" name="is_disqus" value="0" class="selectgroup-input" <?php echo e($userBs->is_disqus == 0 ? 'checked' : ''); ?>>
                            <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                            </label>
                         </div>
                         <?php if($errors->has('is_disqus')): ?>
                         <p class="mb-0 text-danger"><?php echo e($errors->first('is_disqus')); ?></p>
                         <?php endif; ?>
                      </div>
                  
                      <div class="form-group">
                         <label><?php echo e(__('Disqus Shortname')); ?></label>
                         <input class="form-control" name="disqus_shortname" value="<?php echo e($userBs->disqus_shortname); ?>">
                         <?php if($errors->has('disqus_shortname')): ?>
                         <p class="mb-0 text-danger"><?php echo e($errors->first('disqus_shortname')); ?></p>
                         <?php endif; ?>
                      </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button class="btn btn-success" type="submit" form="disqusForm">Update</button>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Google Analytics</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.ga.update')); ?>" method="POST" id="gaForm">
                        <?php echo csrf_field(); ?>
                       <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Google Analytics Status')); ?></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_analytics" value="1"
                                                class="selectgroup-input"
                                                <?php echo e(isset($userBs) && $userBs->is_analytics == 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_analytics" value="0"
                                                class="selectgroup-input"
                                                <?php echo e(!isset($userBs) || $userBs->is_analytics != 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                                        </label>
                                    </div>

                                    <?php if($errors->has('is_analytics')): ?>
                                        <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('is_analytics')); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Measurement ID')); ?> </label>
                                    <input type="text" class="form-control" name="measurement_id"
                                        value="<?php echo e(isset($userBs) && $userBs->measurement_id ? $userBs->measurement_id : null); ?>">
                                    <?php if($errors->has('measurement_id')): ?>
                                        <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('measurement_id')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button class="btn btn-success" type="submit" form="gaForm">Update</button>
                  </div>
               </div>
            </div>
         
            
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Google Recaptcha</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.recaptcha.update')); ?>" id="grForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label>Google Recaptcha Status</label>
                                 <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_recaptcha" value="1" class="selectgroup-input" <?php echo e($userBs->is_recaptcha == 1 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                    <input type="radio" name="is_recaptcha" value="0" class="selectgroup-input" <?php echo e($userBs->is_recaptcha == 0 ? 'checked' : ''); ?>>
                                    <span class="selectgroup-button">Deactive</span>
                                    </label>
                                 </div>
                                 <?php if($errors->has('is_recaptcha')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('is_recaptcha')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Google Recaptcha Site key</label>
                                 <input class="form-control" name="google_recaptcha_site_key" value="<?php echo e($userBs->google_recaptcha_site_key); ?>">
                                 <?php if($errors->has('google_recaptcha_site_key')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_site_key')); ?></p>
                                 <?php endif; ?>
                              </div>
                              <div class="form-group">
                                 <label>Google Recaptcha Secret key</label>
                                 <input class="form-control" name="google_recaptcha_secret_key" value="<?php echo e($userBs->google_recaptcha_secret_key); ?>">
                                 <?php if($errors->has('google_recaptcha_secret_key')): ?>
                                 <p class="mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_secret_key')); ?></p>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button class="btn btn-success" type="submit" form="grForm">Update</button>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="card-title">Facebook Pexel</div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <form action="<?php echo e(route('user.pixel.update')); ?>" id="pixelForm" method="POST">
                        <?php echo csrf_field(); ?>
                       <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><?php echo e(__('Facebook Pixel Status')); ?></label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_facebook_pixel" value="1"
                                                class="selectgroup-input"
                                                <?php echo e(isset($userBe) && $userBe->is_facebook_pixel == 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_facebook_pixel" value="0"
                                                class="selectgroup-input"
                                                <?php echo e(!isset($userBe) || $userBe->is_facebook_pixel != 1 ? 'checked' : ''); ?>>
                                            <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                                        </label>
                                    </div>
                                    <p id="erris_facebook_pixel" class="mb-0 text-danger em"></p>
                                    <p class="text text-warning">
                                        <strong>Hint:</strong> <a class="text-primary" href="https://prnt.sc/5u1ZP6YjAw5O"
                                            target="_blank">Click Here</a> to see where to get the Facebook Pixel ID
                                    </p>
                                    <?php if($errors->has('is_facebook_pixel')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('is_facebook_pixel')); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label><?php echo e(__('Facebook Pixel ID')); ?></label>
                                    <input type="text" class="form-control" name="pixel_id"
                                        value="<?php echo e(isset($userBe) ? $userBe->pixel_id : null); ?>">
                                    <p id="errpixel_id" class="mb-0 text-danger em"></p>
                                    <?php if($errors->has('pixel_id')): ?>
                                        <p class="text-danger"><?php echo e($errors->first('pixel_id')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer text-center">
                     <button type="submit" class="btn btn-success" form="pixelForm">Update</button>
                  </div>
               </div>
            </div>
         </div>
   </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cpftxworld/menumakker.com/resources/views/user/basic/plugins.blade.php ENDPATH**/ ?>