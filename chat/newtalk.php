<?php if (!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])) {
    header("Location: /login");
} ?>

<?php define("tabname", "Talk"); ?>
<?php include_once("../base/header.php"); ?>

<?php 
    $sid = getid($_GET["recipient"]);
?>

<div class="main" id="main">
  <h1>Chat with <?php echo htmlspecialchars($_GET["recipient"]) ?></h1>
  <div id="chat-container"></div>
  <form id="chat-form">
    <input type="text" id="message-input" placeholder="Type your message here">
    <button type="submit">Send</button>
  </form>
  <small>This chat is not moderated, so anything sent can and might be a scam message.<br>If you do not like the way a user is talking to you, please tell an admin.</small>
</div>

<script>
// Create a WebSocket connection
var socket = new WebSocket('ws://your-websocket-server-url');

// Event listener for WebSocket connection open
socket.onopen = function(event) {
  console.log('WebSocket connection established.');
};

// Event listener for WebSocket messages
socket.onmessage = function(event) {
  var messageData = JSON.parse(event.data);
  var message = messageData.message;
  var sender = messageData.sender;
  var isSent = messageData.isSent;

  displayMessage(message, sender, isSent);
};

// Event listener for WebSocket connection close
socket.onclose = function(event) {
  console.log('WebSocket connection closed.');
};

// Function to send a message via WebSocket
function sendMessage(event) {
  event.preventDefault();

  var messageInput = document.getElementById('message-input');
  var message = messageInput.value.trim();

  // Rest of your code to process and validate the message

  // Send the message via WebSocket
  socket.send(JSON.stringify({ message: message }));

  // Clear the message input field
  messageInput.value = '';
}

// Function to display a message in the chat container
function displayMessage(message, username, isSent) {
  var chatContainer = document.getElementById('chat-container');
  var messageContainer = document.createElement('div');
  messageContainer.classList.add('message');

  if (isSent) {
    messageContainer.classList.add('sent-message');
  } else {
    messageContainer.classList.add('received-message');
  }

  var mSg = document.createElement('p');
  mSg.textContent = message;

  // Create the username element
  var usernameElement = document.createElement('p');
  usernameElement.textContent = username;

  // Create the user container
  var userContainer = document.createElement('div');
  userContainer.classList.add('user-container');
  userContainer.appendChild(usernameElement);

  // Append the username and message elements to the message container
  messageContainer.appendChild(userContainer);
  messageContainer.appendChild(mSg);

  // Append the message container to the chat container
  chatContainer.appendChild(messageContainer);

  // Scroll to the bottom of the chat container
  chatContainer.scrollTop = chatContainer.scrollHeight;
}

// Add event listener to the chat form
var chatForm = document.getElementById('chat-form');
chatForm.addEventListener('submit', sendMessage);

</script>
</body>
</html>
