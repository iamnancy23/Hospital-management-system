<?php
include_once('../define/define.php');
include_once(login .'connect.php');

if (isset($_POST['subc_id']) && $_POST['subc_id'] != '') {
    $statusID = $_POST['subc_id'];
    $sql = "select * from tests Where c_id='$statusID'  order by c_name ASC";
    $rs = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($rs);

    if ($numRows == 0) {
        echo 'No Child Categories';
    } else {
?>





        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header"><?php
                                                    $sq = "select * from tests Where Id='$statusID' ";
                                                    $r = mysqli_query($conn, $sq);
                                                    $row = mysqli_fetch_assoc($r);

                                                    ?>
                            <h3 class="card-title" style="align-content: center;"><b><?php echo $row['c_name']; ?></b></h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th style="text-align: center;">Test Categories</th>

                                        <th style="text-align: center;">Patient Value</th>

                                        <th style="text-align: center;">Normal Value</th>




                                    </tr>
                                </thead>
                                <?php
                                while ($state = mysqli_fetch_assoc($rs)) {
                                ?>
                                    <tr>



                                        <td style="width:300px;text-align: center;"><?php echo $state['c_name']; ?></td>
                                        <td><input style="width:1000px;height:50px" name="Patval" type="text" id="<?php echo $state['Id']; ?>" placeholder="Enter Patient Value" value="<?php echo isset($_REQUEST['Patval']) ? $_REQUEST['Patval'] : ''; ?>" onchange="savedata(<?php echo $state['Id']; ?>)" /><br>
                                            <span style=" color: red;" class="error" id="nspan"></span>
                                        </td>
                                        <td style="width:300px;text-align: center;"><?php echo $state['normalval']; ?></td>


                                    </tr>
                                <?php
                                }
                                ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">Test Categories</th>

                                        <th style="text-align: center;">Patient Value</th>

                                        <th style="text-align: center;">Normal Value</th>


                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        </form>
                            </div>
        <!-- /.container-fluid -->
<?php }
}
?>
<script>
    function randomIntFromInterval(min, max) { // min and max included 
        return Math.floor(Math.random() * (max - min + 1) + min)
    }

    const rndInt = randomIntFromInterval(1, 999)



    function savedata(id) {
   




        var name = $("#" + id).val();



        $.ajax({
            url: 'insert.php',
            method: 'post',
            data: {
                id: id,
                patval: name,
               


            },

            success: function() {



            },

        });



    }
</script>