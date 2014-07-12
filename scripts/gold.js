var URL = 'http://www.trumba.com/calendars/gold.rss'; // the repo URL

define(["./jfeed", "./util", "jquery", "hub"], function(jfeed, util, jQuery, hub) {
	return {
		feedData: null,
		retrieveData: function() {
			selfRef = this;

			$.getFeed({
				url: util.proxify(URL),
				success: function(feed) {
					
				}
			}).done(function(data) {
				selfRef.feedData = data.firstChild;
				hub.goldDataLoaded(selfRef);
			});
		},
		hasData: function() {
			return feedData != null;
		},
		getItems: function() {
			var xml = this.feedData;
  			var $xml = $(xml);
  			var $items = $xml.find('item');

  			return $items;
		}
	}
});