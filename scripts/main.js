require.config({
    baseUrl: 'scripts/',
    paths: {
    //     // the left side is the module ID,
    //     // the right side is the path to
    //     // the jQuery file, relative to baseUrl.
    //     // Also, the path should NOT include
    //     // the '.js' file extension. This example
    //     // is using jQuery 1.9.0 located at
    //     // js/lib/jquery-1.9.0.js, relative to
    //     // the HTML page.
         jquery: 'jquery',
         async: 'async'
    },
    urlArgs: "bust=" + (new Date()).getTime()
});

require(["./util"], function(util) {
    //This function is called when scripts/helper/util.js is loaded.
    //If util.js calls define(), then this function is not fired until
    //util's dependencies have loaded, and the util argument will hold
    //the module value for "helper/util".
});

require(["./jfeed"], function(jfeed) {
    //This function is called when scripts/helper/util.js is loaded.
    //If util.js calls define(), then this function is not fired until
    //util's dependencies have loaded, and the util argument will hold
    //the module value for "helper/util".
});

require(["./gold"], function(gold) {
    gold.retrieveData();
});

require(["./jquery-migrate"], function(jm) {
    //This function is called when scripts/helper/util.js is loaded.
    //If util.js calls define(), then this function is not fired until
    //util's dependencies have loaded, and the util argument will hold
    //the module value for "helper/util".
});

require(["./hub"], function(hub) {
    //This function is called when scripts/helper/util.js is loaded.
    //If util.js calls define(), then this function is not fired until
    //util's dependencies have loaded, and the util argument will hold
    //the module value for "helper/util".
});