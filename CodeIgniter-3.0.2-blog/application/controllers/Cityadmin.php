<?php
class Cityadmin extends CI_Controller {
    public function __construct()
    {   
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('url');
        $this->load->model('news_model');
    }  

    public function afterlogin()
    {
        //判断是否登录
        $isempty = $this->checklogin($_POST['username'], $_POST['userpwd']);

        if ($isempty)
        {
            redirect("login.html");
        }
        
        //管理平台，用来管理博客
        $this->load->view('admin/admin');
    }

    private function checklogin($name, $passwd)
    {
        if (empty($name) || empty($passwd))
        {
            //echo "empty";
            return false;
        }

        $param["uid"] = $name;
        $param["pass"] = $passwd;

        return $this->news_model->check_admin($param);
    }

    public function addtag()
    {
        //添加新标签
        $tagname = $_POST["tag"];
        
        //判断标签是否存在
        $isempty =  $this->news_model->check_tag($tagname);

        if ($isempty)
        {
            //空，不存在，则插入tag
            $tagid = $this->news_model->add_tags($tagname);
            echo "标签:$tagname,的id是:$tagid";
        }
        else
        {
            echo "标签:$tagname,已存在";
        }
    }

    public function look_tag()
    {
        $tags = $this->news_model->get_tags();
        
        foreach ($tags as $tag)
        {
            echo $tag['id']."-".$tag['tagname']."<br>";
        }
    }

    public function deltag()
    {
        $tagname = $_POST["tag"];
    
        //判断标签是否存在
        $isempty =  $this->news_model->check_tag($tagname);

        if (!$isempty)
        {   
            //存在，则删除tag
            $this->news_model->del_tags($tagname);
            echo "标签:$tagname,删除成功";
        }   
        else
        {   
            echo "标签:$tagname,不存在";
        } 
    }
}

?>
