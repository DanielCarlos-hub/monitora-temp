@extends('layouts.dashboard.admin')

@section('content')

<div class="container-fluid p-3">
    {!! $post->post_body !!}
</div>
@endsection
