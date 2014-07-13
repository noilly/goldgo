require.config({
    baseUrl: 'scripts/',
    paths: {
        jquery: 'jquery'
    },
    urlArgs: "bust=" + (new Date()).getTime()
});

// require(["./util"], function(util) {
//     // pass
// });

// require(["./jfeed"], function(jfeed) {
//     // pass
// });

// require(["./gold"], function(gold) {
//     gold.retrieveData();
// });

// require(["./weather"], function(weather) {
//     weather.retrieveData();
// });

// require(["./slick"], function(slick) {
//     // pass
// });

require(["./jquery-migrate"], function(jm) {
    // pass
});

// require(["./events"], function(events) {
//     // pass
// });

// require(["./hub"], function(hub) {
//     // pass
// });

require(["./bootstrap"], function(bootstrap) {
    // pass
});

require(["jquery"], function($) {
    // pass
});