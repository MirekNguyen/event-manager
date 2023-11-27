require('@popperjs/core');
require('@fortawesome/fontawesome-free/js/all');
const tempusdominus = require('@eonasdan/tempus-dominus');

const startDatePicker = new tempusdominus
  .TempusDominus(document.getElementById('event_start_date'), {
    localization: {
      format: 'dd/MM/yyyy HH:mm',
      locale: 'cs-GB',
  }
  });
const endDatePicker = new tempusdominus
  .TempusDominus(document.getElementById('event_end_date'), {
    localization: {
      format: 'dd/MM/yyyy HH:mm',
      locale: 'en-GB',
  }
  });

