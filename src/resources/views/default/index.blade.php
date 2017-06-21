@extends('crud::layouts.app')

@section('content')
    <section class="content-header">
        <div class="row">
            <div class="col-xs-12">
                {{ Html::link(route($route.'.create'), trans('Create'), ['class' => 'btn btn-primary pull-right']) }}
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans(ucfirst($model->pageTitle)) }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="professionalsTable">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">{{ trans('ID') }}</th>
                                    @foreach($model->getVisible() as $visible)
                                        <th class="column-title">{{ trans(ucfirst($visible)) }}</th>
                                    @endforeach
                                    <th class="column-title no-link last"><span class="nobr">{{ trans('Actions') }}</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data->items() as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        @foreach($model->getVisible() as $visible)
                                            <td>{{ $item->getAttributeValue($visible) }}</td>
                                        @endforeach
                                        <td class="text-right">
                                            @include($viewsFolder .'.actions', ['route' => $route, 'id' => $item->id])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
