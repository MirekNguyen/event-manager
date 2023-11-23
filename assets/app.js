/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
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
