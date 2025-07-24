@php $editing = isset($community) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="first_name"
            label="First Name"
            :value="old('first_name', ($editing ? $community->first_name : ''))"
            placeholder="First Name"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="last_name"
            label="Last Name"
            :value="old('last_name', ($editing ? $community->last_name : ''))"
            placeholder="Last Name"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $community->email : ''))"
            placeholder="Email"
            required></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone_number"
            label="Phone Number"
            :value="old('phone_number', ($editing ? $community->phone_number : ''))"
            placeholder="Please enter with country code (+94766101085)"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="address" label="Address" required>{{ old('address', ($editing ? $community->address : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="type" label="Every month or Every year">
            @php $selected = old('type', ($editing ? $community->type : '')) @endphp
            <option value="monthly" {{ $selected == 'monthly' ? 'selected' : '' }}>MONTHLY</option>
            <option value="yearly" {{ $selected == 'yearly' ? 'selected' : '' }}>YEARLY</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="description" label="Description" required>{{ old('description', ($editing ? $community->description : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>
    <x-inputs.group class="w-full">
        <x-inputs.textarea rows="10" name="note" label="Note (පුණ්‍ය අනුමෝදනාව)">{{ old('note', ($editing ? $community->note : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>

    {{-- Admin Manual Adjustment Section --}}
    @if($editing)
    <div id="admin-adjustments" class="w-full bg-yellow-50 border-2 border-yellow-200 rounded-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-yellow-800 mb-4">
            🔧 Admin Manual Adjustments
        </h3>
        <p class="text-sm text-yellow-700 mb-4">
            Use these fields to manually adjust dates and payment status when needed. Changes will affect the reminder system.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-inputs.group class="w-full">
                <x-inputs.date
                    name="date"
                    label="Date"
                    value="{{ old('date', ($editing ? optional($community->date)->format('Y-m-d') : '')) }}"
                    required></x-inputs.date>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.date
                    name="next_reminder_date"
                    label="Next Reminder Date"
                    value="{{ old('next_reminder_date', ($editing ? optional($community->next_reminder_date)->format('Y-m-d') : '')) }}"
                    help="This is when the next reminder email will be calculated from (3 days before this date)"></x-inputs.date>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.select name="payment_completed" label="Payment Status">
                    @php $payment_selected = old('payment_completed', ($editing ? ($community->payment_completed ? '1' : '0') : '0')) @endphp
                    <option value="0" {{ $payment_selected == '0' ? 'selected' : '' }}>❌ Pending Payment</option>
                    <option value="1" {{ $payment_selected == '1' ? 'selected' : '' }}>✅ Payment Completed</option>
                </x-inputs.select>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.number
                    name="amount"
                    label="Last Payment Amount"
                    :value="old('amount', ($editing ? $community->amount : 0))"
                    placeholder="0"
                    min="0"
                    step="0.01"
                    help="Amount of the last payment made"></x-inputs.number>
            </x-inputs.group>

            <x-inputs.group class="w-full md:col-span-2">
                <x-inputs.textarea
                    name="reminder_notes"
                    label="Admin Notes & Reminders"
                    rows="3"
                    help="Internal notes for tracking manual adjustments, payment issues, etc.">{{ old('reminder_notes', ($editing ? $community->reminder_notes : '')) }}</x-inputs.textarea>
            </x-inputs.group>
        </div>

        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded">
            <p class="text-sm text-blue-700">
                <strong>💡 How it works:</strong><br>
                • Next Reminder Date: Controls when the next payment reminder will be sent<br>
                • Payment Status: Affects whether reminders are sent (no reminders for completed payments)<br>
                • Manual changes will be logged for tracking purposes
            </p>
        </div>
    </div>
    @endif

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="slip"
            label="Slip"></x-inputs.partials.label><br />

        <input type="file" name="slip" id="slip" class="form-control-file" />

        @if($editing && $community->slip)
        <div class="mt-2">
            <a href="{{ \Storage::url($community->slip) }}" target="_blank"><i class="icon ion-md-download"></i>&nbsp;Download</a>
        </div>
        @endif @error('slip') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>
</div>