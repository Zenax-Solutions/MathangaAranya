<div class="space-y-8">

   {{-- ── DATE HEADER ── --}}
   <div class="flex items-center justify-between pb-4 border-b border-gray-200">
      <div>
         <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
         <p class="text-sm text-gray-400 mt-0.5">{{ $today->format('l, F j, Y') }}</p>
      </div>
      <span class="flex items-center gap-1.5 text-xs bg-indigo-600 text-white px-3 py-1.5 rounded-full font-medium shadow-sm">
         <i class="icon ion-md-pulse"></i> Live
      </span>
   </div>

   {{-- ── STAT CARDS ── --}}
   <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

      {{-- Daily Alms --}}
      <a href="{{ route('alms.index') }}"
         class="group block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-200">
         <div class="h-1.5 bg-amber-400"></div>
         <div class="p-5">
            <div class="flex items-center justify-between">
               <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                  <i class="icon ion-md-restaurant text-2xl text-amber-500"></i>
               </div>
               <span class="text-4xl font-extrabold text-gray-900 group-hover:text-amber-600 transition-colors">{{ number_format($almsTotal) }}</span>
            </div>
            <p class="mt-3 text-sm font-semibold text-gray-700">දාන වාරය</p>
            <p class="text-xs text-gray-400">Daily Alms &nbsp;·&nbsp; මාසය: <strong class="text-gray-600">{{ $almsThisMonth }}</strong></p>
            <div class="mt-3 flex flex-wrap gap-2">
               @if($almsOverdue > 0)
               <span class="inline-flex items-center gap-1 text-xs bg-red-50 text-red-600 border border-red-200 px-2 py-0.5 rounded-full font-medium">
                  <i class="icon ion-md-alert"></i> {{ $almsOverdue }} overdue
               </span>
               @endif
               @if($almsReminders->count() > 0)
               <span class="inline-flex items-center gap-1 text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-2 py-0.5 rounded-full font-medium">
                  <i class="icon ion-md-notifications"></i> {{ $almsReminders->count() }} soon
               </span>
               @endif
               @if($almsOverdue == 0 && $almsReminders->count() == 0)
               <span class="inline-flex items-center gap-1 text-xs bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded-full font-medium">
                  <i class="icon ion-md-checkmark-circle"></i> All good
               </span>
               @endif
            </div>
         </div>
      </a>

      {{-- Daily Contribution --}}
      <a href="{{ route('communities.index') }}"
         class="group block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-200">
         <div class="h-1.5 bg-blue-500"></div>
         <div class="p-5">
            <div class="flex items-center justify-between">
               <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                  <i class="icon ion-md-people text-2xl text-blue-500"></i>
               </div>
               <span class="text-4xl font-extrabold text-gray-900 group-hover:text-blue-600 transition-colors">{{ number_format($communityTotal) }}</span>
            </div>
            <p class="mt-3 text-sm font-semibold text-gray-700">දෛනික දායකත්වය</p>
            <p class="text-xs text-gray-400">Daily Contribution &nbsp;·&nbsp; අද: <strong class="text-gray-600">{{ $communityToday }}</strong> &nbsp;·&nbsp; මාසය: <strong class="text-gray-600">{{ $communityThisMonth }}</strong></p>
            <div class="mt-3 flex flex-wrap gap-2">
               @if($communityOverdue > 0)
               <span class="inline-flex items-center gap-1 text-xs bg-red-50 text-red-600 border border-red-200 px-2 py-0.5 rounded-full font-medium">
                  <i class="icon ion-md-alert"></i> {{ $communityOverdue }} overdue
               </span>
               @endif
               @if($communityReminders->count() > 0)
               <span class="inline-flex items-center gap-1 text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-2 py-0.5 rounded-full font-medium">
                  <i class="icon ion-md-notifications"></i> {{ $communityReminders->count() }} soon
               </span>
               @endif
               @if($communityOverdue == 0 && $communityReminders->count() == 0)
               <span class="inline-flex items-center gap-1 text-xs bg-green-50 text-green-600 border border-green-200 px-2 py-0.5 rounded-full font-medium">
                  <i class="icon ion-md-checkmark-circle"></i> All good
               </span>
               @endif
            </div>
         </div>
      </a>

      {{-- Donations --}}
      <a href="{{ route('donations.index') }}"
         class="group block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-200">
         <div class="h-1.5 bg-emerald-500"></div>
         <div class="p-5">
            <div class="flex items-center justify-between">
               <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center">
                  <i class="icon ion-md-heart text-2xl text-emerald-500"></i>
               </div>
               <span class="text-4xl font-extrabold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ number_format($donationTotal) }}</span>
            </div>
            <p class="mt-3 text-sm font-semibold text-gray-700">පරිත්‍යාග</p>
            <p class="text-xs text-gray-400">Donations &nbsp;·&nbsp; අද: <strong class="text-gray-600">{{ $donationToday }}</strong> &nbsp;·&nbsp; මාසය: <strong class="text-gray-600">{{ $donationThisMonth }}</strong></p>
            <div class="mt-3">
               <span class="inline-flex items-center gap-1 text-xs bg-gray-50 text-gray-500 border border-gray-200 px-2 py-0.5 rounded-full">
                  <i class="icon ion-md-list"></i> මෙතෙක්: {{ $donationTotal }}
               </span>
            </div>
         </div>
      </a>

   </div>

   {{-- ── REMINDERS ── --}}
   <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

      {{-- Alms Reminders --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
         <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-amber-50">
            <div class="flex items-center gap-2">
               <i class="icon ion-md-notifications text-amber-500 text-lg"></i>
               <h3 class="text-sm font-semibold text-gray-700">දාන වාරය — ඉදිරි සිහිකැඳවීම්</h3>
               <span class="text-xs bg-amber-200 text-amber-800 px-1.5 py-0.5 rounded-full">3 days</span>
            </div>
            <a href="{{ route('alms.index') }}" class="text-xs text-indigo-600 font-medium hover:underline flex items-center gap-1">
               සියල්ල <i class="icon ion-md-arrow-forward"></i>
            </a>
         </div>
         <div class="divide-y divide-gray-50">
            @forelse($almsReminders as $alm)
            <div class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors">
               <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-bold text-sm shrink-0">
                     {{ strtoupper(substr($alm->first_name, 0, 1)) }}
                  </div>
                  <div>
                     <p class="text-sm font-medium text-gray-800 leading-tight">{{ $alm->honorifics }} {{ $alm->first_name }} {{ $alm->last_name }}</p>
                     <p class="text-xs text-gray-400 mt-0.5">
                        {{ $alm->next_reminder_date?->format('M d, Y') }}
                        &nbsp;·&nbsp;
                        <span class="{{ $alm->meal_type === 'breakfast' ? 'text-blue-500' : 'text-orange-500' }}">
                           {{ $alm->meal_type === 'breakfast' ? 'හීල් දානය' : 'සාංඝික දානය' }}
                        </span>
                     </p>
                  </div>
               </div>
               <div class="text-right shrink-0 ml-4">
                  @php $daysLeft = \Carbon\Carbon::today()->diffInDays($alm->next_reminder_date, false) @endphp
                  <span class="inline-block text-xs font-bold px-2 py-0.5 rounded-full {{ $daysLeft <= 0 ? 'bg-red-100 text-red-600' : ($daysLeft === 1 ? 'bg-orange-100 text-orange-600' : 'bg-yellow-100 text-yellow-700') }}">
                     {{ $daysLeft <= 0 ? 'Today' : ($daysLeft === 1 ? 'Tomorrow' : "in {$daysLeft}d") }}
                  </span>
                  <p class="text-xs text-gray-400 mt-1 truncate max-w-[140px]">{{ $alm->email }}</p>
               </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-gray-400">
               <i class="icon ion-md-checkmark-circle-outline text-4xl text-green-400"></i>
               <p class="text-sm mt-2">ඉදිරි දින 3 තුළ සිහිකැඳවීම් නොමැත.</p>
            </div>
            @endforelse
         </div>
      </div>

      {{-- Community Reminders --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
         <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-blue-50">
            <div class="flex items-center gap-2">
               <i class="icon ion-md-notifications text-blue-500 text-lg"></i>
               <h3 class="text-sm font-semibold text-gray-700">දායකත්වය — ඉදිරි සිහිකැඳවීම්</h3>
               <span class="text-xs bg-blue-200 text-blue-800 px-1.5 py-0.5 rounded-full">3 days</span>
            </div>
            <a href="{{ route('communities.index') }}" class="text-xs text-indigo-600 font-medium hover:underline flex items-center gap-1">
               සියල්ල <i class="icon ion-md-arrow-forward"></i>
            </a>
         </div>
         <div class="divide-y divide-gray-50">
            @forelse($communityReminders as $community)
            <div class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors">
               <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm shrink-0">
                     {{ strtoupper(substr($community->first_name, 0, 1)) }}
                  </div>
                  <div>
                     <p class="text-sm font-medium text-gray-800 leading-tight">{{ $community->first_name }} {{ $community->last_name }}</p>
                     <p class="text-xs text-gray-400 mt-0.5">
                        {{ $community->next_reminder_date?->format('M d, Y') }}
                        &nbsp;·&nbsp; {{ $community->phone_number }}
                     </p>
                  </div>
               </div>
               <div class="text-right shrink-0 ml-4">
                  @php $daysLeft = \Carbon\Carbon::today()->diffInDays($community->next_reminder_date, false) @endphp
                  <span class="inline-block text-xs font-bold px-2 py-0.5 rounded-full {{ $daysLeft <= 0 ? 'bg-red-100 text-red-600' : ($daysLeft === 1 ? 'bg-orange-100 text-orange-600' : 'bg-yellow-100 text-yellow-700') }}">
                     {{ $daysLeft <= 0 ? 'Today' : ($daysLeft === 1 ? 'Tomorrow' : "in {$daysLeft}d") }}
                  </span>
                  <p class="text-xs text-gray-400 mt-1 truncate max-w-[140px]">{{ $community->email }}</p>
               </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-gray-400">
               <i class="icon ion-md-checkmark-circle-outline text-4xl text-green-400"></i>
               <p class="text-sm mt-2">ඉදිරි දින 3 තුළ සිහිකැඳවීම් නොමැත.</p>
            </div>
            @endforelse
         </div>
      </div>

   </div>

   {{-- ── RECENT REGISTRATIONS ── --}}
   <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

      {{-- Recent Alms --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
         <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
               <i class="icon ion-md-time text-amber-400 text-lg"></i>
               <h3 class="text-sm font-semibold text-gray-700">නවතම දාන වාරය ලියාපදිංචි</h3>
            </div>
            <a href="{{ route('alms.index') }}" class="text-xs text-indigo-600 font-medium hover:underline flex items-center gap-1">
               සියල්ල <i class="icon ion-md-arrow-forward"></i>
            </a>
         </div>
         <div class="divide-y divide-gray-50">
            @forelse($recentAlms as $alm)
            <div class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors">
               <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-bold text-sm shrink-0">
                     {{ strtoupper(substr($alm->first_name, 0, 1)) }}
                  </div>
                  <div>
                     <p class="text-sm font-medium text-gray-800 leading-tight">{{ $alm->honorifics }} {{ $alm->first_name }} {{ $alm->last_name }}</p>
                     <p class="text-xs text-gray-400 mt-0.5">{{ $alm->created_at->diffForHumans() }}</p>
                  </div>
               </div>
               <div class="text-right shrink-0 ml-4">
                  <span class="inline-block text-xs px-2 py-0.5 rounded-full font-medium {{ $alm->meal_type === 'breakfast' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }}">
                     {{ $alm->meal_type === 'breakfast' ? 'Breakfast' : 'Lunch' }}
                  </span>
                  <p class="text-xs text-gray-400 mt-1">{{ $alm->date?->format('M d, Y') }}</p>
               </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-gray-400">
               <i class="icon ion-md-person-add text-4xl"></i>
               <p class="text-sm mt-2">ලියාපදිංචි නොමැත.</p>
            </div>
            @endforelse
         </div>
      </div>

      {{-- Recent Community --}}
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
         <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
               <i class="icon ion-md-time text-blue-400 text-lg"></i>
               <h3 class="text-sm font-semibold text-gray-700">නවතම දායකත්ව ලියාපදිංචි</h3>
            </div>
            <a href="{{ route('communities.index') }}" class="text-xs text-indigo-600 font-medium hover:underline flex items-center gap-1">
               සියල්ල <i class="icon ion-md-arrow-forward"></i>
            </a>
         </div>
         <div class="divide-y divide-gray-50">
            @forelse($recentCommunity as $c)
            <div class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors">
               <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm shrink-0">
                     {{ strtoupper(substr($c->first_name, 0, 1)) }}
                  </div>
                  <div>
                     <p class="text-sm font-medium text-gray-800 leading-tight">{{ $c->first_name }} {{ $c->last_name }}</p>
                     <p class="text-xs text-gray-400 mt-0.5">{{ $c->created_at->diffForHumans() }}</p>
                  </div>
               </div>
               <div class="text-right shrink-0 ml-4">
                  <p class="text-xs font-medium text-gray-600">{{ $c->phone_number }}</p>
                  <p class="text-xs text-gray-400 mt-1">{{ optional($c->date)->format('M d, Y') }}</p>
               </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-gray-400">
               <i class="icon ion-md-person-add text-4xl"></i>
               <p class="text-sm mt-2">ලියාපදිංචි නොමැත.</p>
            </div>
            @endforelse
         </div>
      </div>

   </div>

</div>