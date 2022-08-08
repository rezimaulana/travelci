<?php 
  
function cek_login(){
	$ci = get_instance();
	if($ci->session->userdata('login') == false){
		redirect(base_url('login-pelanggan'));
	}else{
		$role_id = $ci->session->userdata('role_id');
		$menu = $ci->uri->segment(1);
		$user_menu = $ci->db->get_where('user_menu', ['url' => $menu] )->row_array();

		$userAccess = $ci->db->get_where('user_akses_menu', [
			'role_id' => $role_id,
			'menu_id' => $user_menu['id']
		]); 
			
		if($userAccess->num_rows() < 1){
			redirect(base_url( 'auth/blocked'));
		}
	}
}



