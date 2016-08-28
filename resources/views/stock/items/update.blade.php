@extends('layouts.master')

@section('title', 'Vehicles')

@section('scripts')
    <script src="{{ asset('js/job.js') }}"></script>
@endsection

@include('stock.menu')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        {{ $stockItem->label }}
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <form class="text-center">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <input type="text" class="form-control" name="label" placeholder="Label" value="{{ $stockItem->label }}">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="label" placeholder="Label">{{ $stockItem->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="stock_type_id" title="Stock Type">
                                @if(!empty($stockTypes))
                                    @foreach($stockTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->label }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Save</button>
                    </form>
                </div>
                <div class="panel-footer text-center">
                    <a type="button" class="btn btn-xs btn-warning" href="{{ url('stock-items') }}">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
