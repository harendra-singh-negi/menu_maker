<div class="modal fade" id="variationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">
                    <span></span>
                    <small>
                        ({{ $userBe->base_currency_text_position == 'left' ? $userBe->base_currency_text : '' }}
                        <span id="productPrice"></span>
                        {{ $userBe->base_currency_text_position == 'right' ? $userBe->base_currency_text : '' }})
                    </small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="variants">
                
                </div>
                <div class="addon-label mt-3">
                    <h5>{{ $keywords['Select Addons'] ?? __('Select Addons') }}
                        ({{ $keywords['Optional'] ?? __('Optional') }})</h5>
                </div>
                <div id="addons">
                    
                </div>
            </div>
            @if (in_array('Online Order', $packagePermissions))
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="modal-quantity">
                                <span class="minus"><i class="fas fa-minus"></i></span>
                                <input class="form-control" type="number" name="cart-amount" value="1"
                                    min="1">
                                <span class="plus"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-primary btn-block text-uppercase modal-cart-link">
                                <span class="d-block">{{ $keywords['Add to Cart'] ?? __('Add to Cart') }}</span>
                                <i class="fas fa-spinner d-none"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="modal-footer no-flex">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="modal-quantity">
                                <span class="minus"><i class="fas fa-minus"></i></span>
                                <input class="form-control" type="number" name="cart-amount" value="1"
                                    min="1">
                                <span class="plus"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
