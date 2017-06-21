@extends('crud::layouts.app')

@section('content')
    <section class="content-header">
        <div class="row">
            <div class="col-xs-12">

            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('Edit '.$entity->pageTitle ) }}</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['route' => [$route.'.update', 'id' => $entity->id], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}

                        @foreach($entity->formFields as $key => $options)
                            @if(array_get($options, 'exclude_in_view') != 'edit')
                            <div class="form-group{{ $errors->has($key) ? ' has-error' : '' }}">
                                {{ Form::label('type', trans(ucfirst($key))." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                                        $value = '';
                                        if (!array_get($options, 'hide_value')) {
                                            $value = $entity->getAttributeValue($key);
                                        }
                                    ?>
                                    {{ Form::input(array_get($options, 'type', 'text'),$key, $value, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                    @if ($errors->has($key))
                                        <span class="help-block">
                                        <strong>{{ $errors->first($key) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                {{ Form::submit(trans('Update'), ['class' => 'btn btn-success']) }}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
