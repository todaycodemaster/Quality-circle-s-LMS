<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
/**
 * Created by PhpStorm.
 * User: Timon
 * Date: 10/28/2018
 * Time: 9:45 AM
 */
class Live extends BaseController {
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Live_model');
        $this->load->model('User_model');
        $this->load->model('Account_model');
		$this->load->model('Course_model');
		$this->load->model('Enrollments_model');		
		$this->load->helper('common');	
        $this->isLoggedIn();
    }
    /**
     * This function used to load the default screen of trainingassign menu
     */
    public function index(){
        $this->showLive();
    }

    public function viewclass($id){
        $this->load->library('Sidebar');
        $side_params = array('selected_menu_id' => '6');
        $this->global[sidebar] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $training_data = array();
           // $res_id_list = $this->Live_model->getListCourseById(array(id => intval($id))) [0];		   
		   	$res_id_list = $this->Live_model->getListByVirtualCourseId(intval($id))[0];
            $instructor = json_decode($res_id_list['instructors']) [0];
            $res_id_list['instructor_email'] = $this->User_model->getList(array(id => $instructor)) [0]['email'];
			$res_id_list['instructor_emails'] = [];         
			if(isset($res_id_list['instructors'])){
				$res_id_list['instructors'] = str_replace('"','',$res_id_list['instructors']);
				$res_id_list['instructors'] = str_replace('[','',$res_id_list['instructors']);
				$res_id_list['instructors'] = str_replace(']','',$res_id_list['instructors']);
				$explode = explode(',',$res_id_list['instructors']);
				foreach($explode as $iKey => $iVal){
					$res_id_list['instructor_emails'][$iKey] = $this->User_model->getList(array(id => $iVal))[0]['email'];
				}	
			}
			$courseDetail = $this->Course_model->getCourseById($res_id_list['course_id']);
			$totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($res_id_list['course_id'],$id);
			$res_id_list['enroll_users'] = $totalCourseEnrollments;
			$training_data['course_list'] = $res_id_list;
            $this->loadViews("learner/live/live_detail", $this->global, $training_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function showLive(){
        $this->load->library('Sidebar');
		$course = $this->input->get('course');
        $side_params = array('selected_menu_id' => '6');
        $this->global[sidebar] = $this->sidebar->generate($side_params, $this->role);
        if($this->isLearner()){
            $training_data = array();
			if($course != null && $course != 'all') {
				$result_list = $this->Live_model->getListByVirtualCourseId($course);
			}else{
            	$result_list = $this->Live_model->getListByCompanyId($this->session->get_userdata() ['company_id']);
			}
            //$res_id_list = $this->Live_model->getListCourseId($this->session->get_userdata()['company_id']);
            $res_course_list = array();
            $instructor = array();
            foreach($result_list as $key => $row){				
				$courseId = $row['id'];
				if(isset($row['course_id'])){
					$courseId = $row['course_id'];
				}
                $ids = $this->Course_model->getCourseById($courseId);
				if(!empty($ids)){
					$instructor = json_decode($row['instructors']) [0];				
					$row['instructor_email'] = $this->User_model->getList(array(id => $instructor)) [0]['email'];					
					$res_course_list[$row['id']] = $row;					
				}
				$res_course_list[$row['id']]['is_pay'] = $this->db->where('user_id',$this->session->userdata('user_id'))
						->where('object_type','live')
						->where('object_id',$row['id'])
						->select('id')
						->get('payment_history')
						->row_array();
               
            }
            $training_data['course_list'] = $res_course_list;
			$training_data['coursesfilter'] = $this->Live_model->getListByCompanyId($this->session->get_userdata() ['company_id']);
			$this->global['courses_id'] = $course;							
            $this->loadViews("learner/live/live_list", $this->global, $training_data, NULL);
        }else{
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    
    public function pay_course($course_id = NULL,$time_id = NULL){
        $course_id = $this->input->post('course_id');
		$time_id = $this->input->post('time_id');
		$vilt_course_id = $this->input->post('vilt_course_id');
		
		
        $user_id = $this->session->get_userdata() ['user_id'];
        //$this->Course_model->pay_course(array("user_id"=>$user_id,"course_id"=>$row_id));
        $price = $this->Live_model->getCourseById($course_id) ['pay_price'];
        $data['amount'] = $price;
        $data['user_id'] = $user_id;
        $data['object_type'] = 'live';
        $data['object_id'] = $course_id;
        $this->db->set("company_id", "(select create_id from virtual_course where id = " . $course_id . ")", false);
        $this->Account_model->insert_payment($data);
		if($vilt_course_id != '' && isset($vilt_course_id)){
			$course_id = $vilt_course_id;
		}
		$course_data = $this->Course_model->getCourseById($course_id);
		$totalCourseEnrollments = $this->Enrollments_model->totalCourseEnrollments($course_id,$time_id);
		if($totalCourseEnrollments == 0){
			$enrolled_data = array(
				'user_id' => $this->session->get_userdata()['user_id'],
				'course_id' => $course_id,			
				'course_time_id' => $time_id,					
				'course_title' => $course_data["title"],
				'user_name' => $this->session->get_userdata()['user_name'],
				'user_email' => $this->session->get_userdata()['email'],
				'create_date' => date("Y-m-d H:i:s"),					
			);	
			$this->Enrollments_model->insertEnrolledUser($enrolled_data);	
		}
        /*start send_email*/
        /*end send_email*/
        // $this->response($records);
        $this->response($data = 'success');
    }
}
