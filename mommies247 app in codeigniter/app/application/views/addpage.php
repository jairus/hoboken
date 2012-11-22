<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mommies 247 | Create Site</title>
   <link type="text/css" rel="stylesheet" href="<?php echo base_url('media/css/style.css'); ?>" />
</head>

<body>
	<div id="mom247-container">
    	<table width="100%" cellspacing="0" cellpadding="0">
        	<tbody>
            	<tr>
                	<td id="header">
                    	<table width="100%" cellspacing="0" cellpadding="0">
                        	<tbody>
                            	<tr>
                                	<td><a href="<?php echo base_url();?>"><img src="<?php echo base_url('media/images/header-logo.png');?>"/></a></td>
                                    <td class="right"> Welcome <?php echo $username;?>!  <a href="<?php echo base_url(); ?>home/logout">Log out</a>	</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr> <!--end of header -->
                <tr>
                	<td id="menu">
                			    
                    </td>
                </tr> <!-- end of menu -->
                
                <tr>
                	<td id="content">
                        <form method="post" id="site_form" enctype="multipart/form-data">
                        <table width="100%" cellpadding="10px">
                        <tbody>
                          <tr>
                          	<td class="bold font18" colspan="2">Create New Site</td>
                          </tr>
						  <?php
						  if(trim($error)){
							  ?>
							  <tr>
								<td class="error" colspan="2"><?php echo $error; ?></td>
							  </tr>
							  <?php
						  }
						  else if(trim($success)){
							  ?>
							  <tr>
								<td class="success" colspan="2"><?php echo $success; ?></td>
							  </tr>
							  <?php
						  }
						  ?>
                          <tr>
                          	<td width="50%">
                                <table width="100%" cellpadding="2">
                                  <tr class="even">
                                    <td>* Subdomain</td>                            
                                    <td><input type="text" name="subdomain" value="<?php echo sanitizeX($subdomain); ?>" size="40">.mommies247.com</td>
                                  </tr>
                                  <tr class="odd">
                                    <td>* Site Title</td>
                                    <td><input type="text" name="title" value="<?php echo sanitizeX($title); ?>" size="40"></td>
                                  </tr>
                                  <tr class="even">
                                    <td>Super Admin Username:</td>
                                    <td>
                                   admin
                                    </td>
                                  </tr>
                                  <tr class="odd">
                                    <td>* Super Admin Password:</td>
                                    <td>
                                    <input type="text" name="admin_password" value="<?php echo sanitizeX($admin_password); ?>" size="35"/>
                                    </td>
                                  </tr>
                                  <tr class="even">
                                    <td>* SuperAdmin Email Address: </td>
                                    <td><input type="text" name="admin_email" value="<?php echo sanitizeX($admin_email); ?>" size="35"></td>
                                  </tr>
                                </table>
                            </td>
                           	<td width="50%">
                                <table width="100%">
                                 <tr class="even">
                                    <td>* Site Admin Username:</td>
                                    <td>
                                   <input type="text" name="siteadmin_username" value="<?php echo sanitizeX($siteadmin_username); ?>" size="35"/>
                                    </td>
                                  </tr>
                                  <tr class="odd">
                                    <td>* Site Admin Password:</td>
                                    <td>
                                    <input type="text" name="siteadmin_password" value="<?php echo sanitizeX($siteadmin_password); ?>" size="35"/>
                                    </td>
                                  </tr>
                                  <tr class="even">
                                    <td>* Admin Email Address: </td>
                                    <td><input type="text" name="siteadmin_email" value="<?php echo sanitizeX($siteadmin_email); ?>" size="35"></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                          	<td class="center" colspan="2">
                            	<table width="100%">
                                	<tbody>
                                    	<tr>
                                        	<td width="100%">
                                            	<input id="save_button" type="submit" value="Create">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                        </form>
                        
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
        	<img src="<?php echo base_url('media/images/footer-content-image.png'); ?>" />
        </div>
    </div>
</body>
</html>