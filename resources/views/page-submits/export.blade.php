@extends('layouts.admin')

@section('content')
    @component('components.panel')
        @slot('title')
            Exporting submits of page "{{ $page->name }}"
        @endslot

        <form action="{{ route('pageSubmits.export', $page) }}" class="form" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label">Filename</label>
                <div class="input-group">
                    <input name="filename" type="text" class="form-control" value="{{ $defaultFilename }}" required>
                    <span class="input-group-addon" id="basic-addon2">.xls</span>
                </div>
            </div>
            There are {{ $page->pageSubmits->count() }} submits to export.

            <button class="btn btn-success pull-right">Download</button>
        </form>
    @endcomponent
@endsection
