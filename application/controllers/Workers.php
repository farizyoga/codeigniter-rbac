<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Workers extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->userize->init();
        $this->load->model('worker_model');
    }
 
    public function index()
    {
        $this->load->helper('url');
        $this->load->view('view_workers');
    }
 
    public function ajax_list()
    {
        $list = $this->worker_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $person->name;
            $row[] = $person->gender;
            $row[] = $person->handphone_number;
            $row[] = $person->address;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->worker_model->count_all(),
                        "recordsFiltered" => $this->worker_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->worker_model->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $data = array(
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'handphone_number' => $this->input->post('handphone_number'),
                'address' => $this->input->post('address')
            );
        $insert = $this->worker_model->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $data = array(
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'handphone_number' => $this->input->post('handphone_number'),
                'address' => $this->input->post('address')
            );
        $this->worker_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->worker_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}