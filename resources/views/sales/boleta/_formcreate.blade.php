@csrf
<div class="form-group">
	<div class="row">
		<div class="col-4">
      		<label for="idcantidad">Ingrese&nbsp;cantidad:</label>
   			<input type="text" class="form-control" id="idcantidad" name="quantity" onfocusout="operacion(this.value)" value="1.00" onkeypress='return validaNumdouble(event)'>
    	</div>
    	<div class="col-8">
      		<label for="iddescripcion">Descripción:</label>
   			<input type="text" class="form-control" id="iddescripcion" name="description" readonly>
            <input type="text" name="measure" value="UND" hidden>
            <input type="text" name="sale_code" value="B001-00000010" hidden>
    	</div>
	</div>
</div>
<div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="igvid" onclick="desa()">
      <label class="form-check-label" for="igvid">
        IGV
      </label>
    </div>
  </div>
<div class="form-group">
	<label for="preciounitid">Precio&nbsp;unitario:</label>
   	<input type="text" class="form-control" id="preciounitid" name="unity_price" onfocusout="operacion(this.value)" onkeypress='return validaNumdouble(event)'>
</div>
<div class="form-group">
	<label for="impostid">Impuesto:</label>
   	<input type="text" class="form-control" id="impostid" name="impost_mount" onfocusout="operacion(this.value)" value="0.00" onkeypress='return validaNumdouble(event)' readonly>
</div>
<div class="form-group">
	<label for="subtotalid">Subtotal:</label>
   	<input type="text" class="form-control" id="subtotalid" name="subtotal_mount" readonly>
</div>
<div class="form-group">
	<label for="totalsaleid">Total&nbsp;venta:</label>
   	<input type="text" class="form-control" id="totalsaleid" name="total_mount" onkeypress='return validaNumdouble(event)'>
</div>
<button type="submit" class="btn btn-outline-info">Registrar</button>
<script>
function desa() {
    var tot = $("#totalsaleid").val();
    var igv = parseFloat(tot)*18/100;
    var subtot = parseFloat(tot)-parseFloat(igv);
    // alert('msg');
    if($(".form-check-input").prop('checked') == true){
        // alert("checked");
        $("#impostid").val(igv.toFixed(2));
        $("#totalsaleid").val(parseFloat(tot).toFixed(2));
        $("#subtotalid").val(subtot.toFixed(2));
        // alert(subtot);

    }
    if($(".form-check-input").prop('checked') == false){
        // alert("nochecked");
        $("#impostid").val('0.00');
        $("#totalsaleid").val(parseFloat(tot).toFixed(2));
        $("#subtotalid").val(parseFloat(tot).toFixed(2));
    }
 }
 function operacion(val) {
    var var1 = $("#idcantidad").val();
    var var2 = $("#preciounitid").val();
    var tot = $("#totalsaleid").val();

    if($(".form-check-input").prop('checked') == true){
        // alert("checked");
        if(val==var1) {
            // alert("igv"+igv);
        var total = parseFloat(var1)*parseFloat(var2);
        var igv = parseFloat(total)*18/100;
        var subtot = parseFloat(total)-parseFloat(igv);
        // alert((parseFloat(val)).toFixed(2));
        $("#idcantidad").val((parseFloat(val)).toFixed(2))
        $("#impostid").val(igv.toFixed(2));
        $("#totalsaleid").val(total.toFixed(2));
        $("#subtotalid").val(subtot.toFixed(2));
     }
     if(val==var2) {
        // alert("checked");
        var total = parseFloat(var1)*parseFloat(var2);
        var igv = parseFloat(total)*18/100;
        var subtot = parseFloat(total)-parseFloat(igv);
        $("#preciounitid").val((parseFloat(val)).toFixed(2))
        $("#impostid").val(igv.toFixed(2));
        $("#totalsaleid").val(total.toFixed(2));
        $("#subtotalid").val(subtot.toFixed(2));
     }

    }
    if($(".form-check-input").prop('checked') == false){
        // alert("nochecked");
        if (val==var1) {
        total = parseFloat(var1)*parseFloat(var2);
        // alert((parseFloat(val)).toFixed(2));
        $("#idcantidad").val((parseFloat(val)).toFixed(2))
        $("#totalsaleid").val(total.toFixed(2));
        $("#subtotalid").val(total.toFixed(2));
        $("#impostid").val('0.00');
     }
     if(val==var2) {
        total = parseFloat(var1)*parseFloat(var2);
        // alert((parseFloat(val)).toFixed(2));
        $("#preciounitid").val((parseFloat(val)).toFixed(2))
        $("#totalsaleid").val(total.toFixed(2));
        $("#subtotalid").val(total.toFixed(2));
        $("#impostid").val('0.00');
     }
    }
  }
</script>
