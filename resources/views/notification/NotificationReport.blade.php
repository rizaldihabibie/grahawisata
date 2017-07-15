<div class="row"> 	
	@if ($errors->any())
	    <div class="alert alert-danger">
	        @foreach($errors->all(':message') as $error)
	            {{ $error }} <?php echo "</br>"; ?>
	        @endforeach
	    </div>
	@endif

	@if (Session::has('success'))
	    <div class="alert alert-success">
	        <p class="text-center">{{ Session::get('success') }} </p>
	    </div>
	@elseif (Session::has('login_success'))
	    <div class="alert alert-success">
	        <p class="text-center">{{ Session::get('login_success') }}  <strong> {{Auth::user()->username}} </strong> </p>
	    </div>
	@elseif (Session::has('error_notif'))
	    <div class="alert alert-danger">
	        <p class="text-center">{{ Session::get('error_notif') }}  </p>
	    </div>
	@endif
</div>