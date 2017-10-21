@extends('layouts.admin')

@section('content')
<h2>{{"Add New ".substr(ucfirst($data['table']),0,strlen($data['table'])-1)}}</h2>

<form method="POST" action="{{route('mastersave',[$data['table']])}}" enctype="multipart/form-data">
	{{csrf_field()}}
	@foreach($data['fields'] as $child)

	@if(in_array($child['type'],array('select','string','text','image')))
		@if($child['type']=="string")
		<div class="input-field col s12">
			<input type="text" id="{{$child['field']}}" name="{{$child['field']}}">
			<label>{{$child['name']}}</label>
		</div>
		@elseif($child['type']=="text")
		<div class="input-field col s12">
			<label>{{$child['name']}}</label>
			<textarea class="materialize-textarea" name="{{$child['field']}}" id="{{$child['field']}}" ></textarea>
		</div>
		@elseif($child['type']=="select" and $child['join']!="")
		<div class="input-field col s12">
			<select name="{{$child['field']}}" id="{{$child['field']}}" >
				<option value="">Select {{$child['name']}}</option>
				@foreach($data['join'][$child['join']]['all'] as $key)
				<option value="{{$key['id']}}">{{$key[$child['value']]}}</option>
				@endforeach
			</select>
			<label>{{$child['name']}}</label>
		</div>
		@elseif($child['type']=="image" and $child['value']=="upload")
		<div class="input-field file-field col s12">
		    <div class="btn waves-effect waves-light btn">
				<span><i class="material-icons left">image</i>{{$child['name']}}</span>
				<input type="file" name="{{$child['field']}}" id="{{$child['field']}}">
			</div>
			<div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		    </div>
		</div>
		@endif
	@endif

	@endforeach
	<button class="right btn waves-effect waves-light" type="submit" onclick="return validate()"><i class="material-icons left">save</i> Save</button>
</form>


			<script type="text/javascript">
				$(document).ready(function() {
					$("select").material_select();
				});
				function validate(){

					@foreach($data['fields'] as $child)

						@if(in_array($child['type'],array('select','string','text','image')))
						@if($child['required'])
							if($('#{{$child["field"]}}').val()==""){
								Materialize.toast('{{$child["name"]}} is required', 4000);
								return false;
							}

						@endif
						@endif
					@endforeach
					return true;
				}
			</script>
@endsection