/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/artists.js ***!
  \*********************************/
$(window).on("load", function () {
  function fetchRequest(page, sort_type, sort_by) {
    $.ajax({
      url: "/art/requests/fetch?page=" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type,
      success: function success(data) {}
    });
  }
});
/******/ })()
;