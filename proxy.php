<!DOCTYPE html>
<html>
<head>
  <script>
function proxyRequest(url) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "proxy-backend?url=" + encodeURIComponent(url), true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status >= 200 && xhr.status < 300) {
        // Success response (2xx), process the content
        var response = xhr.responseText;
        handleResponse(response);
      } else if (xhr.status >= 300 && xhr.status < 400) {
        // Redirect response (3xx), handle the redirect
        var redirectUrl = xhr.getResponseHeader("Location");
        if (redirectUrl) {
          proxyRequest(redirectUrl); // Proxy the redirected URL
        } else {
          console.log("Redirect URL not found in response headers.");
        }
      } else {
        // Error response, handle the error
        console.log("Error response: " + xhr.status);
      }
    }
  };
  xhr.send();
}

function handleResponse(response) {
  // Create a dummy element to parse the response as HTML
  var dummyElement = document.createElement('html');
  dummyElement.innerHTML = response;

  // Handle JavaScript-based redirects
  var redirectMeta = dummyElement.querySelector('meta[http-equiv="refresh"]');
  if (redirectMeta) {
    var content = redirectMeta.getAttribute('content');
    if (content && content.match(/url=/i)) {
      var urlStartIndex = content.indexOf('url=') + 4;
      var redirectUrl = content.substring(urlStartIndex);
      redirectUrl = redirectUrl.trim();
      proxyRequest(redirectUrl); // Proxy the redirected URL
      return; // Stop further processing
    }
  }

  // Replace URLs of specific elements

  // Images
  var imgElements = dummyElement.getElementsByTagName('img');
  for (var i = 0; i < imgElements.length; i++) {
    var img = imgElements[i];
    var imgUrl = img.getAttribute('src');
    img.setAttribute('src', modifyUrl(imgUrl));
  }

  // Links
  var linkElements = dummyElement.getElementsByTagName('a');
  for (var j = 0; j < linkElements.length; j++) {
    var link = linkElements[j];
    var linkUrl = link.getAttribute('href');
    link.setAttribute('href', modifyUrl(linkUrl));
  }

  // Scripts
  var scriptElements = dummyElement.getElementsByTagName('script');
  for (var k = 0; k < scriptElements.length; k++) {
    var script = scriptElements[k];
    var scriptUrl = script.getAttribute('src');
    if (scriptUrl) {
      script.setAttribute('src', modifyUrl(scriptUrl));
    }
  }

  // Stylesheets
  var linkStylesheetElements = dummyElement.querySelectorAll('link[rel="stylesheet"]');
  for (var l = 0; l < linkStylesheetElements.length; l++) {
    var linkStylesheet = linkStylesheetElements[l];
    var stylesheetUrl = linkStylesheet.getAttribute('href');
    linkStylesheet.setAttribute('href', modifyUrl(stylesheetUrl));
  }

  // Get the modified HTML content
  var modifiedResponse = dummyElement.innerHTML;

  // Replace the current page content with the modified response
  document.open();
  document.write(modifiedResponse);
  document.close();
}

function modifyUrl(url) {
  // Modify the URL as needed (e.g., prepend a domain, replace parts of the URL, etc.)
  // Return the modified URL
  return url;
}
  </script>
</head>
<body>
  <h1>Proxy Page</h1>
  <p>Enter the URL you want to proxy:</p>
  <input type="text" id="urlInput">
  <button onclick="proxyRequest(document.getElementById('urlInput').value)">Proxy Request</button>
</body>
</html>
