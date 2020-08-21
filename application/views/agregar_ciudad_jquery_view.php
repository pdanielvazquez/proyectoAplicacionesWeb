<script>
	
	$(function(){

		$('.btn-agregar').on('click', function(){
			var contador = parseInt($('#conta_carrito').html());
			contador++;
			$('#conta_carrito').html(contador);
			$(this).attr('disabled', 'disabled');

		});

	});

</script>