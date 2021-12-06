$( document ).ready( function() 
{
	$("select[name='user_type']").change( function(e) 
	{
		let value = $(this).val();
		let target = $(this).data('target');
		
		if( value == 'doctor') 
		{
			$(`${target}`).show();
		}else{
			$(`${target}`).hide();
		}
	});

});