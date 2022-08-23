<?php session_start();  
include "database.php";

//include "login.php";
//
//
//if(empty($_SESSION['login']) && empty($_SESSION['uid'])){
//    header("Location:../../logout.php");
//}
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="row">
                 <table class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;"> SI No. </th>
                                                <th style="text-align: center;"> Full Name </th>
                                                <th style="text-align: center;"> Shop name </th>
                                                <th style="text-align: center;"> Location </th>
                                                <th style="text-align: center;"> User ID</th>
                                                <th style="text-align: center;"> User Role</th>
                                                <th style="text-align: center;"> Kiosk ID.</th>
                                                <th style="text-align: center;"> Created On</th>
                                                <th style="text-align: center;">Edit</th>
                                                <th style="text-align: center;">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                    
                    $res = mysqli_query($db,"select * from users");
                    while ($row=mysqli_fetch_array($res)){
                        ?>

                                                <tr>
                                                    <td style="text-align: center;"><?php echo $row["Id"];?></td>
                                                    <td style="text-align: center;"><?php echo $row["FullName"];?></td>                    
                                                    <td style="text-align: center;"><?php echo $row["ShopName"];?></td>
                                                    <td style="text-align: center;"><?php echo $row["Phone"];?></td>
                                                    <td style="text-align: center;"><?php echo $row["CreatedUserId"];?></td>
                                                    <td style="text-align: center;"><?php echo $row["FkRoleID"];?></td>
                                                    <td style="text-align: center;"><?php echo $row["kioskId"];?></td>
                                                    <td style="text-align: center;"><?php echo $row["CreatedDate"];?></td>
                                                    <td style="text-align: center;"><button class='btn-edit' data-toggle='modal' data-target='#edit'><i class="material-icons">Edit</i> </button></td>

                                                    <!-- <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button></td> -->
                                                    <!-- <td><input type="button" name="Edit" value="Edit" id="<?php echo $row["Id"]; ?>" class="btn btn-square btn-sm btn-outline-info btn-icon-text" /> -->
                                                    <td><input type="button" name="Delete" value="Delete" id="<?php echo $row["Id"]; ?>" class="btn btn-square btn-sm btn-outline-danger btn-icon-text" />
<!--                                                        <i class="mdi mdi-pencil-box-outline"></i>-->
                                                    </td> 
                                                    
<!--                                                    <td><button class="btn btn-rounded btn-sm btn-outline-info btn-icon-text" href=""> <i class="mdi mdi-pencil-box-outline"></i> Edit</button> </td>-->
                                                    <!-- <td><button class="btn btn-rounded btn-sm btn-outline-danger btn-icon-text" href=""> <i class="mdi mdi-delete-forever"></i> Delete</button></td> -->
                                                </tr>
                                            <?php 
                                             }

                                             ?>
                                        </tbody>
                                    </table>

<div class="modal fade" id="myModal1">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
 </div>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                ...
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>

$('.btn-edit').click(function() {
// debugger;
// var $row = $(this).closest("tr"),

// $tdata = $row.find("td");

// console.log($(this).text());

// $.each($tdata, function(index, value) {
//     // alert ('Entró');
//     console.log($(this).text()); 
//     $( "input:eq(" + index + ")").val($(this).text());
// });
$('#myModal').modal('show')
}); 

        </script>