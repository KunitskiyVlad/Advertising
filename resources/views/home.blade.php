@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($advertising as $item)
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-11 text-center"><a
                                            href="{{url($item->id)}}"> {{$item->title}}</a></div>
                                    @can('modify',$item)
                                        <div class="col-md-1">
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form method="post" action="{{url('delete/'.$item->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item"
                                                                type="submit">{{__('interface.Delete')}}</button>
                                                    </form>
                                                    <a href="{{url('edit/'.$item->id)}}" class="dropdown-item"
                                                       type="submit">{{__('interface.Edit')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$item->description}}</p>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="container">
                                <div class="row">
                                    <div class="text-left ml-0 col-md-4">
                                        <span>{{__('interface.Created by')}}: {{$item->user->username}}</span>
                                    </div>
                                    <div class="text-right mr-0 col-md-8">
                                        <span>{{__('interface.Created at')}}: {{$item->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{$advertising->links()}}
    </div>
@endsection
