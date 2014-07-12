var PROXY = './proxy.php?url='

define(function() {
    return {
        proxify: function(externalUrl) {
			return PROXY + externalUrl;
		}
	}
});