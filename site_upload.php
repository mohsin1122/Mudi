<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class site_upload extends CI_Model
{

	public function __construct()
    {
        parent::__construct();
    }

	public function add_data()
	{
		$temp = $this->upload->data('thumbnail');
				$uploadedPath = $temp['full_path'];
	
		
	
	
		
		$gen = $this->input->post('genres');
		$gen_result = implode(" | ", $gen);
		
		$values = array (
			'movie_name' => $this->input->post('movie_name'),
			'date' => $this->input->post('date'),
			//'genres' => $this->input->post('genres'),
			'genres' => $gen_result,
			'rating' => $this->input->post('rating'),
			'star' => $this->input->post('star'),
			'director' => $this->input->post('director'),
			'writers' => $this->input->post('writers'),
			'path' => $this->input->post('path'),
			'thumbnail' =>$uploadedPath,
			'details' => $this->input->post('details'),
			'type' => $this->input->post('type'),
			'classification' => $this->input->post('classification'),
			'hd_path' => $this->input->post('hdpath'),
			'server1' => $this->input->post('server1'),
			'server2' => $this->input->post('server2'),
			'server3' => $this->input->post('server3'),
			'server4' => $this->input->post('server4'),
			'server5' => $this->input->post('server5')
		);
		
		$rows = $this->db->insert('data',$values);
		
		return $rows;	
	}
	
	public function get_details()
	{
		$q = $this->db->get('data');
		
		
			if ($q->num_rows() >0 ){
				
				foreach ($q->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
			else
			{
				return false;
			}
	}
	
	public function get_details_home()
	{
		$q = $this->db->query("SELECT * FROM DATA WHERE TYPE = 'MOVIE' ORDER BY ID DESC");
		
		
			if ($q->num_rows() >0 ){
				
				foreach ($q->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
			else
			{
				return false;
			}
	}
	
	
	public function get_total_num()
	{
		$q = $this->db->query("SELECT * from data");
			
			$result = $q->num_rows();
			
			return $result;
	}
	

	public function del_data ($id)
	{
		$query = $this->db->query('delete from data where id = "'.$id.'"');
		
		return ($query);
	}
	
	
	public function edit_data ($id)
	{
		$query = $this->db->query('select * from data where id = "'.$id.'"');
		
		//var_dump($query);
		
		//exit;
		
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		else
			{
				return false;
			}
		
		
		}
		
	public function update_user()
	{
		$temp = $this->upload->data('thumbnail');
				$uploadedPath = $temp['full_path'];
		
		$gen = $this->input->post('genres');
		$gen_result = implode(" | ", $gen);
		
		
		$data=array(
			'movie_name'=>$this->input->post('movie_name'),
			'date'=>$this->input->post('date'),			
			'genres' => $gen_result,
			'rating'=>$this->input->post('rating'),
			'star'=>$this->input->post('star'),
			'director'=>$this->input->post('director'),			
			'writers'=>$this->input->post('writers'),
			'path'=>$this->input->post('path'),
			'id'=>$this->input->post('id'),
			'thumbnail' =>$uploadedPath,
			'details' => $this->input->post('details'),
			'type' => $this->input->post('type'),
			'classification' => $this->input->post('classification'),
			'hd_path' => $this->input->post('hdpath'),
			'server1' => $this->input->post('server1'),
			'server2' => $this->input->post('server2'),
			'server3' => $this->input->post('server3'),
			'server4' => $this->input->post('server4'),
			'server5' => $this->input->post('server5')
			);
		
		$id = $_REQUEST ['id'];
			
		//$where = 'id = "'.$id.'"'; 
		$this->db->where('id', $id);
		$result = $this->db->update('data', $data);
		
		//$this->db->query();
		
		return ($result);	
		
	}
	
	
	public function fetch_data($id)
	{
		$query = $this->db->query('select * from data where id = "'.$id.'"');
				
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		else
			{
				return NULL;
			}
		
	}
	
	public function record_count() {
        
		$output =  $this->db->query("select * from data where type = 'Movie' ");
		
		$result = $output->num_rows();
		
		return $result;
    }
	
	
	public function search_movie($limit, $start)
	{
		$movie = 'Movie';
		
		$this->db->limit($limit, $start);
		
		//$query = $this->db->get("data");
		
		$query = $this->db->get_where('data', array('type' => $movie), $limit, $start);
		
		//$query = $this->db->get('data', $data, $uri);
				
		//$query = $this->db->query('select * from data where type = "'.$movie.'"');			
	
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row){
					$data[] = $row;
				
				}
				
				//var_dump($data);
				
				return $data;
			}
		else
			{
				return NULL;
			}
		
	}
	
	public function record_count_cinema() {
        
		$output =  $this->db->query("select * from data where classification = 'Cinema' ");
		
		$result = $output->num_rows();
		
		return $result;
    }	
	
	
	public function cinema_movie($limit2, $start2)
	
	{
		$cinema = 'Cinema';
		
		//$query = $this->db->query("select * from data where classification = 'Cinema'");
		
		$this->db->limit($limit2, $start2);
		
		$query = $this->db->get_where('data', array('classification' => $cinema), $limit2, $start2);
				
		
		//var_dump($query);
		//exit;
		
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row){
					$data[] = $row;
				
				}
				
				//var_dump($data);
				//exit;
				
				return $data;
			}
		else
			{
				return NULL;
			}
		
		//$result = $query->result();
		
		//var_dump($result);
		//exit;
		
	}
	
	public function record_count_shows() {
        
		$output =  $this->db->query("select * from data where type = 'Movie' ");
		
		$result = $output->num_rows();
		
		return $result;
    }
	
	public function search_shows($limit1, $start1)
	{
		$show = 'TV-Show';
		
		//$this->db->limit($limit1, $start1);
		
		$query = $this->db->get_where('data', array('type' => $show), $limit1, $start1);
		
		//$query = $this->db->query('select * from data where type = "'.$show.'"');			
	
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row){
					$data[] = $row;
				
				}
				return $data;
			}
		else
			{
				return NULL;
			}
		
	}
	
	public function fetch_comments($id){
		
		
		$query = $this->db->query('select * from comments where num = "'.$id.'"');
				
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row){
					$data[] = $row;
				}
				
				return $data;
			}
		else
			{
				return NULL;
			}
	
	}
	
	public function add_comments(){
	
		$values = array (
			'num' => $this->input->post('id'),
			'comment' => $this->input->post('comment')
		);
		
		$rows = $this->db->insert('comments',$values);
		
		return $rows;
		
	}
	
	public function add_comments_trailer(){
	
		$comment = $this->input->post('comment');
		
		//$query = $this->db->query("Insert into trailer (comments) values ('".$comment."')");
		
		
			$values = array (
			'comments' => $comment,			
		);
	
		$rows = $this->db->insert('trailer', $values);
		
		return $rows;		
	}
	
	public function fetch_comments_trailer(){
		
		
		$query = $this->db->query('select * from trailer');
				
		if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row){
					$data[] = $row;
				}
				
				return $data;
			}
		else
			{
				return NULL;
			}
	
	}
	

}
?>