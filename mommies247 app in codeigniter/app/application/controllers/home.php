<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
date_default_timezone_set("UTC");
class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("functions");
		
	}
	
	
	public function createDB($subdomain=""){
		if(trim($subdomain)){
			$prefix = "mommies247_";
			$sql = "CREATE DATABASE IF NOT EXISTS ".$prefix.$subdomain ;
			$this->db->query($sql);
		}
	}
	
	public function index()
	{
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
			
			$sql = "select * from `sites` where 1";
			$q = $this->db->query($sql);
			$sites = $q->result_array();
			$data = array();
			$data['username'] = $session_data['username'];
			$data['sites'] = $sites;
			$redirect = $this->load->view("homepage",$data);	
		}
		else{
			redirect(base_url());
		}		
	
	}
	
	public function delete($id){
		$sql = "select * from `sites` where `id`=".$this->db->escape(trim($id))."";
		$q = $this->db->query($sql);
		$subdomain = $q->result_array();
		$subdomain = $subdomain[0]['subdomain'];
		
		/*drop database and user*/
			$dsql = "DROP DATABASE `mommies247_".$subdomain."`";
			$drop = $this->db->query($dsql);
			
			$thedbusername = substr('mommies247_'.$subdomain, 0, 16);
			
			$dluser = "DROP USER '".$thedbusername."'@'localhost';";
			$dropluser = $this->db->query($dluser);
			
			$dauser = "DROP USER '".$thedbusername."'@'%';";
			$dropauser = $this->db->query($dauser);
			
		/*end*/
		
		$sql = "delete from `sites` where `id`=".$this->db->escape(trim($id))."";
		$this->db->query($sql);
		
		
		
		
		if(trim($subdomain)){
			SureRemoveDir(dirname(__FILE__)."/../../../sites/".$subdomain, true);
			$sql = "select * from `sites` where 1";
			$q = $this->db->query($sql);
			$sites = $q->result_array();
			//update htaccess
			$contents = 
'######### auto generated '.date("M d, Y H:i:s e").' ###########
RewriteEngine On
#RewriteCond %{REQUEST_FILENAME} !-f
#RewriteCond %{REQUEST_FILENAME} !-d

RewriteCond %{HTTP_HOST} ^app.mommies247.com$
RewriteRule .* app/$0 [L]

';			
			foreach($sites as $value){
				$subdomain = $value['subdomain'];
				$contents .= '

RewriteCond %{HTTP_HOST} ^'.$subdomain.'.mommies247.com$
RewriteRule .* sites/'.$subdomain.'/$0 [L]
				
				';
			}
			$contents .= '	
RewriteRule ^/?(.*)$ "http://%{HTTP_HOST}/app/router.php" [R=301,L]';
			file_put_contents(dirname(__FILE__)."/../../../.htaccess", $contents);
		}
		redirect(base_url());
	}
	
	public function add()
	{
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
			//create the site
			$err = "";
			$data = array();
			if($_POST){
				$sql = "select * from `sites` where `subdomain`=".$this->db->escape(trim($_POST['subdomain']))."";
				$q = $this->db->query($sql);
				$subdomain = $q->result_array();
				if(!checkSubdomain(trim($_POST['subdomain']))){
					$err = "Please Input a valid Subdomain.";
				}
				else if($subdomain[0]){
					$err = "Subdomain already exists in the database. Please input a new one.";
				}
				else if(!trim($_POST['title'])){
					$err = "Please Input Title.";
				}
				else if(!trim($_POST['admin_username'])&&0){
					$err = "Please Input Admin Username.";
				}
				else if(!trim($_POST['siteadmin_username'])){
					$err = "Please Input Site Admin Username.";
				}
				else if(!trim($_POST['admin_password'])){
					$err = "Please Input Admin Password.";
				}
				else if(!trim($_POST['siteadmin_password'])){
					$err = "Please Input Site Admin Password.";
				}
				else if(!checkEmail($_POST['admin_email'])){
					$err = "Please Input a Valid Admin Email.";
				}
				else if(!checkEmail($_POST['siteadmin_email'])){
					$err = "Please Input a Valid Site Admin Email.";
				}
				if($err){
					$data = $_POST;
					$data['error'] = $err;
				}
				else{
					
					$sql = "insert into `sites` set ";
					$arr = array();
					foreach($_POST as $key=>$value){
						if(!is_array($value)){
							$arr[] ="`".$key."`=".$this->db->escape(trim($value));
						}
					}
					$sqlext = implode(", ", $arr);
					$sqlext = implode(", ", $arr);
					$sql .= $sqlext.", `dateadded`=NOW()";
					$q = $this->db->query($sql);
					$id = $this->db->insert_id();
					
					
					//update htaccess
					$contents = 
'######### auto generated '.date("M d, Y H:i:s e").' ###########
RewriteEngine On
#RewriteCond %{REQUEST_FILENAME} !-f
#RewriteCond %{REQUEST_FILENAME} !-d

RewriteCond %{HTTP_HOST} ^app.mommies247.com$
RewriteRule .* app/$0 [L]

';
					$sql = "select * from `sites` where 1";
					$q = $this->db->query($sql);
					$sites = $q->result_array();
					foreach($sites as $value){
						$subdomain = $value['subdomain'];
						$contents .= '

RewriteCond %{HTTP_HOST} ^'.$subdomain.'.mommies247.com$
RewriteRule .* sites/'.$subdomain.'/$0 [L]
						
						';
						
						if(!is_dir(dirname(__FILE__)."/../../../sites/".$subdomain)){
							@mkdir(dirname(__FILE__)."/../../../sites/".$subdomain, 0777);
							$fcontents = "<?php phpinfo(); ?>";
							file_put_contents(dirname(__FILE__)."/../../../sites/".$subdomain."/info.php", $fcontents);
							
							//$fcontents = $subdomain;
							//file_put_contents(dirname(__FILE__)."/../../../sites/".$subdomain."/index.php", $fcontents);
							
							//extract files
							$zip = new ZipArchive;
							if ($zip->open(dirname(__FILE__).'/resources/base.zip') === TRUE) {
								$zip->extractTo(dirname(__FILE__)."/../../../sites/".$subdomain."/");
								$zip->close();
								
								
								//create the database here..
								$sql = "CREATE DATABASE IF NOT EXISTS mommies247_".$subdomain;
								$this->db->query($sql);
								
								//create user for DB
								$thepassword = "1litervand";
								$thedbusername = substr('mommies247_'.$subdomain, 0, 16);
								
								$sql = "CREATE USER '".$thedbusername."'@'%' IDENTIFIED BY '".$thepassword."';";
								$this->db->query($sql);
								$sql = "GRANT USAGE ON * . * TO '".$thedbusername."'@'%' IDENTIFIED BY '".$thepassword."' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ; ";
								$this->db->query($sql);
								$sql = "GRANT USAGE ON * . * TO '".$thedbusername."'@'localhost' IDENTIFIED BY '".$thepassword."' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ; ";
								$this->db->query($sql);
								$sql = "GRANT ALL PRIVILEGES ON mommies247_".$subdomain." . * TO '".$thedbusername."'@'%';";
								$this->db->query($sql);
								
								$sql = "GRANT ALL PRIVILEGES ON mommies247_".$subdomain." . * TO '".$thedbusername."'@'localhost';";
								$this->db->query($sql);
								
								//exec
								$dbusername = $this->db->username;
								$dbpassword = $this->db->password;
								
								$execstring = "mysql -u".$dbusername." --password=".$dbpassword."  mommies247_".$subdomain." < \"".dirname(__FILE__).'/resources/base.sql"';
								//echo $execstring;
								exec($execstring);
								
								
								//wp_options
								$sql = "update `mommies247_".$subdomain."`.`wp_options` set 
								`option_value` = 'http://".$subdomain.".mommies247.com'
								where 
								`option_name`='siteurl'
								";
								$this->db->query($sql);
								
								$sql = "update `mommies247_".$subdomain."`.`wp_options` set 
								`option_value` = 'http://".$subdomain.".mommies247.com'
								where 
								`option_name`='home'
								";
								$this->db->query($sql);
								
								$sql = "update `mommies247_".$subdomain."`.`wp_options` set 
								`option_value` = '".mysql_real_escape_string($_POST['title'])."'
								where 
								`option_name`='blogname'
								";
								$this->db->query($sql);
								
								//admin_email -> wp_options
								$sql = "update `mommies247_".$subdomain."`.`wp_options` set 
								`option_value` = '".mysql_real_escape_string($_POST['admin_email'])."'
								where 
								`option_name`='admin_email'
								";
								$this->db->query($sql);
								
								
								//wp_users
								
								$sql = "update `mommies247_".$subdomain."`.`wp_users` set 
								`user_pass` = '".md5($_POST['admin_password'])."'
								where 
								`user_login`='admin'
								";
								$this->db->query($sql);
								
								$sql = "update `mommies247_".$subdomain."`.`wp_users` set 
								`user_email` = '".mysql_real_escape_string($_POST['admin_email'])."'
								where 
								`user_login`='admin'
								";
								$this->db->query($sql);
								
								
								//website_admin email -> wp_options
								
								$sql = "update `mommies247_".$subdomain."`.`wp_users` set 
								`user_login` = '".mysql_real_escape_string($_POST['siteadmin_username'])."'
								where 
								`id`= '5'
								";
								$this->db->query($sql);
								
								$sql = "update `mommies247_".$subdomain."`.`wp_users` set 
								`user_pass` = '".md5($_POST['siteadmin_password'])."'
								where 
								`id`= '5'
								";
								$this->db->query($sql);
								
								$sql = "update `mommies247_".$subdomain."`.`wp_users` set 
								`user_email` = '".mysql_real_escape_string($_POST['siteadmin_email'])."'
								where 
								`id`= '5'
								";
								$this->db->query($sql);
								
								//wp-config file
								$wp_config = dirname(__FILE__)."/../../../sites/".$subdomain."/wp-config.php";
								$conf_contents = file_get_contents(dirname(__FILE__).'/resources/wp-config.php');
								$conf_contents = str_replace("[DB_NAME]", "mommies247_".$subdomain, $conf_contents);
								$conf_contents = str_replace("[DB_USER]", $thedbusername, $conf_contents);
								$conf_contents = str_replace("[DB_PASSWORD]", $thepassword, $conf_contents);
								file_put_contents($wp_config, $conf_contents);
								
								//bb-config file
								$bb_config = dirname(__FILE__)."/../../../sites/".$subdomain."/bb-config.php";
								$conf_contents = file_get_contents(dirname(__FILE__).'/resources/bb-config.php');
								$conf_contents = str_replace("[DB_NAME]", "mommies247_".$subdomain, $conf_contents);
								$conf_contents = str_replace("[DB_USER]", $thedbusername, $conf_contents);
								$conf_contents = str_replace("[DB_PASSWORD]", $thepassword, $conf_contents);
								file_put_contents($bb_config, $conf_contents);
								
							}
							else {
							
							}
							
							
							$fcontents = "# BEGIN WordPress
	<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteBase /
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . /index.php [L]
	</IfModule>
	# END WordPress";
							file_put_contents(dirname(__FILE__)."/../../../sites/".$subdomain."/.htaccess", $fcontents);
							passthru("chown hobokenmommies:psacln ".dirname(__FILE__)."/../../../".$subdomain);
						}
					}
					
					
					$contents .= '	
RewriteRule ^/?(.*)$ "http://%{HTTP_HOST}/app/router.php" [R=301,L]';
					file_put_contents(dirname(__FILE__)."/../../../.htaccess", $contents);

					/*$linkit = "&nbsp; <a href='http://app.mommies247.com/app/home'>View List</a>";*/
					$data['success'] = "Successfully created subdomain!";/*".$linkit."*/
				}
			}
			
			
			$data['username'] = $session_data['username'];
			$redirect = $this->load->view("addpage",$data);	
		}
		else{
			redirect(base_url());
		}	
	}
	
	public function logout()
	{
		$this->session->unset_userdata('admin_user');
		session_destroy();
		redirect(base_url().'login');
	}
		
}
