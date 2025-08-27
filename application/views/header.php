<?php
$page_title = isset($page_title) && $page_title ? $page_title : 'Dashboard';
$page_name = isset($page_name) && $page_name ? $page_name : 'dashboard';
?>
<title><?php echo ucwords($page_title); ?></title>
<?php
$user_id= $this->session->userdata('id');
$role=$this->db->get_where('login' , array('login_id'=>$user_id))->row()->role;
?>
<?php if($role=="admin") { ?>
<div class="row">
  <div class="col-md-4">
    <h3 class="dashboard-page-title"><?php echo ucwords($page_title)?><!-- <small>main page</small> --></h3>
  </div>
  <?php if($page_name=="dashboard"){?>
   <?php if($role=="admin"){?>
    <div class="col-md-8 text-md-right">
      
    </div>
  <?php }else{}?>
  <?php }?>
</div>
<?php } ?>
<!-- .row -->