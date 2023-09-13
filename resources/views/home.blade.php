@extends('lay.html')

@section('content')
<form class="form" action="{{route('create-link')}}">
	<input type="text" name="link" autocomplete="off"/>
	<button>Create</button>
</form>
<div class="modal">
	<div class="modal-container">
		<input type="text" id="result-link" autocomplete="off" disabled/>
		<button id="result-button">Copy to buffer</button>
		<button id="reset">Close</button>
	</div>
</div>
@endSection()