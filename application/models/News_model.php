<?php
class News_model extends CI_Model {

    public function __construct()
    {
        echo "construct<br>";
        $this->load->database();
    }

    public function get_news($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('articles');
            return $query->result_array();
        }
	    else
	    {	
            echo "id's value is: $id<br>";
            $query = $this->db->get_where('articles', array('id' => $id));
            return $query->result_array();
	    }
    }
}

?>
