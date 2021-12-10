@extends('layouts.master-layouts')

@section('title')
    domain || page
@endsection
@section('link')
    <meta property="og:url" content="{{route('index')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="KIFO || Memorial"/>
    <meta property="og:description" content="Preserve and Share Memories of your Loved One"/>
    <meta property="og:image" content="{{asset('img/banner.png)')}}"/>
@endsection
@section('content')
 
<div style="padding:200px">
Home page
</div>
   

@endsection

@section('script')
    <!-- Plugin Js-->
@endsection
