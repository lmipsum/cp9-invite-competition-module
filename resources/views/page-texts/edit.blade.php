@extends('layouts.admin')

@section('content')
    @component('components.panel')
        @slot('title')
            Editing text contents of page "{{ $page->name }}"
        @endslot

        <form action="{{ route('pageTexts.update', $page) }}" class="form" method="POST">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            @foreach($page->pageTexts()->orderBy('id')->get() as $i => $pageText)
                <div class="form-group">
                    <label for="pageTexts{{$i}}" class="control-label">{{ $pageText->name }}</label>
                    <input id="pageTexts{{$i}}" name="pageTexts[{{ $pageText->key }}]" type="text" class="form-control" value="{{ old("pageTexts[".$pageText->key."]", $pageText->value) }}">
                </div>
            @endforeach
            <button class="btn btn-success pull-right">Save</button>
        </form>
    @endcomponent
@endsection
