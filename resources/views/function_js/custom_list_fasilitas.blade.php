<script>

function call_modal_edit_fasilitas(id_fasilitas){
	url =  '{{ url("get_fasilitas") }}';
	$.ajax({
	    headers: { 'X-CSRF-TOKEN': $('meta[name="my_token"]').attr('content')},
		type:'POST',
      	cache:'false',
      	dataType: 'json',
		url : url,
      	data: {'id': id_fasilitas},
      	success: function(data){
                  console.log(data);
                  if(data['mssg_report'] == 'sukses'){
                     modal_edit_fasilitas(data);
                  }
      	},
      	error: function(data) {
      		console.log(data);
      	}

	});
}

function call_modal_del_fasilitas(id_fasilitas){
  url =  '{{ url("get_fasilitas") }}';
  $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="my_token"]').attr('content')},
        type:'POST',
        cache:'false',
        dataType: 'json',
        url : url,
        data: {'id': id_fasilitas},
        success: function(data){
                  console.log(data);
                  if(data['mssg_report'] == 'sukses'){
                     modal_delete_fasilitas(data);
                  }
        },
        error: function(data) {
          console.log(data);
        }

  });
}

function modal_edit_fasilitas(data){
      var id = $("#edt_id_fasilitas").val(data[0]['id_fasilitas']).prop('readonly', true);
      var nama = $("#edt_nama_fasilitas").val(data[0]['nama_fasilitas']);
      // $("#modal_edit_fasilitas").modal("show");
      $('#modal_edit_fasilitas').modal({
          // backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
      });
}

function modal_delete_fasilitas(data){
      var id = $("#del_id_fasilitas").val(data[0]['id_fasilitas']).prop('readonly', true);
      var nama = $("#del_nama_fasilitas").html(data[0]['nama_fasilitas']);
      // $("#modal_edit_fasilitas").modal("show");
      $('#modal_delete_fasilitas').modal({
          // backdrop: 'static',
          keyboard: false  // to prevent closing with Esc button (if you want this too)
      });
}



</script>