
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  
                  <th>State Name</th>
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  
                  <th>State Name</th>
                  
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                
               
               
               $q = intval($_GET['q']);

               $dbcon = mysqli_connect('localhost','root','','db_pointofsale');
               

if (!$dbcon) {
  die('Could not connect: ' . mysqli_error($dbcon));
}
  
  mysqli_select_db($dbcon,"ajax_demo");

  $sqlcon = "SELECT state_id,StateName FROM state_info,country_info WHERE state_info.country_id = country_info.country_id AND state_info.country_id = $q and state_id > 0" ;

        $query = mysqli_query($dbcon,$sqlcon);

          while($row = mysqli_fetch_array($query)){
         $id = $row['state_id'];
         
        
        ?>
            <tr>
                  
                  <td><?php echo $row['StateName']; ?></td>
                  
                  <td>
                    <a data-placement="left" id="" href="edit_country_info.php?id=<?php echo $row['country_id']; ?>" title="Click to Edit" class="btn btn-success"><i class="fa fa-pencil"></i> </a>
      <a href="#" id="<?php echo $row['country_id']; ?>" class="delbutton" title="Click to Delete Info"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                  </td>
                </tr>
                <?php
        }
      ?>
      </tbody>
    </table>
      
     
    