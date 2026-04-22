<div>
    <form wire:submit.prevent="submit">
        <div class="form-row sigma_donation-form">

            {{-- Frequency --}}
            <div class="col-12">
                <div class="form-group">
                    <h5>Every Month or Every Year</h5>
                    <select wire:model="frequency" class="form-control">
                        <option value="">Select frequency</option>
                        <option value="monthly">Every Month</option>
                        <option value="yearly">Every Year</option>
                    </select>
                    @error('frequency') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Meal Type --}}
            <div class="col-12">
                <div class="form-group">
                    <h5>Meal Type</h5>
                    <select wire:model="mealType" class="form-control">
                        <option value="">Select meal</option>
                        <option value="breakfast">Breakfast (6.00 am) — හීල් දානය</option>
                        <option value="lunch">Lunch (10.00 am) — සාංඝික දානය</option>
                    </select>
                    @error('mealType') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Date --}}
            <div class="col-12">
                <div class="form-group">
                    <h5>Select The Date</h5>
                    <input style="background-color:transparent" wire:model="selectedDate" id="almsSelectedDate"
                        type="text" placeholder="Select the Date" class="form-control">
                    @error('selectedDate') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Title + First Name --}}
            <div class="col-12">
                <div class="form-group">
                    <div class="row" style="row-gap: 22px;">
                        <div class="col-lg-6">
                            <h5>Title</h5>
                            <select wire:model="title" class="form-control">
                                <option value="">Select title</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                            </select>
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <h5>First Name</h5>
                            <input wire:model="firstName" type="text" class="form-control" placeholder="First Name">
                            @error('firstName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <h5>Last Name</h5>
                            <input wire:model="lastName" type="text" class="form-control" placeholder="Last Name">
                            @error('lastName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <h5>Email</h5>
                            <input wire:model="email" type="email" class="form-control" placeholder="Email Address">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <h5>Phone Number</h5>
                            <input wire:model="phoneNumber" id="alms_phone" type="tel" class="form-control">
                            @error('phoneNumber') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <h5>WhatsApp Number</h5>
                            <input wire:model="whatsappNumber" id="alms_whatsapp" type="tel" class="form-control">
                            @error('whatsappNumber') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <h5>Country</h5>
                            <input wire:model="country" type="text" class="form-control" placeholder="Sri Lanka">
                            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6">
                            <h5>Address</h5>
                            <textarea wire:model="address" class="form-control" placeholder="Enter Address" rows="3"></textarea>
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="col-12">
                <div class="form-group">
                    <h5>Description</h5>
                    <textarea wire:model="description" class="form-control" placeholder="Enter Description" rows="4"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div wire:loading.remove class="col-lg-12">
                <button type="submit" class="sigma_btn-custom" name="button">Submit</button>
            </div>
            <div wire:loading wire:target="submit" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

        </div>
    </form>

    <script>
        flatpickr('#almsSelectedDate', {
            enableTime: false,
            dateFormat: 'Y-m-d',
        });
    </script>

    <script>
        const almsPhone = document.querySelector("#alms_phone");
        window.intlTelInput(almsPhone, {
            autoInsertDialCode: true,
            nationalMode: false,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        });
        const almsWhatsapp = document.querySelector("#alms_whatsapp");
        window.intlTelInput(almsWhatsapp, {
            autoInsertDialCode: true,
            nationalMode: false,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        });
    </script>
</div>