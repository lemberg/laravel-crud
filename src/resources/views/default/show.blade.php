@extends('crud::layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">

            </div>
            {!! Form::open([route($route.'.destroy', ['id' => $entity->id]), 'method' => 'POST', 'class' => 'pull-right']) !!}
            {{ method_field('DELETE') }}
            {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['onclick' => 'deleteItem(this)', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans($entity->pageTitle ? $entity->pageTitle : '') }} / {{$entity->id}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        @foreach($entity->getVisible() as $visible)
                            <strong>{{ trans(ucfirst($visible)) }}:</strong> {{ $entity->getAttributeValue($visible)}}<br>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
