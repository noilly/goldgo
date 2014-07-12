define(function() {
    return {
    	events: null,
    	hasEvents: function() {
    		return this.events != null;
    	},
    	populate: function(gold) {
    		var result = [];
    		var events = gold.getItems();

    		console.log(events);
    	}
    }
});