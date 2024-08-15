<div>
    <form wire:submit.prevent="submit">
        <div class="form-row sigma_donation-form">
            <div class="col-12">
                <div class="form-group mb-5">
                    <div class="row" style="row-gap: 22px;">
                        <div class="col-lg-6">
                            <h5>Donation Amount</h5>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="sigma_btn-custom shadow-none btn-sm" type="button">Rs</button>
                                </div>
                                <input wire:model="donationAmount" type="number" class="form-control ms-0" placeholder="100">
                            </div>
                            @error('donationAmount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
    
                        <div class="col-lg-6">
                            <h5>Upload Payment Slip</h5>
                            <div class="input-group">
                                <input wire:model="paymentSlip" type="file" class="form-control-file" />
                            </div>
                            @error('paymentSlip') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-12">
                <div class="form-group">
                    <h5>Donation Purpose</h5>
                    <select wire:model="frequency" class="form-control">
                        <option selected>select here</option>
                        <option value="electricity_bill">ELECTRICITY BILL</option>
                        <option value="water_bill">WATER BILL</option>
                        <option value="development">TEMPLE DEVOLOPMET</option>
                        <option value="katina_pinkam">KATINA PINKAM</option>
                    </select>
                    @error('frequency') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
    
                <div class="form-group">
                    <h5>Select The Date</h5>
                    <input style="background-color:transparent" wire:model="selectedDate" id="selectedDate" type="text" placeholder="Select the Date" class="form-control">
                    @error('selectedDate') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
    

            <div class="col-12">
                <div class="form-group">
                    <h5>Message</h5>
                    <textarea wire:model="message"  class="form-control" placeholder="Enter Message" rows="6"></textarea>
                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="col-12">
                <div class="form-group">
                    <div class="row" style="row-gap: 22px;">
                        <div class="col-lg-6">
                            <h5>First Name</h5>
                            <input wire:model="firstName" type="text" class="form-control" placeholder="First Name">
                            @error('firstName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-lg-6">
                            <h5>Last Name</h5>
                            <input wire:model="lastName"  type="text" class="form-control" placeholder="Last Name">
                            @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="form-group">
                    <div class="row" style="row-gap: 22px;">
                        <div class="col-lg-6">
                            <h5>Country</h5>
                            <input wire:model="country"  type="text" min="0" placeholder="SriLanka" class="form-control">
                            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-lg-6">
                            <h5>Phone Number</h5>
                            <input wire:model="phoneNumber" id="mobile_code_3"  type="tel" min="0" placeholder="Type with country code (+9476 000 0000)" class="form-control">
                            @error('phoneNumber') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="form-group">
                    <div class="row" style="row-gap: 22px;">
                        <div class="col-lg-6">
                            <h5>Email</h5>
                            <input wire:model="email"  type="email" placeholder="Email Address"  class="form-control">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
            
                        <div class="col-lg-6">
                            <h5>Address</h5>
                            <textarea wire:model="address" class="form-control" placeholder="Enter Address" rows="6"></textarea>
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
          
    
            <div wire:loading.remove class="col-lg-12">
                <button type="submit" class="sigma_btn-custom" name="button">Donate Now</button>
            </div>

            <div wire:loading wire:target="submit" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
        </div>
    </form>


    <!-- Faltficker script -->

    <script>
        flatpickr('#selectedDate', {
            enableTime: false, // Set to true if you want to include time selection
            dateFormat: 'Y-m-d', // Define your desired date format
        });
    </script>
  
  
    <script>    
    const input_3 = document.querySelector("#mobile_code_3");
    window.intlTelInput(input_3, {
       autoInsertDialCode:true,
      nationalMode:false,
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
    });
  </script>
  
</div>
