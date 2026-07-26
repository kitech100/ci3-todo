<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Todo_model');
		$this->load->helper(array('url', 'form'));
	}

	/**
	 * List all todos, and handle the "add new todo" form on this same page.
	 */
	public function index()
	{
		if ($this->input->method() === 'post')
		{
			$title = trim((string) $this->input->post('title'));

			if ($title !== '')
			{
				$this->Todo_model->create(array(
					'title'        => $title,
					'description'  => trim((string) $this->input->post('description')),
					'is_completed' => 0,
				));
			}

			redirect('todo');
			return;
		}

		$data['todos'] = $this->Todo_model->get_all();
		$this->load->view('todo/index', $data);
	}

	/**
	 * Edit a single todo.
	 */
	public function edit($id = null)
	{
		if ($id === null)
		{
			redirect('todo');
			return;
		}

		$todo = $this->Todo_model->get($id);

		if (! $todo)
		{
			redirect('todo');
			return;
		}

		if ($this->input->method() === 'post')
		{
			$title = trim((string) $this->input->post('title'));

			if ($title !== '')
			{
				$this->Todo_model->update($id, array(
					'title'       => $title,
					'description' => trim((string) $this->input->post('description')),
				));
			}

			redirect('todo');
			return;
		}

		$data['todo'] = $todo;
		$this->load->view('todo/edit', $data);
	}

	/**
	 * Flip done / not done, then bounce back to the list.
	 */
	public function toggle($id = null)
	{
		if ($id !== null)
		{
			$this->Todo_model->toggle_complete($id);
		}

		redirect('todo');
	}

	/**
	 * Delete a todo, then bounce back to the list.
	 */
	public function delete($id = null)
	{
		if ($id !== null)
		{
			$this->Todo_model->delete($id);
		}

		redirect('todo');
	}
}
