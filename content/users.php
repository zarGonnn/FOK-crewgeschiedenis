<div id="content" class="content">
	<!-- begin page-header -->
	<h1 class="page-header">Users</h1>
	<!-- end page-header -->
			
	<!-- begin row -->
	<div class="row">
		<!-- begin col-12 -->
		<div class="col-md-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">				
				<?php $nr = 0;?>
				<div class="panel-body">
					<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>User</th>
								<th>Registratiedatum</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						try {
							require('config.php'); 
							
							$con= new PDO( "mysql:host=" . $settings["dbserver"] . ";dbname=" . $settings["dbname"], $settings["dbuser"], $settings["dbpass"]);  
							$sql=	"SELECT
										  ID
										, UserName
										, UI
										, RegistrationDate
									FROM User
									JOIN (SELECT DISTINCT User FROM Data) Data
										ON User.UserName = Data.User
									UNION ALL
									SELECT '41894', 'du_ke', 'du_ke.gif', '2012-04-12' 
									ORDER BY UserName
									"; 
								
							$stmt=$con->prepare($sql);
							$stmt->execute(); 
					
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
								echo '<tr>';
								echo '<td>' . ++$t . '</td>';
								//echo '<td><img class="img-rounded" style="margin-right: 20px;" src="http://fokcrew.nl/ui/' . $row['UI'] . '" height="50" width="50"><a href="/user/'. $row['ID'] .'">' . $row['UserName'] . '</a></td>'; // NOT MOBILE FRIENDLY
								echo '<td><a href="/user/'. $row['ID'] .'">' . $row['UserName'] . '</a></td>';
								echo '<td>' . $row['RegistrationDate'] . '</td>';
								echo '</tr>';
							}
						} 
						
						// Error handeling
						catch(PDOException $e) {
							echo '<pre>';
							echo 'Regel: '.$e->getLine(). '<br />';
							echo 'Bestand: '.$e->getFile(). '<br />'; 
							echo 'Foutmelding: '.$e->getMessage();
							echo '</pre>'; 
						}				
						?>
						</tbody>
					</table>
				</div>
			</div>
		<!-- end panel -->
		</div>
	<!-- end col-10 -->
	</div>
<!-- end row -->
</div>