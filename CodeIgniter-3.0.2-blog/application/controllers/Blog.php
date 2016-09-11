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
    
    public function home()
    {
        $this->load->view('templates/header');
	    $this->articlepages();
        $this->load->view('templates/footer');
    }
    
    public function tag($tagid)
    {
        $this->load->view('templates/header');
        $this->articlepages($tagid);
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $this->load->view('templates/simple-head');
        $this->load->view('pages/login');
        $this->load->view('templates/footer');
    }

    public function register()
    {
        $this->load->view('templates/simple-head');
        $this->load->view('pages/register');
        $this->load->view('templates/footer');
    }

    public function article($aid = 0)
    {
        $this->load->view('templates/header');
        $this->realarticle($aid);
        $this->load->view('templates/footer');
    }

    public function write($aid = 0)
    {
        $this->load->model('news_model');

        if (0 != $aid)
        {
            $data= $this->news_model->get_article($aid);
        }        

        $data['tags'] = $this->news_model->get_tags();

        $this->load->view('templates/header');
        $this->load->view('templates/main-head');
        $this->load->view('templates/left',$data);

        $this->load->view('pages/write',$data);
        $this->load->view('templates/main-end');
        $this->load->view('templates/footer');
    }

    public function savearticle()
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        echo $title,"---",$content;
    }

    private function articlepages($tagid = 0)
    {
        $curpage = 0;
   
        if (!isset($_POST["curpage"]))
        {
            ;
        }
        else
        {
            $curpage = $_POST["curpage"];
        }

        $this->load->model('news_model');
	
        $data['news'] = $this->news_model->get_brief($tagid);
        $data['tags'] = $this->news_model->get_tags();

        //$data["page"] = $curpage+1;
        
        //echo "size:",count($data);
        //$data["allpage"] = ;

        
        $this->load->view('templates/main-head');
        $this->load->view('templates/left',$data);
        $this->load->view('pages/artcle_page', $data);
        $this->load->view('templates/main-end');
        
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
            $data= $this->news_model->get_article($aid);
            
            
            $data['tags'] = $this->news_model->get_tags();
            
           // echo count($data);
            //var_dump($data);
            
            $this->load->view('templates/main-head', $data);
            $this->load->view('templates/left',$data);
            $this->load->view('pages/artcle', $data);
            $this->load->view('templates/main-end');
            
        }
    }
}

?>

