<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'Tank_auth.php';

/**
 * Extends the Tank Auth library with minimal support for groups
 *
 * @author John.Wright
 */
class Tank_auth_groups extends Tank_auth {
    
    function __construct()
    {
		//Run parent constructor to setup everything normally
		parent::__construct();

		//Load the groups extension model in place of 'users'
		$this->ci->load->model('tank_auth/ta_groups_users','ta_groups_users');
		$this->ci->users = $this->ci->ta_groups_users;
    }
    
    /**
     * Check if logged in user is a group member of the given group id
     *
     * @param	string
     * @return	bool
     */
    function is_group_member($group_name)
    {
        $group_id = $this->ci->ta_groups_users->get_group_id($group_name);
		return $this->ci->session->userdata('group_id') === $group_id;
    }
    
    /**
     * Check if logged in user is an admin
     *
     * @return	bool
     */
    function is_admin()
    {
        $group_id = $this->ci->config->item('admin_group', 'tank_auth');
		return $this->ci->session->userdata('group_id') === $group_id;
    }
    
    /**
     * Login user on the site. Return TRUE if login is successful
     * (user exists and activated, password is correct), otherwise FALSE.
     *
     * @param	string	(username or email or both depending on settings in config file)
     * @param	string
     * @param	bool
     * @return	bool
     */
    function login($login, $password, $remember, $login_by_username, $login_by_email)
    {
		$loggedIn = parent::login($login, $password, $remember, $login_by_username, $login_by_email);

		if($loggedIn) 
		{
			$user = $this->ci->users->get_user_by_email($this->get_useremail());
			$this->ci->session->set_userdata(array('group_id'	=> $user->group_id));
		}
				
		return $loggedIn;
    }
}
