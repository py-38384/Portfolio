<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Magnific Popup YouTube Fixed</title>

  <!-- Magnific Popup CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 50px;
      text-align: center;
    }

    .popup-youtube {
      display: inline-block;
      background-color: #ff0000;
      color: #fff;
      padding: 14px 28px;
      font-size: 18px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
    }

    .popup-youtube:hover {
      background-color: #cc0000;
    }
  </style>
</head>
<body>

  <h2>🎬 YouTube Video Popup (No Playback Error)</h2>

  <!-- NOTE: use full YouTube URL with watch?v= -->
  <a class="popup-youtube" href="https://www.youtube.com/watch?v=DEeaT6FxEws">
    ▶️ Watch Video
  </a>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Magnific Popup JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.popup-youtube').magnificPopup({
        type: 'iframe',
        iframe: {
          patterns: {
            youtube: {
              index: 'youtube.com/',
              id: 'v=',
              src: 'https://www.youtube.com/embed/%id%?autoplay=1'
            }
          }
        },
        mainClass: 'mfp-fade',
        removalDelay: 300,
        preloader: false,
        fixedContentPos: false
      });
    });
  </script>

</body>
</html>
