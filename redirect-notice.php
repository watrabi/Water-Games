<?php
// Get the URL parameter from the query string
if (isset($_GET['url'])) {
  $url = $_GET['url'];

  // Display the notice or message to the user
  echo "<h1>Redirect Notice</h1>";
  echo "<p>You are about to be redirected to an external website.</p>This website is not moderated by water games or is hosted on water games.</p>";

  // Add any additional content or styling as needed

  // Redirect the user to the actual website after a delay
  echo "<script>
          setTimeout(function() {
            window.location.href = '$url';
          }, 5000); // Redirect after 3 seconds
        </script>";
} else {
  // No URL parameter provided, redirect the user to a default page
  header("Location: /chat/index");
  exit;
}
?>
