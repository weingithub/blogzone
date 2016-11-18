<?php
class Vocabulary extends CI_Model {

    public function __construct()
    {
        $this->load->database("tool");
        //$this->db->_db_set_charset("utf8");
    }

    public function get_word($param)
    {
        //查询表
        $query = $this->db->get_where('harrypotter', array('vocabulary' => $param));

        return $query->result_array();
    }

    public function save_word($param, $res)
    {
        $dataval = array('vocabulary' => $param["word"], 'page' => $param["page"], 'seq' => $param["seq"],
                        'phonogram_eng' => $res["phonogram_eng"], 'phonogram_us' => $res["phonogram_us"], 'pronounce_eng' => $res["pronounce_eng"], 'pronounce_us' => $res["pronounce_us"],  'meaning' => $param["mean"])
;
        $artstr = $this->db->insert_string('harrypotter', $dataval);

        $this->db->query($artstr);
    }

}

?>
