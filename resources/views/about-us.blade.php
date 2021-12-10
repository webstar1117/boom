@extends('layouts.master-layouts')

@section('title')
    @lang('translation.Preloader')
@endsection
@section('content')

    <!-- banner area -->
    <section class="banner-content">
        <img src="{{asset('/assets/images/logo.png')}}" alt="">
        <h2>Create a Memorial Website</h2>
        <p>Preserve and Share Memories of your Loved One</p>
    </section>

    <!-- our story area -->
    <section class="our-story-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="heading2">Our Story</h2>
                    <div class="story-text-wrapper">
                        <p>The idea for the online memorial website was first conceived when I decided to re-create the
                            life story of my Dad. My Father was a very important figure in my life and played a crucial
                            role. I experienced a great childhood being the last of six siblings. My dad love and
                            devotion to his family was number one priority as a provider and protector. He passed away
                            in 2017 after a losing the fight against Cancer. It was very difficult time for the entire
                            family but we pulled together to honor our beloved dad whom we miss every single day. I have
                            tender memories of him that I will cherish forever. While reflecting upon life of my father,
                            I was surprised how little I actually knew about his journey through life. It took some
                            effort to uncover precious old photographs hidden away in family albums that I had not even
                            seen before, and to encourage other family members to share what they knew about my Dad. I
                            also realized that today, families like ours could use the Internet to create an online
                            memorial page and easily share memories, photos and other media with one another. I could
                            see that online memorial sites, dedicated to the lives of those we love, would go a long way
                            towards bringing separated families together. These pages would also eventually help our
                            children and grandchildren learn about the lives of their relatives who have passed while
                            they were still young. I launched Kifo.org, a place where people could create an online
                            memorial to collect and share memories of the people they have lost. From the very
                            beginning, our team focused on making this service very easy to use. We have spared no
                            effort in making sure that people with even modest computer skills can easily create a
                            website to remember their loved ones.</p>


                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')

@endsection
