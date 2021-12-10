@extends('layouts.master-layouts')

@section('title')
    @lang('translation.Preloader')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/new-design/css/creatememorial/about.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <section class="create-memorial-section">
        <div class="container">
            <h2 class="heading2">{{$designation}} Memorials</h2>
            <div class="main-input-box needs-validation" novalidate>
                <div class="p-4">
                    @foreach ($memorials as $item)
                        <div class="row mb-3">
                            <div class="col-md-3 col-xs-12">
                                <a href="{{ env('APP_URL') . $item->site_address . '/about' }}" class="articles__image">
                                    <img class="w-100" src="{{ asset('/assets/media/' . $item->profile_photo) }}">
                                </a> 
                            </div>
                            <div class="col-md-9 col-xs-12">
                                <div class="mb-2">
                                    {{$item->firstname}} {{$item->middlename}} {{$item->lastname}}
                                </div>
                                <div class="mb-3">
                                    ({{$item->born_year}} - {{$item->passed_year}})
                                </div>
                                <div class="mb-3">
                                    <a href="{{url($item->site_address.'/about')}}">
                                    {{$item->site_address}}.{{env('ROOT_DOMAIN')}}
                                    </a>
                                </div>
                                <div class="mb-3">
                                    Online memorial was created by {{$item->user->firstname}} {{$item->user->lastname}}
                                    on {{$item->created_at}}
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')

@endsection
