<script>

function call_modal_edit_privilege(id_pengguna,nama_pengguna){
	 modal_edit_privilege(id_pengguna,nama_pengguna);
}

function modal_edit_privilege(id_pengguna,nama_pengguna){
      // var id = $("#add_id_kelas").val(id_kelas).prop('readonly', true);
      // var nama = $("#add_nama_kelas").val(nama_kelas).prop('readonly', true);
      $("#nama_pengguna").text("User - " + nama_pengguna);
      $("#modal_name").val(nama_pengguna).prop('readonly', true);
      $('#modal_edit_privilege').modal({
          keyboard: false  // to prevent closing with Esc button (if you want this too)
      });
}

</script>