<div>

    <div class="section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8">

                    @forelse ($events as $event)
                        <!-- Article Start -->
                        <article class="sigma_post sigma_post-list event-list">
                            <div class="sigma_post-thumb">
                                <a href="#">
                                    <img style="height: 400px; object-fit: cover;"
                                        src="{{ \Storage::url($event->image) }}" alt="post">
                                </a>
                                <div class="event-date-wrapper">
                                    <span>{{ $event->created_at->format('Y') }}</span>
                                    {{ $event->created_at->format('M\'y') }}
                                </div>
                            </div>
                            <div class="sigma_post-body">
                                <p>

                                    @if ($event->type == 'katina_puja')
                                        # KATINA ROBE CEREMONY
                                    @elseif ($event->type == 'kuti_puja')
                                        # KUTI POOJA
                                    @elseif ($event->type == 'vesak_puja')
                                        # VESAK POYA CEREMONY
                                    @endif
                                </p>
                                <h4> <a href="/events/{{ $event->id }}">{{ $event->title }}</a> </h4>

                                <p>
                                    {!! \Str::limit($event->description, 150, ' ...') !!}
                                </p>


                                <div class="section-button d-flex align-items-center">
                                    <a href="/events/{{ $event->id }}" class="sigma_btn-custom">Read More <i
                                            class="far fa-arrow-right"></i> </a>
                                </div>

                            </div>
                        </article>
                        <!-- Article End -->
                    @empty

                        <div style="display: flex; justify-content:center">

                            <h2 style="text-align: center;">Events Not Found <br>(සිදුවීම් හමු නොවීය)</h2>

                        </div>
                        <div class="section-button d-flex align-items-center" style="justify-content: center">

                            <a href="/" class="ms-3 sigma_btn-custom light text-white"
                                style="background-color: #1c1c1c;">Return Back to Home <iclass="far fa-arrow-right"></i>
                            </a>
                        </div>
                    @endforelse

                    <br>
                    <br>

                    <div>
                        {!! $events->links() !!}
                    </div>
                </div>



                <div class="col-lg-4">
                    <div class="sidebar">



                        <!-- Search Widget Start -->
                        <div class="sidebar-widget widget-search">
                            <h5 class="widget-title">Search</h5>
                            <form method="post">
                                <div class="sigma_search-adv-input">
                                    <input type="text" wire:model.live="search" class="form-control"
                                        placeholder="Search Posts" name="search" value="">
                                    <button type="submit" name="button"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- Search Widget End -->



                        <!-- Categories Start -->
                        <div class="sidebar-widget widget-categories">
                            <h5 class="widget-title"> Our Categories </h5>
                            <ul class="sidebar-widget-list">
                                <li> <a href="#"  wire:click="clear()">ALL</a> </li>
                                <li> <a href="#"  wire:click="selectType('katina_puja')">1. KATINA ROBE CEREMONY</a> </li>
                                <li> <a href="#"  wire:click="selectType('vesak_puja')">2. VESAK POYA CEREMONY</a> </li>
                                <li> <a href="#"  wire:click="selectType('kuti_puja')">3. KUTI POOJA</a></li>

                            </ul>

                        </div>
                        <!-- Categories End -->



                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
