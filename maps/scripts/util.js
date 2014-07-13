var PROXY = './proxy.php?url='

define(function() {
    return {
        proxify: function(url) {
			return PROXY + url;
		}
	}
});