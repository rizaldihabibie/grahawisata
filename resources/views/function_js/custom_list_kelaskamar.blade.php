<script>

//iCheckbox and iRadion - custom elements
    function init_checkbox(){
        if($(".icheckbox").length > 0){
             $(".icheckbox,.iradio").on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed check ', function(event){ 
            if(event.type ==="ifChecked"){
                $(this).trigger('click');  
                $('input').iCheck('update');
            }
            if(event.type ==="ifUnchecked"){
                $(this).trigger('click');  
                $('input').iCheck('update');
            }       
            }).iCheck({
                checkboxClass: 'icheckbox_minimal-grey',radioClass: 'iradio_minimal-grey',
                increaseArea: '20%'
            });
        }
    } 
    init_checkbox();
</script>