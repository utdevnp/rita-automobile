
                                    <h3>Billing Details</h3>
                                    <div class="row">

                                        <div class="col-lg-6 mb-20">
                                            <label>First Name <span>*</span></label>
                                            <input type="text" value="{{$user->name}}" value="name">    
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <label>Last Name  <span>*</span></label>
                                            <input type="text"> 
                                        </div>
                                      
                                        <div class="col-12 mb-20">
                                            <label for="country">Country <span>*</span></label>
                                            <select class="niceselect_option" name="cuntry" id="country"> 
                                                @foreach (\App\Country::all() as $key => $country)
                                                    <option value="{{ $country->code }}" <?php if(Auth::user()->country == $country->code) echo "selected";?> >{{ $country->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-12 mb-20">
                                            <label>Address  <span>*</span></label>
                                            <input placeholder="House number and street name"  value="{{$user->address}}" value="address" type="text">     
                                        </div>
                                      
                                        <div class="col-12 mb-20">
                                            <label>Town / City <span>*</span></label>
                                            <input  type="text" value="{{$user->city}}" value="city">    
                                        </div> 
                                       
                                        <div class="col-lg-6 mb-20">
                                            <label>Phone<span>*</span></label>
                                            <input type="text" value="{{$user->phone}}" value="phone"> 

                                        </div> 
                                         <div class="col-lg-6 mb-20">
                                            <label> Email Address   <span>*</span></label>
                                              <input type="text" value="{{$user->email}}" value="email"> 

                                        </div> 
                                      
                                    
                                        <div class="col-12">
                                            <div class="order-notes">
                                                 <label for="order_note">Order Notes</label>
                                                <textarea id="order_note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>    
                                    </div>     	    	    	    	    	    	    
                                    </div>
