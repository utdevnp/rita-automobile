@if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <span class="current_price">${{ home_base_price($product->purchase_price) }}</span>
                                            @endif