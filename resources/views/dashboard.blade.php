<html lang="en">
  <head>
    <title>Vehicle Tracker</title>
    <script  src="https://maps.googleapis.com/maps/api/js?libraries=drawing,places,geometry&key={{$apiKey}}&callback=initMap"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="twitter:card" content="summary_large_image" />
    <style>
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6 {  margin: 0;  padding: 0;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}
    </style>
    <style>
      html {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen","Ubuntu", "Cantarell", "Fira Sans","Droid Sans", "Helvetica Neue", sans-serif;
        font-size: 1.12rem;
      }

      body {
        font-weight: 300;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.75;
        color: var(--dl-color-gray-900);
        background-color: var(--dl-color-gray-white);

      }
    </style>
  </head>
  <body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}"></script>
    <!--<script src="https://unpkg.com/@teleporthq/teleport-custom-scripts"></script>-->
  </body>
</html>
