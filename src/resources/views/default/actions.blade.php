<a href="{{ route("{$route}.show", ['id' => $id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> {{ trans('View') }}</a>
<a href="{{ route("{$route}.edit", ['id' => $id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
{!! Form::open(['url' => route("{$route}.destroy", ['id' => $id]), 'method' => 'POST', 'style' => 'vertical-align: middle; display: inline-block;']) !!}
{{ method_field('DELETE') }}
{{ Form::button("<i class='fa fa-trash-o'></i> ".trans('Delete'), ['class' => 'btn btn-danger btn-xs', 'onclick' => 'submit(this)']) }}
{!! Form::close() !!}
