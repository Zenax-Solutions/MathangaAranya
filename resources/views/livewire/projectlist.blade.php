<div>

    <div class="section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8"> 

                    @forelse ($projects as $project)
                        <!-- Article Start -->
                        <article class="sigma_post sigma_post-list event-list">
                            <div class="sigma_post-thumb">
                                <a href="#">
                                    <img style="height: 400px; object-fit: cover;"
                                        src="{{ \Storage::url($project->feature_image) }}" alt="post">
                                </a>
                                <div class="event-date-wrapper">
                                    <span>{{ $project->created_at->format('Y') }}</span>
                                    {{ $project->created_at->format('M\'y') }}
                                </div>
                            </div>
                            <div class="sigma_post-body">
                               
                                <h4> <a href="/projects/{{ $project->id }}">{{ $project->title }}</a> </h4>

                                <p>
                                    {!! $project->short_description !!}
                                </p>


                                <div class="section-button d-flex align-items-center">
                                    <a href="/projects/{{ $project->id }}" class="sigma_btn-custom">Read More <i
                                            class="far fa-arrow-right"></i> </a>
                                </div>

                            </div>
                        </article>
                        <!-- Article End -->
                    @empty

                        <div style="display: flex; justify-content:center">

                            <h2 style="text-align: center;">Projects Not Found <br>(ව්‍යාපෘති හමු නොවීය)</h2>

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
                        {!! $projects->links() !!}
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





                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
