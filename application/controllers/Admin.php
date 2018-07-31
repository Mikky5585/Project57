<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Admin extends CI_Controller
{
    public $id;
    public function __construct()
    {
        parent::__construct();
        //Loading the Models
        $this->load->library('ion_auth');
        $this->load->model('Categories_model');
        $this->load->model('Product_model');
        $this->load->library('form_validation');
        
    }

    public function index()
      {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $user = $this->ion_auth->user()->row();
        $userpic = $user->image;
        $this->session->set_userdata('userpic',$userpic);
        $data['total_pro'] = $this->db->count_all('product');
        $this->load->view('Admin/header');
        $this->load->view('Admin/dashboard',$data);
        $this->load->view('Admin/footer');
        }else{
            redirect(base_url() .'Login');
        }
    }

    public function profile(){

        $data['user'] = $this->ion_auth->user()->row();
        $this->load->view('Admin/header');
        $this->load->view('Admin/Adminprofile', $data);
        $this->load->view('Admin/footer');

    }

    public function editprofile(){

        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $data = array(
                                'first_name' => $this->input->post('fname'),
                                'last_name' => $this->input->post('lname'),
                                'password' => $this->input->post('newpass'),
                                'username' => $this->input->post('username')
                                

                                );
                    $this->ion_auth->update($id, $data);
                    redirect(base_url() .'Admin/profile');
                        
                }else
                {
                        $data = array('upload_data' => $this->upload->data());
                         echo $data['upload_data']['file_name'];
                 $data = array(
                                'first_name' => $this->input->post('fname'),
                                'last_name' => $this->input->post('lname'),
                                'username' => $this->input->post('username'),
                                'password' => $this->input->post('newpass'),
                                'image' => $data['upload_data']['file_name']
                                );
        $this->ion_auth->update($id, $data);
        redirect(base_url() .'Admin/profile');
             }
        }else{
            redirect(base_url() .'Login');
        }
    
    }


    public function Categories_list()
    {   
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $q = urldecode($this->input->get('q', TRUE));
         $start = intval($this->input->get('start'));
        
         if ($q <> '') {
             $config['base_url'] = base_url() . 'Admin/Categories_list.html?q=' . urlencode($q);
             $config['first_url'] = base_url() . 'Admin/Categories_list.html?q=' . urlencode($q);
         } else {
             $config['base_url'] = base_url() . 'Admin/Categories_list.html';
             $config['first_url'] = base_url() . 'Admin/Categories_list.html';
         }

         $config['per_page'] = 10;
         $config['page_query_string'] = TRUE;
         $config['total_rows'] = $this->Categories_model->total_rows($q);
         $categories = $this->Categories_model->get_limit_data($config['per_page'], $start, $q);

         $this->load->library('pagination');
         $this->pagination->initialize($config);

         $data = array(
             'categories_data' => $categories,
             'q' => $q,
             'pagination' => $this->pagination->create_links(),
             'total_rows' => $config['total_rows'],
             'start' => $start,
         );
         
         $this->load->view('Admin/header');
         $this->load->view('Admin/catloglist', $data);
         $this->load->view('Admin/footer');
        }else{
            redirect(base_url() .'Login');
        }
    }

    public function productlist()
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Admin/productlist.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Admin/productlist.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Admin/productlist.html';
            $config['first_url'] = base_url() . 'Admin/productlist.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_model->total_rows($q);
        $product = $this->Product_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_data' => $product,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
         $this->load->view('Admin/header');
         $this->load->view('Admin/product_list', $data);
         $this->load->view('Admin/footer');
         }else{
            redirect(base_url() .'Login');
        }
       
    }

    public function read($id) 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $row = $this->Product_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'catid' => $row->catid,
                'name' => $row->name,
                'image' => $row->image,
                'details' => $row->details,
                'price' => $row->price,
                );
            $this->load->view('Admin/header');
            $this->load->view('Admin/productread', $data);
            $this->load->view('Admin/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Admin/productlist'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }

    public function create() 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $query = $this->db->get('categories'); 
        $data['selectcatlog'] = $query->result();  
        $this->load->view('Admin/header');
        $this->load->view('Admin/addproduct',$data);
        $this->load->view('Admin/footer');
        }else{
            redirect(base_url() .'Login');
        }
    }

    
    
    public function create_action() 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                

                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $data = array(
                        'catid' => $this->input->post('catid',TRUE),
                        'name' => $this->input->post('name',TRUE),
                        'details' => $this->input->post('details',TRUE),
                        'price' => $this->input->post('price',TRUE),
                        );

            $this->Product_model->insert($data);
            $this->id = $this->db->insert_id();
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Admin/productlist'));
                        
                }else
                {
                        $data = array('upload_data' => $this->upload->data());
                         echo $data['upload_data']['file_name'];
                        $data = array(
                        'catid' => $this->input->post('catid',TRUE),
                        'name' => $this->input->post('name',TRUE),
                        'image' =>$data['upload_data']['file_name'],
                        'details' => $this->input->post('details',TRUE),
                        'price' => $this->input->post('price',TRUE),
                        );

            $this->Product_model->insert($data);
            $this->id = $this->db->insert_id();
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Admin/productlist'));
                }
                }else{
            redirect(base_url() .'Login');
        }
            
        
    }



    public function update($id) 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            
            $data = array(
                'button' => 'Update',
                'action' => site_url('Admin/update_action'),
                'id' => set_value('id', $row->id),
                'catid' => set_value('catid', $row->catid),
                'name' => set_value('name', $row->name),
                'image' => set_value('image', $row->image),
                'details' => set_value('details', $row->details),
                'price' => set_value('price', $row->price),
                );
            $query = $this->db->get('categories'); 
            $data['selectcatlog'] = $query->result();
            $this->load->view('Admin/header');
            $this->load->view('Admin/product_form', $data);
            $this->load->view('Admin/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Admin/productlist'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }
    
    public function update_action() 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                

                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('image'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $data = array(
                            'catid' => $this->input->post('catid',TRUE),
                            'name' => $this->input->post('name',TRUE),
                            
                            'details' => $this->input->post('details',TRUE),
                            'price' => $this->input->post('price',TRUE),
                            );

            $this->Product_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Admin/productlist'));
                        
                }else
                {
                     $imagedata = array('upload_data' => $this->upload->data());

            $data = array(
                'catid' => $this->input->post('catid',TRUE),
                'name' => $this->input->post('name',TRUE),
                'image' =>$imagedata['upload_data']['file_name'] ,
                'details' => $this->input->post('details',TRUE),
                'price' => $this->input->post('price',TRUE),
                );

            $this->Product_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Admin/productlist'));
        }
    }
    }else{
            redirect(base_url() .'Login');
        }
}
    

    // public function imageupload(){
    //    $data = array();

    //     if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
    //         $filesCount = count($_FILES['files']['name']);
    //         for($i = 0; $i < $filesCount; $i++){
    //             $_FILES['file']['name']     = $_FILES['files']['name'][$i];
    //             $_FILES['file']['type']     = $_FILES['files']['type'][$i];
    //             $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
    //             $_FILES['file']['error']     = $_FILES['files']['error'][$i];
    //             $_FILES['file']['size']     = $_FILES['files']['size'][$i];
    //             $uploadPath = 'uploads/files/';
    //             $config['upload_path'] = $uploadPath;
    //             $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
                
    //             $this->load->library('upload', $config);
    //             $this->upload->initialize($config);
                
                
    //             if($this->upload->do_upload('image')){
                
    //                 $fileData = $this->upload->data();
    //                 $uploadData[$i]['file_name'] = $fileData['file_name'];
    //                 $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
    //             }
    //         }
            
    //         if(!empty($uploadData)){
                
    //             $insert = $this->file->insert($uploadData);
                
            
    //             $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
    //             $this->session->set_flashdata('statusMsg',$statusMsg);
    //         }
    //     }
        

    //     $data['files'] = $this->file->getRows();
        
        
    //     $this->load->view('upload_files/index', $data);
    // }
    public function delete($id) 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $row = $this->Product_model->get_by_id($id);

        if ($row) {
            $this->Product_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Admin/productlist'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Admin/productlist'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('catid', 'catid', 'trim|required');
    $this->form_validation->set_rules('name', 'name', 'trim|required');
   // $this->form_validation->set_rules('image', 'image', 'trim|required');
    $this->form_validation->set_rules('details', 'details', 'trim|required');
    $this->form_validation->set_rules('price', 'price', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function catlog_read($id) 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $row = $this->Categories_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'catlog' => $row->catlog,
        );
            $this->load->view('Admin/header');
            $this->load->view('Admin/catlogread', $data);
            $this->load->view('Admin/footer');
          
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categories'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }

    public function catlog_create() 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $data = array(
            'button' => 'Add',
            'action' => site_url('Admin/catlog_create_action'),
            'id' => set_value('id'),
            'catlog' => set_value('catlog'),
                );
        $this->load->view('Admin/header');
        $this->load->view('Admin/categories_form', $data);
        $this->load->view('Admin/footer');
        }else{
            redirect(base_url() .'Login');
        }
    }
    
    public function catlog_create_action() 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $this->catlog_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->catlog_create();
        } else {
            $data = array(
        'catlog' => $this->input->post('catlog',TRUE),
        );

            $this->Categories_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Admin/Categories_list'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }
    
    public function catlogupdate($id) 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
       $row = $this->Categories_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Admin/catlog_update_action'),
        'id' => set_value('id', $row->id),
        'catlog' => set_value('catlog', $row->catlog),
        );
            $this->load->view('Admin/header');
             $this->load->view('Admin/categories_form', $data);
             $this->load->view('Admin/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categories'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }
    
    public function catlog_update_action() 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $this->catlog_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
        'catlog' => $this->input->post('catlog',TRUE),
        );

            $this->Categories_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Admin/Categories_list'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }
    
    public function delete_catlog($id) 
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
        $row = $this->Categories_model->get_by_id($id);

        if ($row) {
            $this->Categories_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Admin/Categories_list'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Admin/Categories_list'));
        }
        }else{
            redirect(base_url() .'Login');
        }
    }

    public function catlog_rules() 
    {
    $this->form_validation->set_rules('catlog', 'catlog', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    
    public function logout(){

        redirect(base_url() . 'index.php/User');
    }

    private function get_database(){
        $query = $this->db->query("SELECT first_name, last_name, phone_no, email, passed_year, jobs.company_name,business.company_name as business_name, jobs.industry, business.industry as business_industry, academics.college_name, academics.field_of_study FROM general_info LEFT JOIN jobs on general_info.id = jobs.s_id LEFT JOIN business on general_info.id = business.s_id LEFT JOIN academics on general_info.id = academics.s_id ");
        return $query->result();
    }



}