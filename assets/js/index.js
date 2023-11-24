const $ = require('jquery');
require('@popperjs/core');
require('@fortawesome/fontawesome-free/js/all');
const tempusdominus = require('@eonasdan/tempus-dominus');

const picker = new tempusdominus
  .TempusDominus(document.getElementById('event_start_date'), {
    localization: {
      format: 'dd/MM/yyyy HH:mm',
  }
  });
const picker2 = new tempusdominus
  .TempusDominus(document.getElementById('event_end_date'), {
    localization: {
      format: 'dd/MM/yyyy HH:mm',
  }
  });

const event_filter_start = new tempusdominus
  .TempusDominus(document.getElementById('event_filter_start_date'), {
    localization: {
      format: 'dd/MM/yyyy HH:mm',
  }
  });
const event_filter_end = new tempusdominus
  .TempusDominus(document.getElementById('event_filter_end_date'), {
    localization: {
      format: 'dd/MM/yyyy HH:mm',
  }
  });


$(document).ready(function() {
});

