<?php
class Tool extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('url');
        $this->load->model('vocabulary');
    }
   
    public function vocabulary()
    {
        //显示单词
        $this->load->view('tools/search');
    }

    public function search()
    {
       //进行查询
        //echo "正在查询，请稍候...";
        
        $param = $_POST["word"];

        $data["voc"] = $this->vocabulary->get_word($param);
        
        //echo $data;
        $hide["word"] = $param;
        $this->load->view('tools/search', $hide);
        $this->load->view('tools/result', $data);
    }

    public function save()
    {
        //保存上传来的单词记录
        
        $word = $_POST["word"];

        $url = "http://dict.baidu.com/s?wd=".$word."&ptype=english";
        //echo $url;

        $this->AccessPage($url);
        
        $res = $this->GetMp3Address();  
        
        /*
        echo $res["pronounce_eng"]."<br>";
        echo $res["pronounce_us"]."<br>";
        
        echo $res["phonogram_eng"]."<br>";
        echo $res["phonogram_us"]."<br>";
        */

        if (0 != count($res))
        {
            $this->vocabulary->save_word($_POST, $res);
        }
        
        $this->search_inside($word);
    }

    private function search_inside($word)
    {
        
        $data["voc"] = $this->vocabulary->get_word($word);

        //echo $data;
        $hide["word"] = $word;
        $this->load->view('tools/search', $hide);
        $this->load->view('tools/result', $data);
    }

    public function AccessPage($page)
    {
        $ch = curl_init($page);
        //curl_setopt($ch, CURLOPT_URL, "www.baidu.com");
        //curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // 执行curl
        $contents = curl_exec($ch);
        // 关闭curl会话
         curl_close($ch);

        $myfile = fopen(".vocaburary", "w") or die("Unable to open file!");   
        fwrite($myfile, $contents);
    }

    private function GetMp3Address()
    {
        //打开
        echo "<br>";
        $fp = fopen(".vocaburary","r");
        
        $size = filesize(".vocaburary");
        
        if (0 == $size)
        {
            $data = array();

            return $data;
        }

        $str = fread($fp, $size);//指定读取大小，这里把整个文件内容读取出来
        //echo $str = str_replace("\r\n","<br />",$str);
        
        //首先获取音标
        $res = $this->get_tag($str, "h2");
        
        //echo "----------------result is".count($res)."<br>";
        

        foreach($res as $value) 
        {
            //echo strip_tags($value);      

            $strphp = strip_tags($value);
           // $data["phonogram"] = strstr($strphp, '[');
            //eng
            $strsplit = explode("[", $strphp);
            
            //foreach($tt as $ttv)
           // {   
            //    echo $ttv."---<br>";            
           // }
            

           $size = count($strsplit);

           if ($size == 3)
           {
               $data["phonogram_eng"] = "[".$strsplit[1]."[".$strsplit[2]; 
               $data["phonogram_us"] = "";
           }
           else if ($size == 5)
           {
               $data["phonogram_eng"] = "[".$strsplit[1]."[".$strsplit[2];
               $data["phonogram_us"] = "[".$strsplit[3]."[".$strsplit[4];
           }
           else
           {
                $data["phonogram_eng"] = "";
                $data["phonogram_us"] = "";
           }
            
            //从h2中再读取mp3
            $mp3 = $this->extract_attrib($value);

            $size = count($mp3);
            
            if (2 == $size)
            {
                $data["pronounce_eng"] = $mp3[0];
                $data["pronounce_us"] = $mp3[1];
            }
            else if (1 == $size)
            {
                $data["pronounce_eng"] = $mp3[0];
                $data["pronounce_us"] = "";
            }
            else
            {
                $data["pronounce_eng"] = "";
                $data["pronounce_us"] = "";
            }
        }

        return $data;
    }
    
    private  function get_tag($html,$tag)
    {
        //echo "param:<br>$tag,$attr,$value<br>";

        $regex = "/<$tag>(.*?)<\/$tag>/is";
        //echo $regex."<br>";
        preg_match_all($regex,$html,$matches,PREG_PATTERN_ORDER);


        return $matches[1];
    }

    private  function extract_attrib($tag) 
    {
        preg_match_all('/(url)=("[^"]*")/i', $tag, $matches);
        
        return $matches[2];
    } 

    private  function get_tag_data($html,$tag,$attr,$value)
    {
        //echo "param:<br>$tag,$attr,$value<br>";

        $regex = "/<$tag.*?$attr=\".*?$value.*?\".*?>(.*?)<\/$tag>/is";
        echo $regex."<br>";
        preg_match_all($regex,$html,$matches,PREG_PATTERN_ORDER);
        return $matches[1];
    }
}   

?>
