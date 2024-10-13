<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-pink">
  <div class="container px-4 px-lg-5 ">
    <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="./">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <?php echo $_settings->info('short_name') ?>
    </a>
    <!-- 
    <form class="form-inline" id="search-form">
      <div class="input-group">
        <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-light btn-sm m-0" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form> -->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="./">Home</a></li>
        <?php
        $cat_qry = $conn->query("SELECT * FROM categories where status = 1 AND delete_flag = 0 limit 3");
        $count_cats = $conn->query("SELECT * FROM categories where status = 1 ")->num_rows;
        while ($crow = $cat_qry->fetch_assoc()):
        ?>
          <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="./?p=products&c=<?php echo md5($crow['id']) ?>"><?php echo $crow['category'] ?></a></li>
        <?php endwhile; ?>
        <?php if ($count_cats > 3): ?>
          <li class="nav-item"><a class="nav-link text-white" href="./?p=view_categories">All Categories</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link text-white" href="./?p=about">About</a></li>
      </ul>
      <div class="d-flex align-items-center">
        <?php if ($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2): ?>

          <a href="./?p=edit_account" class="text-dark nav-link text-white"><b> Hi, <?php echo $_settings->userdata('firstname') ?>!</b></a>
          <a href="logout.php" class="text-dark nav-link text-white"><i class="fa fa-sign-out-alt"></i></a>
        <?php else: ?>
          <button class="btn btn-outline-pink ml-2" id="login-btn" type="button">Login</button>
          <div class="dropdown">
            <button class="btn btn-outline-pink dropdown-toggle ml-2" type="button" id="accountsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Accounts
            </button>
            <div class="dropdown-menu" aria-labelledby="accountsDropdown">
              <a class="dropdown-item" href="http://localhost/cosmetics-shop/superadmin/login.php">
                <i class="fas fa-user-shield"></i> Superadmin
              </a>
              <a class="dropdown-item" href="http://localhost/cosmetics-shop/staff/login.php">
                <i class="fas fa-users-cog"></i> Staff
              </a>
              <a class="dropdown-item" href="http://localhost/cosmetics-shop/admin/login.php">
                <i class="fas fa-user-tie"></i> Admin
              </a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<?php if ($_settings->userdata('id') > 0): ?>
  <!-- Toggle Button -->
  <button id="toggle-chat" class="toggle-chat-button">
    Chat Support
  </button>

  <div class="chat-container" style="position: fixed; bottom: 0; right: 0; width: 300px; height: 400px; display: none; flex-direction: column; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
    <div class="chat-header" style="background-color: #ff6b6b; color: white; padding: 10px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
      <strong>Chat Support</strong>
      <button id="close-chat" style="float: right; border: none; background: none; color: white;">&times;</button>
    </div>
    <div class="chat-messages" style="flex-grow: 1; overflow-y: auto; padding: 10px;">
      <!-- Messages will be dynamically added here -->
    </div>
    <div class="chat-input" style="display: flex; padding: 10px;">
      <input type="text" id="message-input" placeholder="Type your message..." style="flex-grow: 1; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
      <button id="send-message" style="border: none; background-color: #ff6b6b; color: white; padding: 5px 10px; border-radius: 4px; margin-left: 5px;">Send</button>
    </div>
  </div>
<?php endif; ?>

<style>
  .form-inline {
    flex-grow: 1;
    max-width: 400px;
  }

  .toggle-chat-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #ff6b6b;
    /* Main color */
    color: white;
    /* Text color */
    border: none;
    /* No border */
    border-radius: 50px;
    /* Rounded corners for a modern look */
    padding: 12px 20px;
    /* Vertical and horizontal padding */
    font-size: 16px;
    /* Font size */
    font-weight: bold;
    /* Bold text for emphasis */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Soft shadow */
    cursor: pointer;
    /* Pointer cursor */
    transition: background-color 0.3s, transform 0.2s;
    /* Smooth transition */
    z-index: 1000;
    /* Ensure button is on top */
  }

  .toggle-chat-button:hover {
    background-color: #ff4d4d;
    /* Darker shade on hover */
    transform: translateY(-2px);
    /* Slight lift effect */
  }

  .toggle-chat-button:active {
    transform: translateY(1px);
    /* Slight dip effect when clicked */
  }

  .chat-container {
    background-color: white;
    border-radius: 8px;
    position: fixed;
    bottom: 0;
    right: 0;
    width: 300px;
    height: 400px;
    display: none;
    /* Start hidden */
    flex-direction: column;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
  }

  .chat-header {
    background-color: #ff6b6b;
    color: white;
    padding: 10px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    cursor: pointer;
  }

  .chat-messages {
    flex-grow: 1;
    overflow-y: auto;
    padding: 10px;
    max-height: 300px;
  }

  .chat-input {
    display: flex;
    padding: 10px;
  }

  .chat-input input {
    flex-grow: 1;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
  }

  .chat-input button {
    background-color: #ff6b6b;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    border: none;
    margin-left: 5px;
  }

  .message-container {
    margin-bottom: 10px;
  }

  .message-header {
    display: flex;
    justify-content: space-between;
  }

  .message-body {
    background-color: #f1f1f1;
    padding: 5px;
    border-radius: 4px;
  }
</style>

<script>
  // Wait for the DOM to load
  document.addEventListener('DOMContentLoaded', function() {
    const closeButton = document.getElementById('close-chat');
    const chatContainer = document.querySelector('.chat-container');
    const toggleButton = document.getElementById('toggle-chat');

    // Function to show/hide chat container
    function toggleChat() {
      if (chatContainer.style.display === 'none' || chatContainer.style.display === '') {
        chatContainer.style.display = 'flex'; // Show the chat
      } else {
        chatContainer.style.display = 'none'; // Hide the chat
      }
    }

    // Add event listener for the toggle button
    toggleButton.addEventListener('click', toggleChat);

    // Add event listener for the close button
    closeButton.addEventListener('click', function() {
      chatContainer.style.display = 'none'; // Hide the chat container
    });
  });
</script>
<style>
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
    word-wrap: break-word;
    /* Prevent overflow */
  }

  /* Customer message styling */
  .customer-message {
    background-color: #f1f1f1;
    align-self: flex-start;
    /* Align messages to the left */
  }

  /* Staff message styling */
  .staff-message {
    background-color: #d1e7ff;
    align-self: flex-end;
    /* Align messages to the right */
  }

  /* Styling for message header */
  .message-header,
  .reply-header {
    display: flex;
    justify-content: space-between;
  }

  .message-date,
  .reply-date {
    font-size: 0.8em;
    color: #666;
  }

  /* Styling for message body */
  .message-body,
  .reply-body {
    margin-top: 5px;
    /* Add some space between header and body */
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const sendMessageButton = document.getElementById('send-message');
    const messageInput = document.getElementById('message-input');
    const chatMessages = document.querySelector('.chat-messages');

    sendMessageButton.addEventListener('click', async () => {
      const message = messageInput.value.trim();
      if (message) {
        try {
          const response = await fetch('http://localhost/cosmetics-shop/inc/send_message.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              sender: "<?php echo $_settings->userdata('id') ?>", // User sending the message
              message: message
            })
          });

          const result = await response.json();
          if (result.success) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message-container');
            messageElement.innerHTML = `
    <div class="message-header">
      <strong>${message.sender_id == "<?php echo $_settings->userdata('id') ?>" ? 'You' : 'User'}</strong>
      <small class="message-date">${new Date(message.date_sent).toLocaleString()}</small>
    </div>
    <div class="message-body">${message.message}</div>
  `;
            chatMessages.appendChild(messageElement);
            messageInput.value = ''; // Clear the input
            chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to the bottom
          } else {
            alert('Message failed to send');
          }
        } catch (error) {
          console.error('Error sending message:', error);
        }
      }
    });
    async function fetchMessages() {
      const senderId = "<?php echo $_settings->userdata('id') ?>";

      if (senderId > 0) { // Check if the senderId is valid
        try {
          // Fetch both messages and replies
          const messagesResponse = await fetch(`http://localhost/cosmetics-shop/inc/fetch_messages.php?sender_id=${senderId}`);
          const repliesResponse = await fetch(`http://localhost/cosmetics-shop/inc/fetch_replies.php?sender_id=${senderId}`);

          const messages = await messagesResponse.json();
          const replies = await repliesResponse.json();
          console.log('Fetched messages:', messages); // Debugging output
          console.log('Fetched replies:', replies); // Debugging output

          chatMessages.innerHTML = ''; // Clear the current messages

          // Display customer messages
          messages.forEach(message => {
            const parsedDate = new Date(message.date_sent);
            const messageElement = document.createElement('div');
            messageElement.classList.add('message-container', 'customer-message'); // Add customer-message class
            messageElement.innerHTML = `
                    <div class="message-header">
                        <strong>${message.firstname} ${message.lastname}</strong>
                        <small class="message-date">${parsedDate.toLocaleDateString()} ${parsedDate.toLocaleTimeString()}</small>
                    </div>
                    <div class="message-body">${message.message}</div>
                `;
            chatMessages.appendChild(messageElement);
          });

          // Display staff replies
          replies.forEach(reply => {
            const parsedDate = new Date(reply.date_sent); // Assuming replies also have a date_sent field
            const replyElement = document.createElement('div');
            replyElement.classList.add('message-container', 'staff-message'); // Add staff-message class
            replyElement.innerHTML = `
                    <div class="reply-header">
                        <strong>Chat Staff</strong> <!-- Assuming you have username in reply -->
                        <small class="reply-date">${parsedDate.toLocaleDateString()} ${parsedDate.toLocaleTimeString()}</small>
                    </div>
                    <div class="reply-body">${reply.message}</div>
                `;
            chatMessages.appendChild(replyElement);
          });



        } catch (error) {
          console.error('Error fetching messages:', error);
        }
      } else {
        console.warn('Invalid sender ID'); // Handle the case when senderId is not valid
      }
    }

    // Fetch messages every X milliseconds (e.g., every 5 seconds)
    setInterval(fetchMessages);

  });
</script>


<style>
  .navbar-nav .nav-link {
    white-space: nowrap;
    /* Prevents the text from wrapping to the next line */
    overflow: hidden;
    /* Hides any overflowing content */
    text-overflow: ellipsis;
    /* Displays ellipsis (...) for any overflowing text */
  }

  .navbar-brand {
    white-space: nowrap;
    /* Prevents the brand text from wrapping */
  }
</style>



<script>
  $(function() {
    $('#login-btn').click(function() {
      uni_modal("", "login.php")
    })
    $('#navbarResponsive').on('show.bs.collapse', function() {
      $('#mainNav').addClass('navbar-shrink')
    })
    $('#navbarResponsive').on('hidden.bs.collapse', function() {
      if ($('body').offset.top == 0)
        $('#mainNav').removeClass('navbar-shrink')
    })
  })

  $('#search-form').submit(function(e) {
    e.preventDefault()
    var sTxt = $('[name="search"]').val()
    if (sTxt != '')
      location.href = './?p=products&search=' + sTxt;
  })
</script>