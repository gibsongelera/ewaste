
<?php
if (!isset($crumb)) $crumb = 1;
if (!isset($url)) $url = '';
if (!isset($sub)) $sub = '';
if (!isset($page_title)) $page_title = '';
if (!isset($page_name)) $page_name = '';
if (!isset($role)) $role = '';
?>
<?php if($role !== 'collector' && $page_name !== 'dashboard') { ?>
<section class="ls with_bottom_border">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <ol class="breadcrumb darklinks">
                <?php if($crumb==1){?>
                <li>
                   <li><a href="javascript:void(0);" style="pointer-events:none; color:inherit;">Homepage</a></li>
                </li>
                <li class="active"><?php echo ucwords((string)$page_title)?></li>
              <?php }else{?>
                <li>
                   <li><a href="javascript:void(0);" style="pointer-events:none; color:inherit;">Homepage</a></li>
                </li>
                <li>
                  <a href="<?php echo base_url().$url?>"><?php echo ucwords((string)$sub)?></a>
                </li>
                <li class="active"><?php echo ucwords((string)$page_title)?></li>
              <?php }?>
              </ol>
            </div>
            <!-- .col-* -->
            <div class="col-md-6 text-md-right">
              <span class="dashboard-daterangepicker">
                <i class="fa fa-calendar"></i>
                <span  style="cursor: text;">
                <?php echo date('l d, M-Y')?></span>
                <!-- <i class="caret"></i> -->
              </span>
            </div>
            <!-- .col-* -->
          </div>
          <!-- .row -->
        </div>
</section>
<?php } ?>
        <!-- .container -->
      </section>