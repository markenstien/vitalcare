const URL = 'https://corefounders.com';

const DS  = '/';

const getURL = function(called_url = null){

	if(called_url != null) {

		return URL+DS+called_url;
	}

	else{
		return URL;
	}

};

function hide_delay(target , duration = 10000)
{
	$(target).delay(duration).hide();
}
