<?php
//application/models/

class MY_Model extends CI_Model
{
	protected $_table = null;
	protected $_primary_key = null;

	//------------------------------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}
	
	
	
	/**
	* //browse + read = get_listing
	* @usage
	* Single : $this->news_model->get();
	* All : $this->news_model->get(2);
	* Custom: $this->news_model->get(['any' => 'param']);
	*/
	//future prove because we might not know how many param to set
	public function get_by_arr($arr = array())
	{
		$return_val = array();

		if(!empty($arr))
		{
			if (is_numeric($arr) || !is_array($arr))
			{
				$this->db->where($this->_primary_key,$arr);
			}

			if (is_array($arr))
			{
				if (!empty($arr['select_substring_index']) && is_array($arr['select_substring_index']))
				{
					// $arr['select_substring_index']; 
					// $this->db->select('SQL_CALC_FOUND_ROWS *,'.$arr['select'] , FALSE);

					//SELECT action_desc, SUBSTRING_INDEX(action_desc, '', 2) FROM action_log
					$substring = '';
					foreach ($arr['select_substring_index'] as $_key => $_value)
					{	
						// $this->db->where($_value);

						$substring .= ', SUBSTRING_INDEX('.$_value[0].', "'.$_value[1].'", "'.$_value[2].'")';
						if(!empty($_value[3])){

							$substring .= 'AS '.$_value[3];
						}
						// _debug_array($_key);
						// _debug_array('');
						// _debug_array($_value);

						// $this->db->where($_value);
					}
					$this->db->select('SQL_CALC_FOUND_ROWS *'.$substring, FALSE);
				}
				else if(!empty($arr['select']) && !is_array($arr['select']))
				{	
					//http://stackoverflow.com/questions/7421873/codeigniter-active-record-get-query-and-query-without-the-limit-clause
					$this->db->select('SQL_CALC_FOUND_ROWS '.$arr['select'] , FALSE);
				}
				else
				{
					$this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
				}
				

				if(!empty($arr['from']) && !is_array($arr['from']))
				{	
					$this->db->from($arr['from']);
				}

				if(!empty($arr['where']) && is_array($arr['where']))
				{					
					foreach ($arr['where'] as $_key => $_value)
					{	
						$this->db->where($_key,$_value);
					}
				}

				if(!empty($arr['where_custom']) && is_array($arr['where_custom']))
				{					
					foreach ($arr['where_custom'] as $_key => $_value)
					{	
						$this->db->where($_value);
					}
				}

				if(!empty($arr['like']) && is_array($arr['like']))
				{					
					foreach ($arr['like'] as $_key => $_value)
					{	
						$this->db->like($_key,$_value);											
					}
				}

				if(!empty($arr['limit']) && is_array($arr['limit']))
				{
					//http://www.codeigniter.com/userguide3/database/query_builder.html#limiting-or-counting-results
					$limit = $arr['limit'];
					$this->db->limit($limit[0],$limit[1]);
				}

				if(!empty($arr['order_by']) && is_array($arr['order_by']))
				{
					//http://www.codeigniter.com/userguide3/database/query_builder.html#ordering-results
					$order_by = $arr['order_by'];
					$this->db->order_by($order_by[0],$order_by[1]);
				}

				if(!empty($arr['order_by_multiple']) && is_array($arr['order_by_multiple']))
				{					
					foreach ($arr['order_by_multiple'] as $_key => $_value)
					{	
						$this->db->order_by($_value[0],$_value[1]);
					}
				}

				if(!empty($arr['join']) && is_array($arr['join']))
				{	
					foreach ($arr['join'] as $_key => $_value)
					{	
						// $this->db->join('comments', 'comments.id = blogs.id');
						// $this->db->join('comments', 'comments.id = blogs.id', 'left');

						//https://goo.gl/1Yh8xg
						if(empty($_value[2])) $this->db->join($_value[0], $_value[1]);
						else $this->db->join($_value[0], $_value[1], $_value[2]);	
					}
				}
			}
		}

		$return_val['result'] 		= (!empty($arr['from'])) ? $this->db->get() : $this->db->get($this->_table);
		$return_val['last_query'] 	= $this->db->last_query();
		$query 						= $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$return_val['total_row'] 	= $query->row()->Count;

		return $return_val;
	}
	
	//------------------------------------------------------------------------------------------------

	/**
	* @usage $result = $this->user_model->edit(['username'=>'Markus'], 3);
	*					$this->user_model->edit(['username'=>'Markus'], ['date_created'=>'0']);
	*
	*/
	public function edit($new_data, $where)
	{
		if (is_numeric($where))
		{
			$this->db->where($this->_primary_key,$where);
		}
		elseif (is_array($where))
		{
			foreach ($where as $_key => $_value)
			{
				$this->db->where($_key,$_value);
			}
		}
		else
		{
			die('2 Parameter needed for edit()');
		}

		$this->db->update($this->_table, $new_data);
		return $this->db->affected_rows();
	}

	//------------------------------------------------------------------------------------------------

	/**
	* @param array $data
	*
	* @usage $result = $this->user_model->add(['xx'=>'data']);
	*
	*/
	public function add($data)
	{
		$this->db->insert($this->_table,$data);
		return $this->db->insert_id();
	}

	//------------------------------------------------------------------------------------------------

	/*
	* @usage $this->user_model->delete(2);
	* @usage $this->user_model->delete(['username' => 'Markus']);
	*/
	public function delete($id)
	{
		if (is_numeric($id))
		{
			$this->db->where($this->_primary_key,$id);
		}
		else if(is_array($id))
		{
			foreach ($id as $_key => $_value)
			{
				$this->db->where($_key,$_value);
			}
		}
		else
		{
			die('Parameter needed for DELETE()');
		}
		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}

	//------------------------------------------------------------------------------------------------

	/**
	* @usage $result = $this->user_model->insert_or_update(['username'=>'Markus'], 3);
	*					$this->user_model->insert_or_update(['username'=>'Markus'], ['date_created'=>'0']);
	*
	*/
	public function insert_or_update($data, $id = 0)
	{
		$return_val['result']	= '';
		$return_val['type']		= 'none';

		$this->db->select($this->_primary_key);
		$this->db->where($this->_primary_key,$id);
		$q 		= $this->db->get($this->_table);
		$result = $q->num_rows();

		if($result == 0)
		{
			$return_val['type']		= 'add';
			$return_val['result']	= $this->add($data);
		}
		else
		{	
			if(!empty($id))
			{
				$return_val['type']		= 'edit';
				$return_val['result']	= $this->edit($data, $id);
			}
		}

		return $return_val;
	}
	
	//------------------------------------------------------------------------------------------------

	function validate_field_exist($arr=array())
	{
		$return_val 	= false;	

		if(!empty($arr['field_to_check']))
		{	
			$field_to_check	= $arr['field_to_check'];
			$field_value	= $this->db->escape_str($_POST[$this->_table][$field_to_check]);
			$error_msg		= (empty($arr['field_name']))?'no_field':$arr['field_name'];
			
			if($_POST && (!empty($_POST[$this->_table][$field_to_check])))
			{
				$qry_str 		= " SELECT * FROM `".$this->_table."` WHERE `".$field_to_check."` = '".$field_value."' ";
				
				if(!empty($_POST[$this->_table][$this->_primary_key]))
				{
					$qry_str .= " AND `".$this->_primary_key."` != '".$_POST[$this->_table][$this->_primary_key]."' ";	
				}
				$qry_str .= " AND `is_delete` != '1' ";	
				
				$query 			= $this->db->query($qry_str);	
				$result_arr		= $query->result_array();
				
				if(empty($result_arr)) $return_val = true;	
			}
		}

		if($return_val == false) 
			$this->form_validation->set_message(
				$arr['validate_func'], 
				ucwords(lang('msg[being_used_1]')).$error_msg.ucwords(lang('msg[being_used_2]')));

		return $return_val;
	}


	//------------------------------------------------------------------------------------------------
}