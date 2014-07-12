var WEATHER_URL = 'http://api.openweathermap.org/data/2.5/forecast/daily?q=brisbane,au&mode=json&units=metric&cnt=7'; // the repo URL

define(["./jfeed", "./util", "jquery", "./hub"], function(jfeed, util, jQuery, hub) {
	return {
		feedData: null,
		retrieveData: function() {
			var selfRef = this;

			$.ajax({
				url: util.proxify(WEATHER_URL),
				success: function(data) {
					selfRef.feedData = data;
					hub.weatherDataLoaded(selfRef);
				},
				dataType: 'json'
			});
		},
		hasData: function() {
			return this.feedData != null;
		},
		getItems: function() {
			return this.feedData.list
		}
	}
});