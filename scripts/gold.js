var URL = 'http://www.trumba.com/calendars/gold.rss?filterview=gold'; // the repo URL

define(["./jfeed", "./util", "jquery", "hub"], function(jfeed, util, jQuery, hub) {
	return {
		items: null,
		retrieveData: function() {
			selfRef = this;

			$.getFeed({
				url: util.proxify(URL),
				success: function(feed) {
					selfRef.items = feed.items;
				    hub.goldDataLoaded(selfRef);
				}
			});
		}
	}
});