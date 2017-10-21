@extends('layouts.admin')

@section('content')
<h2>{{"All ".ucfirst($data['table'])}}</h2>

<a class="btn" href="{{route('masteradd',[$data['table']])}}">{{"Add New ".substr(ucfirst($data['table']),0,strlen($data['table'])-1)}}</a>

<table class="bordered highlight centered">
	<thead>
		<tr>
			@foreach($data['fields'] as $key)
			<th>{{$key['name']}}</th>
			@endforeach
			<th class="center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data['all'] as $child)
		<tr>
			@foreach($data['fields'] as $key)
			@if($key['join']=="")
			<td>{{$child[$key['field']]}}</td>
			@else
			<td>{{ $child[$key['join']]!=null?$child[$key['join']]->{$key['value']}:"No Data" }}</td>
			@endif
			@endforeach
			<td class="center"><a class="waves-effect waves-light btn blue" href="{{route('masteredit',[$data['table'],$child->id])}}">Edit</a> <a class="modal-trigger waves-effect waves-light btn red" href="#dialog_delete_{{$child->id}}">Delete</a></td>
		</tr>
		@endforeach
	</tbody>
</table>


		@foreach($data['all'] as $child)
		  <!-- Modal Structure -->
		  <div id="dialog_delete_{{$child->id}}" class="modal">
		    <div class="modal-content">
		      <p>Are you sure you want to delete this data?</p>
		      	<table>
		      	@foreach($data['fields'] as $key)
		      	<tr>
				<th>{{$key['name']}}</th>
				@if($key['join']=="")
				<td>{{$child[$key['field']]}}</td>
				@else
				<td>{{ $child[$key['join']]!=null?$child[$key['join']]->{$key['value']}:"No Data" }}</td>
				@endif
				@endforeach
		      	</tr>
				</table>
		    </div>
		    <div class="modal-footer">
		      <a href="{{route('masterdelete',[$data['table'],$child->id])}}" class="modal-action waves-effect waves-red btn"><i class="material-icons left">check</i> Yes</a>
		      <a class="modal-action modal-close waves-effect waves-green btn" ><i class="material-icons left">close</i> No</a>
		    </div>
		  </div>
		@endforeach

<script type="text/javascript">
	 $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>
@endsection