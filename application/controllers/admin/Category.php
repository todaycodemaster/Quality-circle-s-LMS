<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
require APPPATH . 'third_party/woocommerce/autoload.php';
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
/**
 * Class : Category (CategoryController)
 * Category Class to control all category related operations.
 * @author : ping
 * @version : 1.0
 * @since : 26 June 2018
 */
class Category extends BaseController{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('Standard_model');
		$this->load->model('Location_model');
		
        $this->isLoggedIn();
        $this->woocommerce = new Client('https://shop.gosmartacademy.com/', 'ck_b6411a22ed11f224a13d68bc2bb642a4227b69c3', 'cs_ae6ff61f63bed83c2d2e1880b1634449f30a2c04', ['version' => 'wc/v3', ]);
    }

    public function index(){
        $this->viewList();
    }
    /**
     * This function used to load the first screen of the user
     */
    public function viewList(){
        $this->load->library('Sidebar');
        if($this->isMasterAdmin()){
            $side_params = array('selected_menu_id' => '15');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->loadViews("admin/category/category_list", $this->global, NULL, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }

    public function viewCreate(){
        $this->load->library('Sidebar');
        if($this->isMasterAdmin()){
            $side_params = array('selected_menu_id' => '15');
            $this->global['sidebar'] = $this->sidebar->generate($side_params, $this->role);
            $this->load->library('form_validation');
            $page_data[id] = intval($this->input->post('row_id'));
            if($page_data[id] != 0){
                $category_data = $this->Category_model->getRow($page_data[id]);
                $page_data[category] = $category_data[0];
            }else{
                $page_data[category] = '';
            }
            $this->loadViews("admin/category/category_edit", $this->global, $page_data, NULL);
        }else{
            $this->global['sidebar'] = $this->sidebar->generate();
            $this->loadViews("access", $this->global, NULL, NULL);
        }
    }
    /**
     * This function used to load All category list
     */
    public function getList(){
        //$total = $this->Category_model->all();
        $out_data = array();
        $table_data['data'] = $this->Category_model->getListByCompanyID($this->session->get_userdata() ['company_id']);
        $table_data['recordsTotal'] = 0;
        $table_data['recordsFiltered'] = 0;
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['recordsTotal'] = count($table_data['data']);
            $table_data['recordsFiltered'] = count($table_data['data']);
        }
        $this->response($table_data);
    }

    public function getStandardList(){
        //$total = $this->Category_model->all();
        $category_id = $this->input->post('category_id');
        $table_data['data'] = $this->Standard_model->getStandardListByCategoryId($category_id);
        $table_data['recordsTotal'] = 0;
        $table_data['recordsFiltered'] = 0;
        foreach ($table_data['data'] as $key => $row){
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['recordsTotal'] = count($table_data['data']);
            $table_data['recordsFiltered'] = count($table_data['data']);
        }
        $this->response($table_data);
    }

    public function saveStandard(){
        $id = $this->input->post('standard_id');
        $name = $this->input->post('standard_name');
        $category_id = $this->input->post('category_id');
        if(intval($id) == 0){
            $row_id = $this->Standard_model->insert(array('name' => $name, 'category_id' => $category_id));
        }else{
            $row_id = $this->Standard_model->update(array('name' => $name, 'category_id' => $category_id), $id);
        }
        $this->response($row_id);
    }

    public function delete_standard(){
        $id = $this->input->post('id');
        if($this->Standard_model->delete($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
    /**
     * This function used to load Actived category list
     */
    public function getCategoryList(){
        $table_data = $this->Category_model->getList4Select2(isset($_REQUEST['q']) ? $_REQUEST['q'] : '');
        $records["results"] = $table_data;
        $this->response($records);
    }

    public function selectrow($id){
        $out_data = $this->Category_model->getRow($id);
        $this->response($out_data);
    }

    public function saveCategory(){
        $category_data = array();
        foreach ($this->input->post() as $key => $value){
            $category_data[$key] = $value;
        }
        $category_data['company_id'] = $this->session->get_userdata() ['company_id'];
        if(intval($category_data[id]) == 0){
            unset($category_data[id]);
            // Add Category Data records to Woocommerce Categories Section
            $data = array('name' => $category_data['name']);
            //$wcmCatResult = $this->woocommerce->post('products/categories', $data);
            if(isset($wcmCatResult) && !empty($wcmCatResult) && $wcmCatResult->id){
                $category_data['wcm_cat_id'] = $wcmCatResult->id;
            }
            $row_id = $this->Category_model->insert($category_data);
        }else{
            $row_id = $category_data[id];
            $wcm_id = $category_data[wcm_cat_id];
            $data = array('name' => $category_data['name']);
            //$wcmCatResult = $this->woocommerce->put('products/categories/' . $row_id, $data);
            $this->Category_model->update($category_data, $category_data[id]);
        }
        redirect('admin/category');
    }

    public function active(){
        $id = $this->input->post('id');
        $data[status] = 1;
        return $this->Category_model->update($data, $id);
    }

    public function inactive(){
        $id = $this->input->post('id');
        $data[status] = 0;
        return $this->Category_model->update($data, $id);
    }

    public function update($id){
        $category_data = array();
        foreach ($this->input->post() as $key => $value){
            if($key == 'file') continue;
            $category_data[$key] = $value;
        }
        return $this->Category_model->update($category_data, $id);
    }

    public function delete($id, $wcm_cat_id=NULL){
        $out_data = array();
       // $this->woocommerce->delete('products/categories/' . $wcm_cat_id, ['force' => true]);
        if($this->Location_model->delete($id)){
            $out_data["status"] = "Success";
            $out_data["message"] = "";
        }else{
            $out_data["status"] = "Fail";
            $out_data["message"] = "Could not delete the row.";
        }
        $this->response($out_data);
    }
}
?>