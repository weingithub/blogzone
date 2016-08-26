<?php
class Test extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    

    public function view($page = 'home')
    {
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
            // Whoops, we don't have a page for that!
            //show_404();
	        echo "just -- test --now<br>";
        }
        
        echo "just------------test<br>";
        $data['title'] = ucfirst($page); // Capitalize the first letter
	    var_dump($data);
        echo "<br> 's first element is ". $data['title'] ." <br>";
	    echo "pages's value is $page <br>";
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
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
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/artcle', $data);
        $this->load->view('templates/footer');
    }
}

?>

