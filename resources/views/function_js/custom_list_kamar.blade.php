<script>

function call_modal_add_kamar(id_kelas,nama_kelas){
	 modal_add_kamar(id_kelas,nama_kelas);
}

function modal_add_kamar(id_kelas,nama_kelas){
      var id = $("#add_id_kelas").val(id_kelas).prop('readonly', true);
      var nama = $("#add_nama_kelas").val(nama_kelas).prop('readonly', true);
      $('#call_modal_add_kamar').modal({
          keyboard: false  // to prevent closing with Esc button (if you want this too)
      });
}

</script>