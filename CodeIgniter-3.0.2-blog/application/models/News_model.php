<?php
class News_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        //$this->db->_db_set_charset("utf8");
    }

    public function get_brief($tagid = 0)
    {
        if ($tagid === 0)
        {
            $this->db->select("id, title, brief, times, userid");
            $this->db->from('articles');
            $query = $this->db->get();

            return $query->result_array();
        }
	    else
	    {	
            $query = $this->db->get_where('articles', array('tagid' => $tagid));
            return $query->result_array();
	    }
    }

    public function get_article($id)
    {
        $this->db->select("A.id, times, userid, title, content,tagid");
        $this->db->from('articles as A');
        $this->db->join('content as B', 'A.cid = B.id');
        $this->db->where('A.id', $id);

        $query = $this->db->get();

        return $query->row_array();       
    }
    
    public function insert_article($data)
    {
        $uid = $data["uid"];
        $title = $data["title"];
        $brief = $data["brief"];
        $content = $data["content"];
        $tag = $data["tagid"];
        
        echo "---my:".$brief."-------";
        $aid = 0;
        $this->db->trans_start();

        $dataval = array('content' => $content);
        $str = $this->db->insert_string('content', $dataval); 
        
        $this->db->query($str);

        $cid = $this->db->insert_id();
        $dataval = array('userid' => $uid, 'title' => $title, 'tagid' => $tag,
                        'brief' => $brief, 'cid' => $cid);
        
        $artstr = $this->db->insert_string('articles', $dataval);

        $this->db->query($artstr);
        $aid = $this->db->insert_id();

        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE)
        {
            $result["issuccess"] = false;
        }
        else
        {
            $result["issuccess"] = true;
            $result["aid"] = $aid;
        }

        return $result;
    }

    public function get_tags()
    {
        $query = $this->db->get('tags');
        return $query->result_array();
    }
    
    public function get_users($data)
    {
        $uid = $data["uid"];
        
        if (array_key_exists("pass", $data))
        {
            $pass = $data["pass"];
            $md5pass=md5($pass);
            $sql = 'select * from users where userid="'.$uid.'" and passwd="'.$md5pass.'";';
            $query = $this->db->query($sql);
        }
        else
        {
            $query = $this->db->get_where('users', array('userid' => $uid));
        }

        return $query->result_array();
    }

    public function insert_user($data)
    {
        $uid = $data["uid"];
        $pass = $data["pass"];
        $myfile = fopen(".blogpasswd", "a") or die("Unable to open file!");

        fwrite($myfile, $uid);
        fwrite($myfile, ":");
        fwrite($myfile, $pass);
        fwrite($myfile, "\n");
        fclose($myfile);
        //insert into table
        $sql = 'insert into users values("'.$uid.'", md5("'.$pass.'"))';
        $this->db->query($sql);
    }
    
    public function get_user($data)
    {
        $uid = $data["uid"];
        $pass = $data["pass"];
       
        //select table

        $this->db->query($sql);
    }
}
?>
