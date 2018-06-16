<?php
class Blog extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('url');
    }
   
    public function index()
    {
       redirect("blog");
    }
    
    public function home($page =1)
    {
        //echo $page,'---tttt---<br>';
        $this->load->view('templates/header');
	    $this->articlepages_withcondition(0, $page);
        $this->load->view('templates/footer');
    }
    
    public function tag($tagid, $page=1)
    {
        $this->load->view('templates/header');
        $this->articlepages_withcondition($tagid, $page);
        $this->load->view('templates/footer');
    }

    public function searchinside($page=1)
    {
        $this->load->view('templates/header');
        $tagid = 0;
        $this->articlepages_withcondition($tagid, $page);
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $param["title"] = "登录";
        $this->load->view('templates/simple-head',$param);
        $this->load->view('pages/login');
        $this->load->view('templates/footer');
    }

    public function register()
    {
        $param["title"] = "注册";
        $this->load->view('templates/simple-head', $param);
        $this->load->view('pages/register');
        $this->load->view('templates/footer');
    }

    public function article($aid = 0)
    {
        $this->load->view('templates/header');
        $this->realarticle($aid);
        $this->load->view('templates/footer');
    }
    
    public function make_comment()
    {     
        $this->load->model('news_model');
        
        //发表评论.从form中获取评论的作者，内容，以及针对的文章id
        $name = $_POST['author'];
        $content = $_POST['text'];
        $aid = $_POST['article_id'];
        
        if (empty($name))
        {
            $name = "匿名用户";
        }
        
        //写评论
        $result = $this->news_model->insert_comment($content, $name, $aid);
        
        if ($result["issuccess"])
        {
            redirect("blog/article/".$aid);
        }
        else
        {
            $this->load->view("pages/jump");
        }
    }

    public function write($aid = 0)
    {
        $this->load->model('news_model');
        
        $this->load->view('templates/header');
        
        if (!isset($_SESSION['username']))
        {
            $param["uid"] = "";
        }
        else
        {
            $param["uid"] = $_SESSION['username'];
        }    
        
        if (0 != $aid)
        {
            $data= $this->news_model->get_article($aid);
        }        

        $data['tags'] = $this->news_model->get_tags($param);

        $this->load->view('templates/main-head');
        $this->LoadLeft();
        
        $this->load->view('pages/write',$data);
        $this->load->view('templates/main-end');
        $this->load->view('templates/footer');
    }

    private function articlepages($tagid = 0, $nextpag = 1)
    {
        $this->load->model('news_model');
	
        $perpage = 10;

        if (!isset($_SESSION['username'])) 
        {
            $param["uid"] = "";
        }
        else 
        {
            $param["uid"] = $_SESSION['username'];
        }

        if (empty($_POST["sum"]))
        {
            $rowres = $this->news_model->get_brief_num($tagid, $param["uid"]);

            $allsum= $rowres["couid"];
            $data["allpage"] = ceil($allsum/$perpage);          
        }
        else
        {
            $data["allpage"] = $_POST["sum"];    
        }

        if (empty($_POST["maxid"]))
        {
            $maxid = 0;
        }
        else
        {
           $maxid = $_POST["maxid"];
        }

        if (empty($_POST["minid"]))
        {
            $minid = 0;
        }
        else
        {
           $minid = $_POST["minid"];
        }

        if (empty($_POST["lastpage"]))
        {
            $lastpage = 1;
        }
        else 
        {
           $lastpage = $_POST["lastpage"];
        }

        //set the param
        $param["tagid"] = $tagid;
        $param["maxid"] = $maxid;
        $param["minid"] = $minid;
        $param["lastpage"] = $lastpage;       
        $param["nextpag"] = $nextpag;
        $param["per"] = $perpage;
        
        //set the value    
        $data['curtag'] = $tagid;
        $data['news'] = $this->news_model->condition_paging($param);
        
        arsort($data['news']);

        //$data['tags'] = $this->news_model->get_tags();

        $data["curpage"] = $nextpag;

        $maxid = 0;
        $minid = 0xFFFFFFFF;

        foreach ($data["news"] as $item)
        {
            //echo $item["id"];
            if ($maxid < $item["id"])
            {
                $maxid = $item["id"];
            }

            if ($minid > $item["id"])
            {
                $minid = $item["id"];
            }
        }

        $data["maxid"] = $maxid;
        $data["minid"] = $minid;

        $this->load->view('templates/main-head');
        $this->LoadLeft();
        $this->load->view('pages/artcle_page', $data);
        $this->load->view('templates/main-end');
    }
    
    private function articlepages_withcondition($tagid = 0, $nextpag = 1)
    {
        $this->load->model('news_model');
	
        $perpage = 10;

        //set the param
        $param = $this->set_param();
        $param["tagid"] = $tagid;
        $param["nextpag"] = $nextpag;
        $param["per"] = $perpage;
            
        //set the value   
        if (empty($_POST["sum"]))
        {
            $rowres = $this->news_model->get_brief_num($tagid, $param["uid"], $param["keyword"]);
            $allsum= $rowres["couid"];
            $data["allpage"] = ceil($allsum/$perpage);          
        }
        else
        {
            $data["allpage"] = $_POST["sum"];    
        }
 
        $data['curtag'] = $tagid;
        $data['news'] = $this->news_model->condition_paging($param);
        
        arsort($data['news']);
        $data["curpage"] = $nextpag;

        $maxid = 0;
        $minid = 0xFFFFFFFF;

        foreach ($data["news"] as $item)
        {
            //echo $item["id"];
            if ($maxid < $item["id"])
            {
                $maxid = $item["id"];
            }

            if ($minid > $item["id"])
            {
                $minid = $item["id"];
            }

	    $data['commentnum'] = $this->news_model->get_comments_num($item["id"]);
        }

        $data["maxid"] = $maxid;
        $data["minid"] = $minid;
        $data["keyword"] = $param["keyword"];

        $this->load->view('templates/main-head');
        $this->LoadLeft($param["keyword"]);
        $this->load->view('pages/artcle_page', $data);
        $this->load->view('templates/main-end');
    }
    
    private function set_param()
    {
        if (!isset($_SESSION['username'])) 
        {
            $param["uid"] = "";
        }
        else 
        {
            $param["uid"] = $_SESSION['username'];
        }

        if (empty($_POST["maxid"]))
        {
            $maxid = 0;
        }
        else
        {
           $maxid = $_POST["maxid"];
        }

        if (empty($_POST["minid"]))
        {
            $minid = 0;
        }
        else
        {
           $minid = $_POST["minid"];
        }

        if (empty($_POST["lastpage"]))
        {
            $lastpage = 1;
        }
        else 
        {
           $lastpage = $_POST["lastpage"];
        }
        
        if (empty($_POST["keyword"]))
        {
            $keyword = "";
        }
        else 
        {
           $keyword = $_POST["keyword"];
        }
        
        $param["maxid"] = $maxid;
        $param["minid"] = $minid;
        $param["lastpage"] = $lastpage;   
        $param["keyword"] = $keyword; 
          
        return $param;
    }

    private function realarticle($aid)
    {
        $this->load->model('news_model');
        
        if (0 == $aid)
        {
            echo "wrong param";
        }
        else
        {
            
            if (!isset($_SESSION['username']))
            {
                $param["uid"] = "";
            }
            else
            {
                $param["uid"] = $_SESSION['username'];
            }

            //首先，判断当前用户是不是该文章的主人
            //只限于私密日志,并且判断了该文章是否已经被删除
            $res = $this->news_model->check_secret_article($param["uid"] , $aid);
            
            //echo "result is ", $res ? 1:0;

            if ($res) 
            {
                echo "<script>alert('您无权操作该文章')</script>";
                $this->load->view("pages/jump");
            }
            else
            {
                
                $data= $this->news_model->get_article($aid);
                $data["article_comments"] = $this->news_model->get_article_comment($aid);
         
                $this->load->view('templates/main-head', $data);
                $this->LoadLeft();
                $this->load->view('pages/artcle', $data);
                $this->load->view('templates/main-end');
            }
        }
    }

    public function LoadLeft($keyword = "")
    {
        //统一处理左边内容的加载
        if (!isset($_SESSION['username']))
        {
            $param["uid"] = "";
        }
        else
        {
            $param["uid"] = $_SESSION['username'];
        } 
    
        $data['tags'] = $this->news_model->get_tags($param);
	$data['keyword'] = $keyword;
        $this->load->view('templates/left',$data);             
    }
}

?>

