<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Todo — CodeIgniter 3</title>
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
			margin-bottom: 20px;
		}
		form.add-form label {
			display: block;
			font-size: 0.85rem;
			font-weight: 600;
			margin-bottom: 4px;
			color: #444;
		}
		form.add-form input[type="text"],
		form.add-form textarea {
			width: 100%;
			box-sizing: border-box;
			padding: 8px 10px;
			border: 1px solid #d5d8dc;
			border-radius: 6px;
			font-size: 0.95rem;
			margin-bottom: 12px;
			font-family: inherit;
		}
		form.add-form textarea { resize: vertical; min-height: 60px; }
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
		ul.todo-list { list-style: none; padding: 0; margin: 0; }
		ul.todo-list li {
			display: flex;
			align-items: flex-start;
			gap: 12px;
			padding: 14px 0;
			border-bottom: 1px solid #eef0f2;
		}
		ul.todo-list li:last-child { border-bottom: none; }
		.todo-body { flex: 1; }
		.todo-title { font-weight: 600; }
		.todo-title.done { text-decoration: line-through; color: #9aa0a6; }
		.todo-desc { font-size: 0.85rem; color: #666; margin-top: 2px; }
		.todo-meta { font-size: 0.75rem; color: #9aa0a6; margin-top: 4px; }
		.actions { display: flex; gap: 10px; align-items: center; }
		.actions a { font-size: 0.85rem; color: #2563eb; text-decoration: none; }
		.actions a.delete { color: #dc2626; }
		.actions a:hover { text-decoration: underline; }
		.empty { color: #9aa0a6; font-style: italic; padding: 12px 0; }
		input[type="checkbox"] { width: 18px; height: 18px; margin-top: 3px; }
	</style>
</head>
<body>

	<h1>My Todos</h1>

	<div class="card">
		<?php echo form_open('todo', array('class' => 'add-form')); ?>
			<label for="title">Title</label>
			<input type="text" id="title" name="title" placeholder="e.g. Fix pricing bug" required>

			<label for="description">Description (optional)</label>
			<textarea id="description" name="description" placeholder="Any extra detail..."></textarea>

			<button type="submit">Add Todo</button>
		<?php echo form_close(); ?>
	</div>

	<div class="card">
		<?php if (empty($todos)): ?>
			<p class="empty">No todos yet — add one above.</p>
		<?php else: ?>
			<ul class="todo-list">
				<?php foreach ($todos as $todo): ?>
					<li>
						<form method="post" action="<?php echo site_url('todo/toggle/' . $todo->id); ?>">
							<input type="checkbox" onchange="this.form.submit()" <?php echo $todo->is_completed ? 'checked' : ''; ?>>
						</form>

						<div class="todo-body">
							<div class="todo-title<?php echo $todo->is_completed ? ' done' : ''; ?>">
								<?php echo html_escape($todo->title); ?>
							</div>
							<?php if (! empty($todo->description)): ?>
								<div class="todo-desc"><?php echo html_escape($todo->description); ?></div>
							<?php endif; ?>
							<div class="todo-meta">Added <?php echo date('M j, Y g:ia', strtotime($todo->created_at)); ?></div>
						</div>

						<div class="actions">
							<a href="<?php echo site_url('todo/edit/' . $todo->id); ?>">Edit</a>
							<a href="<?php echo site_url('todo/delete/' . $todo->id); ?>"
							   onclick="return confirm('Delete this todo?');" class="delete">Delete</a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>

</body>
</html>
