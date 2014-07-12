define(['./events'], function(events)  {
	return {
		goldData: false,
		goldDataLoaded: function(gold) {
			goldData = true;
			events.populate(gold);
		},
		weatherDataLoaded: function(weather) {
			//console.log(weather.getItems());
		}
	}
});