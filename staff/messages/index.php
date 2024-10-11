<?php
// Function to retrieve users with messages and their message count
function get_users_with_messages($conn)
{
	$query = "
        SELECT c.id, c.firstname, c.lastname, COUNT(m.id) AS message_count
        FROM clients c 
        JOIN messages m ON c.id = m.sender_id
        GROUP BY c.id
    ";
	return $conn->query($query);
}

// Function to retrieve messages for a specific user
function get_messages_for_user($conn, $user_id)
{
	$query = "
        SELECT m.message, m.created_at, c.firstname, c.lastname 
        FROM messages m 
        JOIN clients c ON m.sender_id = c.id 
        WHERE m.sender_id = ? 
        ORDER BY m.created_at ASC
    ";

	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();
	return $stmt->get_result();
}

// Retrieve user_id from session
$user_id = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : null;
$username = isset($_SESSION['userdata']['username']) ? $_SESSION['userdata']['username'] : null;

// Check for flash messages
if ($_settings->chk_flashdata('success')): ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success');
	</script>
<?php endif; ?>
<?php if ($_settings->chk_flashdata('error')): ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('error') ?>", 'error');
	</script>
<?php endif; ?>

<!-- Secondary Sidebar for users with messages -->
<div class="second-sidebar">
	<h4>Users with Messages</h4>
	<ul>
		<?php
		// Fetch users who have messages
		$result = get_users_with_messages($conn);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo '<li>
                        <a href="#" class="chat-link" data-user-id="' . $row['id'] . '" data-user-name="' . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . '">
                            <i class="fas fa-comment-alt"></i> ' . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . ' 
                            <span style="margin-left: auto; display: flex; align-items: center;">
                                <i class="fas fa-envelope" style="margin-right: 5px;"></i>' . $row['message_count'] . '
                            </span>
                        </a>
                    </li>';
			}
		} else {
			echo '<li>No users found.</li>';
		}
		?>
	</ul>
</div>

<!-- Chat Container -->
<div class="chat-container" id="chat-container" style="position: fixed; bottom: 0; right: 250px; width: 300px; height: 400px; display: none; flex-direction: column; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
	<div class="chat-header" style="background-color: #ff6b6b; color: white; padding: 10px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
		<strong id="chat-header-title">Chat Support</strong>
		<button id="close-chat" style="float: right; border: none; background: none; color: white;">&times;</button>
	</div>
	<div class="chat-messages" id="chat-messages" style="flex-grow: 1; overflow-y: auto; padding: 10px;">
		<!-- Messages will be dynamically added here -->
	</div>
	<div class="chat-input" style="display: flex; padding: 10px;">
		<input type="text" id="message-input" placeholder="Type your message..." style="flex-grow: 1; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
		<button id="send-message" style="border: none; background-color: #ff6b6b; color: white; padding: 5px 10px; border-radius: 4px; margin-left: 5px;">Send</button>
	</div>
</div>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
	.second-sidebar {
		width: 250px;
		height: 100%;
		background: #f4f4f4;
		padding: 15px;
		position: fixed;
		right: 0;
		top: 0;
		border-left: 1px solid #ddd;
		overflow-y: auto;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		border-radius: 5px;
	}

	.second-sidebar h4 {
		margin: 0 0 15px;
		font-size: 1.2em;
		color: #555;
	}

	.second-sidebar ul {
		list-style-type: none;
		padding: 0;
	}

	.second-sidebar ul li {
		margin: 10px 0;
	}

	.second-sidebar ul li a {
		text-decoration: none;
		color: #333;
		padding: 8px 10px;
		display: flex;
		align-items: center;
		border-radius: 5px;
		transition: background 0.3s, transform 0.2s;
	}

	.second-sidebar ul li a:hover {
		background: #ddd;
		transform: scale(1.02);
	}

	.second-sidebar ul li a i {
		margin-right: 8px;
		color: #007bff;
	}

	.second-sidebar ul li a span {
		margin-left: auto;
		color: #666;
		font-size: 0.9em;
	}

	.chat-container {
		display: flex;
		flex-direction: column;
	}

	/* General styling for chat messages */
	.chat-messages {
		display: flex;
		flex-direction: column;
		overflow-y: auto;
		padding: 10px;
		max-height: 400px;
	}

	.message-container {
		margin-bottom: 10px;
		padding: 10px;
		border-radius: 10px;
		max-width: 60%;
	}

	/* Customer message styling - aligned to the left */
	.customer-message {
		background-color: #f1f1f1;
		align-self: flex-start;
		/* Align messages to the left */
		border-top-left-radius: 0;
	}

	/* Staff message styling - aligned to the right */
	.staff-message {
		background-color: #d1e7ff;
		align-self: flex-end;
		/* Align messages to the right */
		border-top-right-radius: 0;
	}

	/* Styling for message content */
	.message-content {
		word-wrap: break-word;
	}
</style>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Select the chat container
		const chatContainer = document.getElementById("chat-container");
		const chatHeaderTitle = document.getElementById("chat-header-title");
		const chatMessages = document.getElementById("chat-messages");
		const messageInput = document.getElementById("message-input");
		const closeChatButton = document.getElementById("close-chat");
		const sendMessageButton = document.getElementById("send-message");

		// Open chat when a user link is clicked
		document.querySelectorAll('.chat-link').forEach(link => {
			link.addEventListener('click', function(e) {
				e.preventDefault();
				const userId = this.getAttribute('data-user-id');
				const userName = this.getAttribute('data-user-name');

				// Update chat header title
				chatHeaderTitle.textContent = `Chat with ${userName}`;

				// Show chat container
				chatContainer.style.display = "flex";
				chatMessages.innerHTML = ''; // Clear previous messages

				// Fetch messages for the selected user
				fetchMessages(userId);
				sendMessageButton.setAttribute('data-user-id', userId);
			});
		});

		function fetchMessages(userId) {
			const xhrMessages = new XMLHttpRequest();
			const xhrReplies = new XMLHttpRequest();
			const chatMessages = document.getElementById('chat-messages');

			// Fetch customer messages
			xhrMessages.open("GET", "http://localhost/cosmetics-shop/staff/messages/fetch_messages.php?sender_id=" + userId, true);
			xhrMessages.onload = function() {
				if (xhrMessages.status === 200) {
					const messages = JSON.parse(xhrMessages.responseText);
					messages.forEach(msg => {
						const messageElement = document.createElement("div");
						messageElement.className = 'message-container customer-message';
						messageElement.innerHTML = `
                    <div class="message-content">
                        <strong>${msg.firstname} ${msg.lastname}</strong>: ${msg.message}
                    </div>
                `;
						chatMessages.appendChild(messageElement);
					});
					chatMessages.scrollTop = chatMessages.scrollHeight;
				}
			};
			xhrMessages.send();

			// Fetch staff replies
			xhrReplies.open("GET", "http://localhost/cosmetics-shop/staff/messages/fetch_replies.php?sender_id=" + userId, true);
			xhrReplies.onload = function() {
				if (xhrReplies.status === 200) {
					const replies = JSON.parse(xhrReplies.responseText);
					replies.forEach(reply => {
						const replyElement = document.createElement("div");
						replyElement.className = 'message-container staff-message';
						replyElement.innerHTML = `
                    <div class="message-content">
                        <strong>${reply.username}</strong>: ${reply.message}
                    </div>
                `;
						chatMessages.appendChild(replyElement);
					});
					chatMessages.scrollTop = chatMessages.scrollHeight;
				} else {
					console.error('Error fetching replies:', xhrReplies.statusText);
				}
			};
			xhrReplies.send();
		}


		closeChatButton.addEventListener('click', function() {
			chatContainer.style.display = "none";
		});
		sendMessageButton.addEventListener('click', function() {
			const message = messageInput.value.trim();
			const userId = this.getAttribute('data-user-id'); // Ensure user ID is fetched

			console.log('Message:', message); // Debug log for message
			console.log('User ID:', userId); // Debug log for user ID

			if (message && userId) { // Check message and user ID
				// Clear the input after sending
				messageInput.value = '';

				// Send the message to the server
				const xhr = new XMLHttpRequest();
				xhr.open("POST", "http://localhost/cosmetics-shop/staff/messages/send_message.php", true); // Adjust the URL as needed
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.onload = function() {
					if (xhr.status !== 200) {
						console.error('Error sending message:', xhr.statusText);
					} else {
						// Optionally, you can handle the response here
						console.log('Response:', xhr.responseText); // Log server response
						// After sending the message, fetch replies to update the chat
						fetchMessages(userId); // Call the function to fetch replies/messages
					}
				};
				// Send message data to the server
				xhr.send(`sender_id=${userId}&reply_message=${encodeURIComponent(message)}`);
			} else {
				console.warn('Message is empty or user ID is not found.');
			}
		});




	});
</script>