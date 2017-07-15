<script>
	function call_modal_del_promo(kode){
      var id = $("#del_kd_promo").val(kode).prop('readonly', true);
      $('#modal_del_promo').modal({
          keyboard: false  // to prevent closing with Esc button (if you want this too)
      });

	}
</script>