<?php
	include_once('connection.php')
?>

<div class="form-group" style="margin-top: 15px;">
				<label>Company Name</label>
				<input type="text" name="txt_comp_insert" id="txt_comp_insert"  placeholder="Company" autocomplete="off">
				
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
$(function() {
    $("#txt_comp_insert").autocomplete({
        source: "search.php",
        select: function( event, ui ) {
            event.preventDefault();
            $("#txt_comp_insert").val(ui.item.id);
        }
    });
});
</script>