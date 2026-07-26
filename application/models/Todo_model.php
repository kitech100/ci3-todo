<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model
{
	protected $table = 'todos';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get every todo, newest first.
	 */
	public function get_all()
	{
		return $this->db->order_by('created_at', 'DESC')
						 ->get($this->table)
						 ->result();
	}

	/**
	 * Get a single todo by id.
	 */
	public function get($id)
	{
		return $this->db->where('id', $id)
						 ->get($this->table)
						 ->row();
	}

	/**
	 * Insert a new todo.
	 */
	public function create($data)
	{
		$data['created_at'] = date('Y-m-d H:i:s');

		return $this->db->insert($this->table, $data);
	}

	/**
	 * Update an existing todo.
	 */
	public function update($id, $data)
	{
		$data['updated_at'] = date('Y-m-d H:i:s');

		return $this->db->where('id', $id)->update($this->table, $data);
	}

	/**
	 * Delete a todo.
	 */
	public function delete($id)
	{
		return $this->db->where('id', $id)->delete($this->table);
	}

	/**
	 * Flip a todo between done / not done.
	 */
	public function toggle_complete($id)
	{
		$todo = $this->get($id);

		if (! $todo)
		{
			return FALSE;
		}

		return $this->db->where('id', $id)->update($this->table, array(
			'is_completed' => $todo->is_completed ? 0 : 1,
			'updated_at'   => date('Y-m-d H:i:s'),
		));
	}
}
