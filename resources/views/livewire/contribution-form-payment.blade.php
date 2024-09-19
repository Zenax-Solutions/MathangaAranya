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
                    </div>
                </div>
            </div>
    
            <!-- Checkbox for Payment Deposit Verification -->
            <div class="col-12">
            <div class="form-group mb-5">
                <div class="flex items-center mb-4">
                    <input required type="checkbox" id="paymentVerified" 
                        class="w-8 h-8 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                    <label for="paymentVerified" class="ml-3 text-lg font-medium text-gray-900">
                        I confirm that the payment has been deposited to the bank
                    </label>
                </div>
                @error('paymentVerified') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

    
            <div wire:loading.remove class="col-lg-12">
                <button type="submit" class="sigma_btn-custom" name="button">Submit</button>
            </div>

            <div wire:loading wire:target="submit" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
        </div>
    </form>


    


</div>
