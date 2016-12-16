<?php
class Backend extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('url');
        $this->load->model('news_model');
    }
    
    public function checkuser()
    {
        //加载数据库
        $data["uid"] = $_POST["uid"];
        
        $res =$this->news_model->get_users($data);
        $isexists = false;

        if(0 == count($res))
        {
            $isexists["isexists"] = false;
        } 
        else
        {
            $isexists["isexists"] = true;
        }

        echo json_encode($isexists);
    }
    
    public function register()
    {
        $data["uid"] = $_POST["username"];
        $data["pass"] = $_POST["userpwd"];

        $this->news_model->insert_user($data);
        
        redirect("blog/login");
    }
    
    public function login()
    {
        $data["uid"] = $_POST["username"];
        $data["pass"] = $_POST["userpwd"];
        
        $res =$this->news_model->get_users($data);

        if(0 == count($res))
        {
            redirect("blog/login");
        }
        else
        {
            session_start();
            $_SESSION['username'] = $data["uid"]; 
            echo $_SESSION['username'];
            redirect("blog");
        }          
    }
    
    public function logout()
    {
        session_start();
        unset($_SESSION['username']);

        $this->load->view("pages/jump");
    }

    public function delete($aid)
    {
        session_start();
        if (!isset($_SESSION['username']))
        {
            //未登录，返回登录页面
            $this->load->view("pages/jump");
        }
        else
        {
            $param["uid"] = $_SESSION['username'];

            //首先，判断当前用户是不是该文章的主人
            $res = $this->news_model->check_user_article($param["uid"] , $aid);
            
            if ($res)  //删除博客，只是置个标志
            {
                $this->news_model->delete_article($param["uid"] , $aid);
                redirect("blog");
            }
            else
            {
                echo "<script>alert('您无权操作该文章')</script>";
                $this->load->view("pages/jump");
            }
        }
        
    }


    public function savearticle()
    {
        $data["aid"] = $this->input->post('aid');
        $data["title"] = $this->input->post('title');
        $data["content"] = $this->input->post('content');
        $data["tagid"] = $this->input->post('tag');
        session_start();
        $data["uid"] = $_SESSION['username'];
      
        //echo $data["title"],"---",$data["content"];
        
        //先从content中取出128个字符
        $substr = mb_substr($data["content"], 0, 200, "utf-8");
        
        $pos = strpos($substr, "<pre");
        
        echo "pos is:",$pos;

        if (!$pos)
        {
            $data["brief"] = $substr;
        }
        else
        {
            $data["brief"] = mb_strcut($substr, 0, $pos);  
        }
        
        echo "---".$data["brief"]."---";
        //$this->load->view("pages/jump");
        
        $res =$this->news_model->save_article($data);
        
        if ($res["issuccess"])
        {
            redirect("blog/article/".$res["aid"]);
        }
        else
        {
            $this->load->view("pages/jump");
        }
    }
}

?>
