var URL = 'http://www.trumba.com/calendars/gold.rss?filterview=gold'; // the repo URL

define(["./jfeed", "./util", "jquery"], function(jfeed, util) {
	$.getFeed({
		url: util.proxify(URL),
		success: function(feed) {
			console.log(feed.items)
		}
	});

    return {
        // color: "blue",
        // size: "large",
        // addToCart: function() {
        //     inventory.decrement(this);
        //     cart.add(this);
        // }
    }
});