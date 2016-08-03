<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 25-Jul-16
 * Time: 10:27 PM
 * @property M_system_config   m_system_config
 * @property M_questions       m_questions
 * @property M_feedback_manage m_feedback_manage
 */
class Home extends Guest_layout {

    function __construct() {
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
        $this->load->model('M_questions', 'm_questions');
        $this->load->model('M_feedback_manage', 'm_feedback_manage');

    }

    public function index() {
        $result = $this->m_system_config->get_all();
        $data["menu_1"] = $result[1]->value;
        $data["menu_2"] = $result[2]->value;
        $data["menu_3"] = $result[3]->value;
        $data["menu_4"] = $result[4]->value;
        $data["menu_5"] = $result[5]->value;
        $data["introduce_title"] = $result[6]->value;
        $data["learning_method_1"] = $result[7]->value;
        $data["learning_method_2"] = $result[8]->value;
        $data["learning_method_3"] = $result[9]->value;
        $data["learning_method_4"] = $result[10]->value;
        $data["learning_method_content_1"] = $result[11]->value;
        $data["learning_method_content_2"] = $result[12]->value;
        $data["learning_method_content_3"] = $result[13]->value;
        $data["learning_method_content_4"] = $result[14]->value;
        $data["save_link"] = base_url("home/send_feedback");
        $question = $this->m_questions->get_list_filter([], [], [], 5);
        $data["questions"] = $question;
        $content = $this->load->view("guest/home/view", $data, TRUE);
        $this->show_page($content);
    }

    public function send_feedback() {
        $data = $this->input->post();
        $insert_id = $this->m_feedback_manage->insert($data, TRUE);
        if (!$insert_id == FALSE) {
            echo '<script type="text/javascript">alert("DONE!!");</script>';
        } else {
            echo '<script type="text/javascript">alert("NOT DONE!!");</script>';
        }
        redirect(base_url());
    }
}