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

// Retrieve user_id from session
$user_id = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : null;

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

<!-- Main Sidebar -->
<div class="main-sidebar">
	<!-- Your existing sidebar layout here -->
</div>

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
		/* Use flexbox for better alignment */
		align-items: center;
		/* Center align items vertically */
		border-radius: 5px;
		transition: background 0.3s, transform 0.2s;
		/* Added transform for hover effect */
	}

	.second-sidebar ul li a:hover {
		background: #ddd;
		transform: scale(1.02);
		/* Slightly scale up on hover */
	}

	.second-sidebar ul li a i {
		margin-right: 8px;
		/* Spacing between icon and text */
		color: #007bff;
		/* Icon color */
	}

	.second-sidebar ul li a span {
		margin-left: auto;
		/* Align message count to the right */
		color: #666;
		/* Color for message count */
		font-size: 0.9em;
		/* Slightly smaller font for message count */
	}

	.chat-container {
		display: flex;
		flex-direction: column;
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
			});
		});

		// Close chat
		closeChatButton.addEventListener('click', function() {
			chatContainer.style.display = "none";
		});

		// Send message
		sendMessageButton.addEventListener('click', function() {
			const message = messageInput.value.trim();
			if (message) {
				const messageElement = document.createElement("div");
				messageElement.textContent = message;
				chatMessages.appendChild(messageElement);
				messageInput.value = ''; // Clear input after sending
				chatMessages.scrollTop = chatMessages.scrollHeight; // Auto-scroll to the bottom
			}
		});
	});
</script>