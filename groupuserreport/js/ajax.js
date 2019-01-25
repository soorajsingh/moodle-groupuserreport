function apply(M,elem,secelem){
	$('#' + secelem).html('<option value="">Select Group</option>');
	$('#' + elem).change(function(M){
	var val=$('#' + elem).val();
		$.ajax({
				 type : "POST",
				 url: "fetch.php",
				 data: {id:val},  
				 beforeSend:function(){
				 },
				   success: function (result) {
						$("#"+secelem).html(result); 
				   }
		 }); 
	});
}