<?php
// Retrieve user_id from session
$user_id = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : null;

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
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Messages</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-toggle="modal" data-target="#sendMessageModal">
				<i class="fas fa-plus"></i> Send Message
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div id="messageContainer">
				<?php

				$qry = $conn->query("
                    SELECT 
                        m.id as message_id,
                        CONCAT(c.firstname, ' ', c.lastname) as client_name,
                        CONCAT(u.firstname, ' ', u.lastname) as sender_name,
                        m.message,
                        m.date_created
                    FROM 
                        messages m
                    INNER JOIN 
                        users u ON u.id = m.sender_id
                    INNER JOIN 
                        clients c ON c.id = m.client_id
                    ORDER BY 
                        m.date_created DESC 
                ");

				while ($row = $qry->fetch_assoc()):
				?>
					<div class="message-box">
						<div class="message-header">
							<strong><?php echo $row['client_name']; ?></strong> <!-- Display Client Name -->
							<span class="message-date"><?php echo date('Y-m-d H:i', strtotime($row['date_created'])); ?></span>
							<div class="message-actions">
								<button type="button" class="btn btn-link reply_message" data-id="<?php echo $row['message_id'] ?>">
									<span class="fa fa-reply text-info"></span> Reply
								</button>
								<button type="button" class="btn btn-link delete_message" data-id="<?php echo $row['message_id'] ?>">
									<span class="fa fa-trash text-danger"></span> Delete
								</button>
							</div>
						</div>
						<div class="message-content">
							<p><?php echo $row['message']; ?></p>
						</div>
						<div class="replies">
							<?php
							// Fetch replies for the current message
							$replyQry = $conn->query("
                                SELECT 
                                    CONCAT(u.firstname, ' ', u.lastname) as reply_sender,
                                    r.reply_message,
                                    r.date_created as reply_date
                                FROM 
                                    replies r
                                INNER JOIN 
                                    users u ON u.id = r.sender_id
                                WHERE 
                                    r.message_id = " . $row['message_id'] . "
                                ORDER BY 
                                    r.date_created ASC
                            ");

							while ($reply = $replyQry->fetch_assoc()):
							?>
								<div class="reply-box">
									<strong><?php echo $reply['reply_sender']; ?></strong>
									<p><?php echo $reply['reply_message']; ?></p>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>

<style>
	.message-box {
		margin-bottom: 20px;
		/* Space between messages */
		padding: 10px;
		border: 1px solid #ccc;
		/* Add border to the message box */
		border-radius: 8px;
		background-color: #f9f9f9;
		/* Light background for messages */
	}

	.message-header {
		display: flex;
		justify-content: space-between;
		/* Space between name and date */
		align-items: center;
		/* Center align items */
	}

	.message-content {
		margin-top: 10px;
		/* Space above the message content */
	}

	.client-message {
		background-color: #e7f3fe;
		/* Light blue background for client messages */
		padding: 10px;
		border-radius: 5px;
		border: 1px solid #b1d4fe;
		/* Light blue border */
		margin-bottom: 10px;
		/* Space below client message */
	}

	.reply-box {
		background-color: #d4edda;
		/* Light green background for replies */
		padding: 8px;
		border-radius: 5px;
		border: 1px solid #c3e6cb;
		/* Light green border */
		margin-top: 5px;
		/* Space above reply */
		margin-left: 20px;
		/* Indent replies */
	}

	.reply-box strong {
		color: #155724;
		/* Dark green text for reply sender */
	}
</style>


<!-- Send Message Modal -->
<div class="modal fade" id="sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sendMessageModalLabel">Send Message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="sendMessageForm">
				<div class="modal-body">
					<div class="form-group">
						<label for="receiver">Receiver</label>
						<select id="receiver" class="form-control" name="receiver_id" required>
							<option value="">Select a client</option>
							<?php
							// Fetch clients from the database
							$clientQuery = $conn->query("SELECT id, CONCAT(firstname, ' ', lastname) AS name FROM clients");
							while ($client = $clientQuery->fetch_assoc()) {
								echo "<option value='{$client['id']}'>{$client['name']}</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea id="message" class="form-control" rows="3" required></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Send</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Reply Message Modal -->
<div class="modal fade" id="replyMessageModal" tabindex="-1" role="dialog" aria-labelledby="replyMessageModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="replyMessageModalLabel">Reply to Message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="replyMessageForm">
				<div class="modal-body">
					<input type="hidden" id="reply_message_id" name="reply_message_id">
					<div class="form-group">
						<label for="reply_message">Reply</label>
						<textarea id="reply_message" class="form-control" rows="3" required></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Send Reply</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// Handle delete message
		$('.delete_message').click(function() {
			_conf("Are you sure to delete this message permanently?", "delete_message", [$(this).attr('data-id')]);
		});

		// Send Message Form Submission
		$('#sendMessageForm').submit(function(e) {
			e.preventDefault();
			const message = $('#message').val();
			const receiverId = $('#receiver').val();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=send_message",
				method: "POST",
				data: {
					message: message,
					receiver_id: receiverId
				},
				dataType: "json",
				error: err => {
					console.log(err);
					alert_toast("An error occurred.", 'error');
					end_loader();
				},
				success: function(resp) {
					if (typeof resp === 'object' && resp.status === 'success') {
						alert_toast("Message sent successfully!", 'success');
						location.reload();
					} else {
						alert_toast("An error occurred.", 'error');
					}
					end_loader();
				}
			});
		});

		// Handle reply message
		$('.reply_message').click(function() {
			const messageId = $(this).attr('data-id');
			$('#reply_message_id').val(messageId);
			$('#replyMessageModal').modal('show');
		});

		// Reply Message Form Submission
		$('#replyMessageForm').submit(function(e) {
			e.preventDefault();
			const replyMessage = $('#reply_message').val();
			const messageId = $('#reply_message_id').val();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=reply_message",
				method: "POST",
				data: {
					reply_message: replyMessage,
					message_id: messageId
				},
				dataType: "json",
				error: err => {
					console.log(err);
					alert_toast("An error occurred.", 'error');
					end_loader();
				},
				success: function(resp) {
					if (typeof resp === 'object' && resp.status === 'success') {
						alert_toast("Reply sent successfully!", 'success');
						location.reload();
					} else {
						alert_toast("An error occurred.", 'error');
					}
					end_loader();
				}
			});
		});
	});

	function delete_message(id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_message",
			method: "POST",
			data: {
				id: id
			},
			dataType: "json",
			error: err => {
				console.log(err);
				alert_toast("An error occurred.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp === 'object' && resp.status === 'success') {
					alert_toast("Message deleted successfully!", 'success');
					location.reload();
				} else {
					alert_toast("An error occurred.", 'error');
				}
				end_loader();
			}
		});
	}
</script>