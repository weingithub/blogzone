<?php
class News_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        //$this->db->_db_set_charset("utf8");
    }

    public function get_brief($param)
    {
        //$lastid = $param["maxid"];
        $lastpag = $param["lastpage"];
        $nextpag = $param["nextpag"];
        $tagid = $param["tagid"];
        $perpag = $param["per"];
        $userid = $param["uid"];

        //更大 <- 大 - 小 ->更小
        
        $secret_id = $this->get_secret_tag();
        
        $sqlbase = 'select id, title, brief,times,userid from articles where  IF(  `userid` ="'.$userid.'", 1 , tagid != '.$secret_id.') and isdel=0';

        if (1 == $nextpag)
        {
            $limitnum = 0;
            $sql = $sqlbase;                
        }
        else if ($nextpag >= $lastpag) //往后翻
        {
            $limitnum = ($nextpag - $lastpag -1)*$perpag;
            $sql = $sqlbase.' and id < '.$param["minid"];
        }
        else
        {
            $limitnum = ($lastpag - $nextpag - 1)*$perpag;
            //$sql = 'select id, title, brief,times,userid from articles where id >'.$param["maxid"];
            $sql = $sqlbase.' and id >'.$param["maxid"];
        }

        
        if ($tagid === 0)
        {
            ;
        }
	    else
	    {	
            $sql = $sql.' and tagid='.$tagid.' ';
	    }
        
        if (1 == $nextpag || $nextpag >= $lastpag)  //向后翻或第一页
        {
            $sql = $sql.' order by id desc limit '.$limitnum.','.$perpag;
        }
        else  //向前翻
        {
            $sql = $sql.' order by id asc limit '.$limitnum.','.$perpag;
        }

        //echo $sql;
       
        $query = $this->db->query($sql);

        return $query->result_array();
    }
        
    public function check_user_article($uid, $aid)
    {
        $sql = "select 1 from articles where id= $aid and userid = \"$uid\" ";   
        
        //echo $sql;
        $query = $this->db->query($sql);

        $res = $query->result_array();

        return !empty($res);  
    } 

    public function check_secret_article($uid, $aid)
    {
        $secret_id = $this->get_secret_tag();

        $sql = "select 1 from articles where isdel=0 and (tagid != $secret_id and id = $aid or(id= $aid and userid = \"$uid\")) ";

        //echo $sql;
        $query = $this->db->query($sql);

        $res = $query->result_array();

        return empty($res);
    }   

    public function delete_article($uid, $aid)
    {
        $sql = "update articles set isdel=1 where id= $aid and userid = \"$uid\" ";

        //echo $sql;
        $query = $this->db->query($sql);

        return $res;
    }

    public function get_brief_num($tagid, $uid)
    {
        $secret_id = $this->get_secret_tag();

        //排除隐私和已删除部分
        if ($tagid == 0)
        {
            $sql = 'select count(id) as couid from articles where  IF(  `userid` ="'.$uid.'", 1 , tagid != '.$secret_id.') and isdel=0 ';
            
            $query = $this->db->query($sql);

            //echo $this->db->last_query();
            return $query->row_array();
        }
        else
        {
            $sql = 'select count(id) as couid from articles where  IF(  `userid` ="'.$uid.'", 1 , tagid != '.$secret_id.') and isdel=0 and tagid='.$tagid.";";            
    
            $query = $this->db->query($sql);
            //echo $this->db->last_query();
            return $query->row_array();
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
    
    public function save_article($data)
    {
        $aid = $data["aid"];
        $uid = $data["uid"];
        $title = $data["title"];
        $brief = $data["brief"];
        $content = $data["content"];
        $tag = $data["tagid"];
        
        //echo "---my:".$brief."-------";

        if (0 == $aid)
        {
            return $this->insert_article($content, $uid, $title, $tag, $brief);
        }
        else
        {
            return $this->update_article($aid, $content, $title, $tag, $brief);
        }
        
    }

    public function update_article($aid, $content, $title, $tag, $brief)
    {
        //根据aid查找cid,然后先更新content
        $query = $this->db->get_where('articles', array('id' => $aid));

        $articleinfo = $query->row_array();

        $updatedata = array('content' => $content);
        $where = "id=".$articleinfo['cid'];       
        $update_cont_str = $this->db->update_string('content', $updatedata, $where);
    
        $updatedata = array('title' => $title, 'tagid' => $tag, 'brief' => $brief);
        $where = "id =".$aid;
        $update_arti_str = $this->db->update_string('articles', $updatedata, $where);

        $this->db->trans_start();

        //更新content
        $this->db->query($update_cont_str);
        $this->db->query($update_arti_str);
        
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

    public function insert_article($content, $uid, $title, $tag, $brief)
    {
        
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

    public function get_secret_tag()
    {
        $query = $this->db->get_where('tags', array('tagname' => "隐私"));
    
        //echo $this->db->last_query();

        $secret_id = 0;        

        $tags =  $query->result_array();  

        if (count($tags))
        {
            $secret_id = $tags[0]["id"];
        } 

        return $secret_id;
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
