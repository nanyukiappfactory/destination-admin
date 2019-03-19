[10:06 AM] Sarafina Gachari
publicfunctionindex($order = 'user.first_name', $order_method = 'ASC')
{
$where = 'user.deleted=0';
$first_name=$this->session->userdata("first_name");
$last_name=$this->session->userdata("last_name");
if(!empty($first_name) && !empty($last_name))
{
$where.=' AND (first_name="'.$first_name.'")';
$where.=' AND (last_name="'.$last_name.'")';
}
if(!empty($first_name) && $first_name != null)
{
$where.=' AND (first_name="'.$first_name.'")';
}
if((!empty($last_name) && $last_name != null))
{
$where.=' AND (last_name="'.$last_name.'")';
}
$close="users/close-search";

$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
$query = $this->Users_model->get_user($table, $where, $config["per_page"], $page, $order, $order_method);
if ($order_method == 'DESC')
{
$order_method = 'ASC';
}
else
{
$order_method = 'DESC';
}
$v_data = array(
"all_users"=>$query,
"order" => $order,
"order_method" => $order_method,
"page" => $page,
"close"=>$close,
"links" => $this->pagination->create_links()
);
$data = array(
"title" => "Users",
"content" => $this->load->view("admin/users/all_users", $v_data, true),
);
$this->load->view("site/layouts/layout", $data);
}
publicfunctionusername_exists($username_exists)
{
$where = array("username" => $username_exists, "deleted" =>0);
$query = $this->db->get_where("user", $where);
if ($query->num_rows() > 0)
{
$this->form_validation->set_message("username_exists", "that {field} already exists");
returnFALSE;
}
else
{
returnTRUE;
}
[10:06 AM] Sarafina Gachari
publicfunctionexecute_search($first_name=null,$last_name=null)
{
$first_name = $this->input->post('first_name');
$last_name = $this->input->post('last_name');
if (!empty($first_name) && $first_name != null)
{
$this->session->set_userdata("first_name",$first_name);
}
if(!empty($last_name) && $last_name != null)
{
$this->session->set_userdata("last_name",$last_name);
}
redirect("users/all-users");
}
}