
<section class="content-main">
                <div class="content-header">
                    <div>
                        <h2 class="content-title card-title">Categories / Brands</h2>
                        <p>Add, edit or delete a category/brand</p>
                    </div>
                    <form action="category-page.php" method="get">
                            <div class="input-group">
                            
                            <input type="text" class="form-control" name="cari" type="search" placeholder="Search term" />
                            <button class="btn btn-light bg" type="submit" value="search"><i class="material-icons md-search"></i></button>
                            </div></form>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <form name="form1" method="post" action="create-category-act.php" enctype="multipart/form-data">
                                    <div class="mb-4">
                                        <label for="product_name" class="form-label">Category Name</label>
                                        <input name="cat_name" type="text" placeholder="Type here" class="form-control" />
                                    </div>
                                    <div class="mb-4">



                                        <label class="form-label">Category Level</label>
                                          <select name="cat_desc" class="form-select" id='kota3' class="form-control" onchange="fetch_select(this.value);">
                                             <option value="">Select Category Level</option>
                                            <option value="Brand">Brand</option>
                                            <option value="1">Category Level 1</option>
                                            <option value="2">Category Level 2</option>
                                            <option value="3">Category Level 3</option>

                                             </select>

                                    </div>
			
                                    <div class='mb-4 search-style-2'>
                                    <label class='control-label' for='KABUPATEN_KOTA'><b>Category Parent</b></label>
 
                                    <select name='cat_parent' class="form-control" id='kota'>
                                        <option value="Parent">Parent</option>
                                    </select>
                                    </div>


















                                    <div class="mb-4">
                                    <label class="form-label">Logo</label>
                                    <input type="file" name="P_ATTACHMENT[]"  class="form-control" />
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary">Create Category</button>
                                    </div>
                                </form>
                            </div>

                            
                            <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
 
                            <script>

                            function myFunction() {
                            var x = document.getElementById("mySelect").value;
                            document.getElementById("demo").innerHTML = "Select Category Parent <br>" + x;
                            }




                            function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'getsubcat.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("kota").innerHTML=response; 
 }
 });

}	


$(document).ready(function () {

$("#kota").select2({

    

});

});
$(document).ready(function () {

$("#kota3").select2({

    

});

});

                            </script>


                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" />
                                                    </div>
                                                </th>
                                                <th>Img</th>
                                                <th>Category Name</th>
                                                <th>Category Level</th>
                                                <th>Parent</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        	if(isset($_GET['cari'])){
                                                $cari = $_GET['cari'];	
                                        $halaman = 10;
                                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                                        $a=$mulai+1;
                                        $b=1+$a;			
                                        $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_name like '%".$cari."%'");
                                        $total = mysqli_num_rows($result);
                                        $pages = ceil($total/$halaman); 
                                        $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_name like '%".$cari."%' LIMIT $mulai, $halaman") or die ("Query gagal dengan error: ".mysqli_error($GLOBALS["___mysqli_ston"]));
                                       
                                            }else{
                                            $halaman = 10;
                                            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                                            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                                            $a=$mulai+1;
                                            $b=1+$a;			
                                            $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category");
                                            $total = mysqli_num_rows($result);
                                            $pages = ceil($total/$halaman); 
                                            $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category LIMIT $mulai, $halaman") or die ("Query gagal dengan error: ".mysqli_error($GLOBALS["___mysqli_ston"]));
                                        }    

                                       
                                        while($d=mysqli_fetch_array($sql)){
                                        
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" />
                                                    </div>
                                                </td>
                                                <td><img src='../frontend/assets/imgs/vendor/<?php echo $d['logo'];?>' draggable='false' style="max-width:100px;" /> </td>
                                                <td><b><?php echo $d['cat_name'];?></b></td>
                                                <td><?php echo $d['cat_desc']; ?></td>
                                                <td><?php $gh=$d['cat_parent']; $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_id='$gh'"); while($d45=mysqli_fetch_array($result)){ echo $d45['cat_name']; }?></td>
                                                <td class="text-end">
                                                    <div class="dropdown">
                                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">View detail</a>
                                                            <a class="dropdown-item" href="edit-category-page.php?cat_id=<?php echo $d['cat_id'];?>">Edit info</a>
                                                            <a class="dropdown-item text-danger" href="delete-category-act.php?cat_id=<?php echo $d['cat_id'];?>">Delete</a>
                                                        </div>
                                                    </div>
                                                    <!-- dropdown //end -->
                                                </td>
                                            </tr>
                                        <?php } ?>                                 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- .col// -->
                        </div>
                        <!-- .row // -->
                    </div>
                    <!-- card body .// -->
                </div>
                <!-- card .// -->


                <?php include "pagination.php";?>

            </section>
            <!-- content-main end// -->