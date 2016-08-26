<?php
class Blog extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        //$this->load->helper('url');
    }
   
    public function home()
    {
        $this->load->view('templates/header', $data);
        $this->load->view('pages/artcle', $data);
        $this->load->view('templates/footer');
    }
    
    public function login()
    {
        echo "just for login test";
    }

    public function article($aid = 0)
    {   
        $this->load->model('news_model');
        $data['title'] = 'News archive';
	

        if (0 == $aid){
            $data['news'] = $this->news_model->get_news();
        }
        else{
            //query dbid
            $data['news'] = $this->news_model->get_news($aid);    
        }
        
        //$this->load->view('templates/header', $data);
        $this->load->view('pages/artcle', $data);
        //$this->load->view('templates/footer');
    }
}

?>

