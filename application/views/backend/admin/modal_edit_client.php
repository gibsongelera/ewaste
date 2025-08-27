<script src="<?php echo base_url(); ?>components/customs/register.js"></script>
<?php foreach($login_id->result() as $row):
$login_id=$row->login_id;
$name=$row->name;
$email=$row->email;
?>
<?php endforeach;?>
<?php $attributes = array("name" => "form", 'id' => 'updateClientForm');
echo form_open("admin/clients_crud/update/".$login_id, $attributes);?>

	<div id="clientUpdate"></div>
<div class="form-group">
	<label><b>Full Names:</b></label>
	<?php 
		$data=array(
		'name'=> 'u_name',
		'type'=>'text',
		'placeholder'=>'full names',
		'class'=>'form-control',
		'id'=>'u_name',
		'value'=>$name,
		);
		echo form_input($data);
	?>
</div>
	<div class="form-group">
		<label><b>Email:</b></label>
		<?php 
			$data=array(
			'name'=> 'u_email',
			'type'=>'text',
			'placeholder'=>'Email',
			'class'=>'form-control',
			'id'=>'u_email',
			'value'=>$email,
			);
			echo form_input($data);
		?>
	</div>
   <div class="form-group">
	   <label><b>Role:</b></label>
	   <?php 
		   $role = isset($row->role) ? $row->role : 'client';
		   $options = array(
			   'client' => 'Client',
			   'collector' => 'Garbage Collector'
		   );
		   // Custom select with data-current-role for JS
		   echo '<select name="u_role" class="form-control" id="u_role" data-current-role="' . $role . '">';
		   foreach($options as $val => $label) {
			   $selected = ($role == $val) ? 'selected' : '';
			   echo '<option value="' . $val . '" ' . $selected . '>' . $label . '</option>';
		   }
		   echo '</select>';
	   ?>
   </div>

   <!-- Collector Section -->
   <div class="form-group" id="collector-section" style="display: none;">
	   <label><b>Collector Details</b></label>
	   <div class="alert alert-info">You are editing a Garbage Collector. You can add collector-specific fields here.</div>
	   <!-- Example collector-specific field -->
	   <input type="text" class="form-control" name="collector_note" placeholder="Collector note (optional)">
   </div>
<script>
// Show collector section if role is collector
function toggleCollectorSection() {
	var roleSelect = document.getElementById('u_role');
	var collectorSection = document.getElementById('collector-section');
	if (roleSelect.value === 'collector') {
		collectorSection.style.display = '';
	} else {
		collectorSection.style.display = 'none';
	}
}
if (document.getElementById('u_role')) {
	document.getElementById('u_role').addEventListener('change', toggleCollectorSection);
	toggleCollectorSection();
}
</script>
<!-- Role Change Confirmation Modal -->
<div class="modal fade" id="roleChangeModal" tabindex="-1" role="dialog" aria-labelledby="roleChangeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="roleChangeModalLabel">Confirm Role Change</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body" id="roleChangeModalBody">
		<!-- Message will be set by JS -->
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		<button type="button" class="btn btn-primary" id="confirmRoleChangeBtn">Confirm</button>
	  </div>
	</div>
  </div>
</div>
<script>
var pendingSubmit = false;
document.getElementById('updateClientForm').addEventListener('submit', function(e) {
	if (pendingSubmit) {
		pendingSubmit = false;
		return true;
	}
	var roleSelect = document.getElementById('u_role');
	var oldRole = roleSelect.getAttribute('data-current-role');
	var newRole = roleSelect.value;
	if (oldRole && oldRole !== newRole) {
		e.preventDefault();
		var msg = 'Are you sure you want to change the user\'s role from <b>' + oldRole + '</b> to <b>' + newRole + '</b>?';
		document.getElementById('roleChangeModalBody').innerHTML = msg;
		$('#roleChangeModal').modal('show');
		document.getElementById('confirmRoleChangeBtn').onclick = function() {
			pendingSubmit = true;
			$('#roleChangeModal').modal('hide');
			document.getElementById('updateClientForm').submit();
		};
	}
});
</script>