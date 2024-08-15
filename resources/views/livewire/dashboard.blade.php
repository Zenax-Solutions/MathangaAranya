<div>
   
    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
           <div class="flex items-center">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($todayDailyContributions)}}</span>
                 <h3 class="text-base font-normal text-gray-500">අද දින දෛනික දායකත්වයන් <br> {{Carbon\Carbon::now()->format('Y-m-d')}}</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                 
                {{number_format($todayDailyContributionsCount)}}
                <br>
                total
                
              </div>
           </div>

           @if ($clients->count() > 0)
           <br>
           <hr>
           <br>
           <div>
           <ul style="list-style:num">

            @foreach ($clients as $client )
              <li>{{$client->first_name.' '.$client->last_name}} ( {{ $client->phone_number }} )
                   <br>
                  <a href="mailto:{{$client->email}}" style="color: rgb(23, 57, 181); text-decoration:underline">{{$client->email}}</a>
            </li>
            <br>
            @endforeach

            
          </ul>
        </div>
           @endif
          


        </div>
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
           <div class="flex items-center">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($donationCount)}}</span>
                 <h3 class="text-base font-normal text-gray-500">අද දින පරිත්‍යාග ගණන <br> {{Carbon\Carbon::now()->format('Y-m-d')}} </h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                 
                 {{number_format($totalDonationCount)}}
                 <br>
                 total
                 
              </div>
           </div>
        </div>
     </div>

</div>
