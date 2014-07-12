var GOLD_URL = 'http://www.trumba.com/calendars/gold.rss'; // the repo URL

define(["./jfeed", "./util", "jquery", "./hub"], function(jfeed, util, jQuery, hub) {
	return {
		feedData: null,
		retrieveData: function() {
			var selfRef = this;

			$.getFeed({
				url: util.proxify(GOLD_URL)
			}).done(function(data) {
				selfRef.feedData = data.firstChild;
				hub.goldDataLoaded(selfRef);
			});
		},
		hasData: function() {
			return this.feedData != null;
		},
		getItems: function() {
			var items = [];
			var xml = this.feedData;
  			$('item', xml).each(function(){
  				var item = [];
  				item['title'] = $('title', this).text();
  				item['description'] = $('description', this).text();

  				items.push(item);
            });
  			console.log(items);
            return items;
		}
	}
});