const $ = require('jquery');
require('@popperjs/core');
require('@fortawesome/fontawesome-free/js/all');
const tempusdominus = require('@eonasdan/tempus-dominus');

const event_filter_start = new tempusdominus
  .TempusDominus(document.getElementById('event_filter_start_date'), {
    localization: {
      format: 'dd/MM/yyyy',
  }
  });
const event_filter_end = new tempusdominus
  .TempusDominus(document.getElementById('event_filter_end_date'), {
    localization: {
      format: 'dd/MM/yyyy',
  }
  });
