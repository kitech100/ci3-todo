<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Todo — CodeIgniter 3</title>
	<style>
		:root { color-scheme: light dark; }
		body {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
			max-width: 640px;
			margin: 48px auto;
			padding: 0 20px;
			background: #f6f7f9;
			color: #1a1a1a;
		}
		h1 { font-size: 1.5rem; margin-bottom: 1.25rem; }
		.card {
			background: #fff;
			border: 1px solid #e3e5e8;
			border-radius: 10px;
			padding: 20px;
		}
		label {
			display: block;
			font-size: 0.85rem;
			font-weight: 600;
			margin-bottom: 4px;
			color: #444;
		}
		input[type="text"], textarea {
			width: 100%;
			box-sizing: border-box;
			padding: 8px 10px;
			border: 1px solid #d5d8dc;
			border-radius: 6px;
			font-size: 0.95rem;
			margin-bottom: 12px;
			font-family: inherit;
		}
		textarea { resize: vertical; min-height: 80px; }
		button, .btn {
			background: #2563eb;
			color: #fff;
			border: none;
			border-radius: 6px;
			padding: 8px 16px;
			font-size: 0.9rem;
			cursor: pointer;
			text-decoration: none;
			display: inline-block;
		}
		button:hover, .btn:hover { background: #1d4ed8; }
		.btn.secondary { background: #e3e5e8; color: #1a1a1a; margin-left: 8px; }
		.btn.secondary:hover { background: #d5d8dc; }
	</style>
</head>
<body>

	<h1>Edit Todo</h1>

	<div class="card">
		<?php echo form_open('todo/edit/' . $todo->id); ?>
			<label for="title">Title</label>
			<input type="text" id="title" name="title" value="<?php echo html_escape($todo->title); ?>" required>

			<label for="description">Description</label>
			<textarea id="description" name="description"><?php echo html_escape($todo->description); ?></textarea>

			<button type="submit">Save Changes</button>
			<a href="<?php echo site_url('todo'); ?>" class="btn secondary">Cancel</a>
		<?php echo form_close(); ?>
	</div>

</body>
</html>
