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
    

    
            <div wire:loading.remove class="col-lg-12">
                <button type="submit" class="sigma_btn-custom" name="button">Submit</button>
            </div>

            <div wire:loading wire:target="submit" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
        </div>
    </form>


    


</div>
