@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form method="POST" action="{{ url('edit/advertising/'.$advertising->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">{{__('interface.Title')}}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                               placeholder="title" name="title" value="{{$advertising->title}}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('interface.Description')}}</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                  rows="6" name="description">{{$advertising->description}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="col-md-1 offset-md-11">
                            <button type="submit" class="btn btn-primary">
                                {{ __('interface.Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
