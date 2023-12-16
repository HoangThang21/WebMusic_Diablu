@include('layouts.top')
		@if (Auth::guard('web')->check())
				<!-- Nút mở hộp modal chứa form thêm mới -->
				<div><a class="btn btn-primary" href="{{ route('themnguoidung') }}"><span class="glyphicon glyphicon-plus"></span> Thêm người dùng</a></div>
		  
				<br>
			  
				<!-- Danh sách người dùng -->
				<table class="table table-hover">
					  <tr>
					  <th>Email</th>
					  <th>Hình</th>
					  <th>Họ tên</th>
					  <th>Loại quyền</th>
					 
					  <th>Trạng thái</th>
					  <th>Chức năng</th>
						<th></th>
					</tr>
					<?php foreach ($user as $nd): ?>
					  <tr><td>{{  $nd["email"] }}</td>
						  <td><img src="../../images/{{ $nd['image'] }}" width="80" class="img-thumbnail"></td>
						  <td>{{ $nd['name'] }}</td>
						  <td><?php if($nd["quyen"]==1) echo "Quản trị";elseif($nd["quyen"]==2) echo "Nhân viên"; else echo "Người dùng" ; ?></td>
						 
						  <td class="<?php if($nd["quyen"]!=1) {if($nd["trangthai"]==1) echo "text-success"; else echo "text-danger" ; }?>"><?php if($nd["quyen"]!=1) {if($nd["trangthai"]==1) echo "Đang hoạt động"; else echo "Khóa" ; }?></td>
						
						<td>

						<?php 
						if($nd["quyen"]!=1) {
						  if($nd["trangthai"]==1){ ?>
							<a  href="/Administrator/{{ $nd["id"] }}&0&users">Khóa</a></td>
							<td><a href="/Administrator/{{ $nd["id"] }}&userde">Xóa</a></td></tr>
						  <?php 
						  }
						  else { ?>
							<a  href="/Administrator/{{ $nd["id"] }}&1&users">Bỏ khóa</a></td>
							<td><a href="/Administrator/{{ $nd["id"] }}&userde">Xóa</a></td></tr>
						<?php 
						  }
						}
						
					
					endforeach; ?>
				</table>
			  
	
	   
		@endif

@include('layouts.bottom')