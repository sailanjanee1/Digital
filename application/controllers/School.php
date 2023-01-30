<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class School extends CI_Controller {
 
   public function __construct() {
      parent::__construct();
      $this->load->model('School_model', 'school'); 
   }
 
   
  /*
    View page of school
  */
  public function index()
  {
    $data['title'] = "School Manager";
    $this->load->view('schools',$data);
 
  }
 
  /*
    Get all records 
  */
  public function show_all()
  {
    $schools = $this->school->get_all();
    header('Content-Type: application/json');
    echo json_encode($schools);
  }
 
  /*
 
    Get a record
  */
  public function show($id)
  {
    $school = $this->school->get($id);
    header('Content-Type: application/json');
    echo json_encode($school);
  }
 
 
  /*
    Save the submitted record
  */
  public function store()
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('location', 'Location', 'required');
     
    if (!$this->form_validation->run())
    {
      http_response_code(412);
      header('Content-Type: application/json');
      echo json_encode([
        'status' => 'error',
        'errors' => validation_errors()
      ]);
    } else {
       $this->school->store();
       header('Content-Type: application/json');
       echo json_encode(['status' => "success"]);
    }
 
  }
 
  /*
    Edit a record 
  */
  public function edit($id)
  {
    $school = $this->school->get($id);
    header('Content-Type: application/json');
    echo json_encode($school);   
  }
 
  /*
    Update the submitted record
  */
  public function update($id)
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('location', 'Location', 'required');
    if (!$this->form_validation->run())
    {
      http_response_code(412);
      header('Content-Type: application/json');
      echo json_encode([
        'status' => 'error',
        'errors' => validation_errors()
      ]);
    } else {
       $this->school->update($id);
       header('Content-Type: application/json');
       echo json_encode(['status' => "success"]);
    }
 
 
  }
 
  /*
    Delete a record
  */
  public function delete($id)
  {
    $item = $this->school->delete($id);
    header('Content-Type: application/json');
    echo json_encode(['status' => "success"]);
  }
 
 
}