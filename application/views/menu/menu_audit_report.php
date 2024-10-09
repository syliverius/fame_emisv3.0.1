<div class="card">
	<div class="card-body">
	<center><h3 class="card-title">Menu Book Audit Trial for <b><?= $ward; ?></b> on <b><?= $date; ?></b></h3></center>
			<table class="table table-bordered border-primary text-center">
				<thead>
					<tr>
						<th>#</th>
						<th>Timestamp</th>
						<th>User Names</th>
						<th>Action</th>
						<th>Contents</th>
					</tr>
				</thead>
				<tbody>
					<?php  
					    $count = 1;
						if($audit_info->num_rows()>0){
							$info = $audit_info->result();
							foreach($info as $record){ ?>
								<tr>
									<td><?= $count; ?></td>
									<td><?= $record->time_stamp; ?></td>
									<td><?= $record->user_name; ?></td>
									<td><?= $record->action; ?></td>
									<td><?= $record->content; ?></td>
								</tr>
							<?php $count++; }
						}else{
							echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-check-circle me-1"></i> Sorry, the requested info is not available  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} ?>
					
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>Timestamp</th>
						<th>User Names</th>
						<th>Action</th>
						<th>Contents</th>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
</div>