$(document).ready(function() {
  $.tablesorter.addWidget({
    // give the widget an id
    id: "sortPersist",
    // format is called in the on init and when a sorting has finished
    format: function(table) {

      // Cookie info
      var cookieName = 'viewgit_tablesorts';
      var cookie = $.cookie(cookieName);
      var options = {path: '/', expires: 365 };

      var data = {};
      var sortList = table.config.sortList;
      var tableId = $(table).attr('id');
      var cookieExists = (typeof(cookie) != "undefined" && cookie != null);

      // If the existing sortList isn't empty, set it into the cookie and get out
      if (sortList.length > 0) {
        if (cookieExists) {
          data = JSON.parse(cookie);
        }
        data[tableId] = sortList;
        $.cookie(cookieName, JSON.stringify(data), options);
      }

      // Otherwise...
      else {
        if (cookieExists) { 

          // Get the cookie data
          var data = JSON.parse($.cookie(cookieName));

          // If it exists
          if (typeof(data[tableId]) != "undefined" && data[tableId] != null) {

            // Get the list
            sortList = data[tableId];

            // And finally, if the list is NOT empty, trigger the sort with the new list
            if (sortList.length > 0) {
              $(table).trigger("sorton", [sortList]);
            }
          }
        }
      }
    }
  });
});