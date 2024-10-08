<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-pink">
  <div class="container px-4 px-lg-5 ">
    <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="./">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      <?php echo $_settings->info('short_name') ?>
    </a>

    <form class="form-inline" id="search-form">
      <div class="input-group">
        <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-light btn-sm m-0" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>

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
          <a class="text-dark mr-2 nav-link text-white" href="./?p=cart">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-count">
              <?php
              $count = $conn->query("SELECT SUM(quantity) as items from `cart` where client_id =" . $_settings->userdata('id'))->fetch_assoc()['items'];
              echo ($count > 0 ? $count : 0);
              ?>
            </span>
          </a>

          <a href="./?p=my_account" class="text-dark nav-link text-white"><b> Hi, <?php echo $_settings->userdata('firstname') ?>!</b></a>
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

<?php if ($_settings->userdata('id') > 0): ?> <!-- Check if user is logged in -->
  <!-- Chat Section -->
  <div class="chat-container" style="position: fixed; bottom: 0; right: 0; width: 300px; height: 400px; display: flex; flex-direction: column; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
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
<?php endif; ?> <!-- End of user login check -->


<style>
  .chat-container {
    background-color: white;
    border-radius: 8px;
    transition: all 0.3s ease;
    z-index: 1000;
    /* Ensure it is on top of other content */
  }

  .chat-header {
    cursor: pointer;
  }

  .chat-messages {
    max-height: 300px;
    /* Limit the height */
  }

  .chat-input input {
    width: 100%;
    /* Make the input field take full width */
  }

  .chat-input button {
    flex-shrink: 0;
    /* Prevent button from shrinking */
  }
</style>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Show/hide the chat
    const chatContainer = document.querySelector('.chat-container');
    const closeChatButton = document.getElementById('close-chat');

    closeChatButton.addEventListener('click', () => {
      chatContainer.style.display = chatContainer.style.display === 'none' ? 'flex' : 'none';
    });

    // Fetch messages from the server
    const fetchMessages = async () => {
      try {
        const response = await fetch('http://localhost/cosmetics-shop/inc/fetch_messages.php');
        const messages = await response.json();
        const chatMessages = document.querySelector('.chat-messages');

        chatMessages.innerHTML = ''; // Clear existing messages
        messages.forEach(msg => {
          const messageElement = document.createElement('div');
          messageElement.innerHTML = `<strong>${msg.sender}:</strong> ${msg.message} <small>${new Date(msg.date_sent).toLocaleString()}</small>`;
          chatMessages.appendChild(messageElement);
        });
        chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to the bottom
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    };

    // Sending a message
    const sendMessageButton = document.getElementById('send-message');
    const messageInput = document.getElementById('message-input');
    const chatMessages = document.querySelector('.chat-messages');

    sendMessageButton.addEventListener('click', () => {
      const message = messageInput.value.trim();
      if (message) {
        // Here you would normally send the message to the server
        // For now, we just append it to the chat
        const messageElement = document.createElement('div');
        messageElement.textContent = message;
        chatMessages.appendChild(messageElement);
        messageInput.value = ''; // Clear the input
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }
    });

    // Optional: Allow pressing Enter to send message
    messageInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        sendMessageButton.click();
      }
    });

    // Fetch messages when the page loads
    fetchMessages();
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