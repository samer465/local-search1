<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary " href="./index.php?page=new_persons_companies"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Image</th>
						<th>Service Category</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT pc.*,s.service FROM persons_companies pc inner join services s on s.id = pc.service_id order by unix_timestamp(pc.name) asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td class="text-center">
							<div class="d-flex w-100 justify-content-center img-thubmnail rounded-circle">
								<img src="../assets/uploads/<?php echo $row['img_path'] ?>" style="object-fit: cover;max-width: 75px;height:75px" class="rounded-circle" alt="">
							</div>
						</td>
						<td><b><?php echo ucwords($row['service']) ?></b></td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
		                    	<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-info btn-flat view_persons_companies">
		                          <i class="fas fa-eye"></i>
		                        </a>
		                        <a href="index.php?page=edit_persons_companies&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat ">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_persons_companies" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table td{
		vertical-align: middle !important;
	}
</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.view_persons_companies').click(function(){
			uni_modal("Service Provider's Details","view_persons_companies.php?id="+$(this).attr('data-id'),"large")
		})
	$('.delete_persons_companies').click(function(){
	_conf("Are you sure to delete this Service Provider?","delete_persons_companies",[$(this).attr('data-id')])
	})
	})
	function delete_persons_companies($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_persons_companies',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>