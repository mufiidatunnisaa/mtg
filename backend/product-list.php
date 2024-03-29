<section class="content-main">
                <div class="content-header">
                    <div>
                        <h2 class="content-title card-title">Products List</h2>
                        <p>Create, edit, or delete porduct.</p>
                    </div>
                    <div>
<?php
                    $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM product order by id DESC LIMIT 1") or die ("Query gagal dengan error: ".mysqli_error($GLOBALS["___mysqli_ston"]));
                    $jumlah_barang = mysqli_num_rows($sql);
                    if ($jumlah_barang>0){
                    while($d=mysqli_fetch_array($sql)){
                        
                        ?>
                        <a href="#" class="btn btn-light rounded font-md">Export</a>
                        <a href="#" class="btn btn-light rounded font-md">Import</a>
                        <a href="create-product-page.php?id=<?php echo $d['id'];?>" class="btn btn-primary btn-sm rounded">Create new</a>

                        <?php }}else{?>


                            <a href="#" class="btn btn-light rounded font-md">Export</a>
                        <a href="#" class="btn btn-light rounded font-md">Import</a>
                        <a href="create-product-page.php?id=0" class="btn btn-primary btn-sm rounded">Create new</a>



                                <?php } ?>
                    </div>
                </div>
                <div class="card mb-4">
                    <header class="card-header">
                        <div class="row align-items-center">
                            <div class="col col-check flex-grow-0">
                                <div class="form-check ms-2">
                                    <input class="form-check-input" type="checkbox" value="" />
                                </div>
                            </div>
                            <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                            <form action="product-page.php" method="get">
                            <div class="input-group">
                            
                            <input type="text" class="form-control" name="cari" type="search" placeholder="Search term" />
                            <button class="btn btn-light bg" type="submit" value="search"><i class="material-icons md-search"></i></button>
                            </div></form>
                            </div>
                            <div class="col-md-2 col-6">
                                <input type="date" value="02.05.2021" class="form-control" />
                            </div>
                            <div class="col-md-2 col-6">
                                <select class="form-select">
                                    <option selected>Status</option>
                                    <option>Active</option>
                                    <option>Disabled</option>
                                    <option>Show all</option>
                                </select>
                            </div>
                        </div>
                    </header>
                    <!-- card-header end// -->
                    <div class="card-body">
                    <?php 
                    	if(isset($_GET['cari'])){
                            $cari = $_GET['cari'];	
                    $halaman = 10;
                    $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                    $a=$mulai+1;
                    $b=1+$a;			
                    $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM product where p_name like '%".$cari."%'");
                    $total = mysqli_num_rows($result);
                    $pages = ceil($total/$halaman); 
                    $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM product where p_name like '%".$cari."%' LIMIT $mulai, $halaman") or die ("Query gagal dengan error: ".mysqli_error($GLOBALS["___mysqli_ston"]));
                        }else{

                            $halaman = 10;
                            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                            $a=$mulai+1;
                            $b=1+$a;			
                            $result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM product");
                            $total = mysqli_num_rows($result);
                            $pages = ceil($total/$halaman); 
                            $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM product order by id DESC LIMIT $mulai, $halaman") or die ("Query gagal dengan error: ".mysqli_error($GLOBALS["___mysqli_ston"]));
                             

                        }

                    while($d=mysqli_fetch_array($sql)){
                    ?>
                        <!-- itemlist  .// -->
                        <article class="itemlist">
                            <div class="row align-items-center">
                                <div class="col col-check flex-grow-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" />
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-4 col-8 flex-grow-1 col-name">
                                    <a class="itemside" href="edit-product-page.php?id=<?php echo $d['id']; $id=$d['id']; ?>">

                                 

                                        <div class="left">
                                        <?php $sql3 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM p_image where p_id='$id' and img_name LIKE '%.png%' or p_id='$id' and img_name LIKE '%.jpg%' or p_id='$id' and img_name LIKE '%.jpeg%' limit 1"); while($d3=mysqli_fetch_array($sql3)){?>
                                         <img style="max-width:150px;" src="../frontend/assets/imgs/shop/<?php echo $d3['img_name']; ?>" alt="" /> <?php } ?>
                                        </div>



                                        <div class="info">
                                            <h6 class="mb-0"><?php echo $d['p_name'];?></h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-price">Rp <span><?php echo $d['price_in_ppn'];?>,-</span></div>
                                <div class="col-lg-2 col-sm-2 col-4 col-status">
                                    <span class="badge rounded-pill <?php echo $d['inven'];?>"><?php $gg=$d['inven']; if($gg=='alert-success'){echo 'Instock';} else if($gg=='alert-danger'){echo 'Out of Stock';} else{echo 'Draft';}?></span>
                                </div>
                                <div class="col-lg-1 col-sm-2 col-4 col-date">
                                    <span>-<?php echo $d['qty'];?>Pcs</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-action text-end">
                                    <a href="edit-product-page.php?id=<?php echo $d['id'];?>" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                                    <a href="delete-product.php?id=<?php echo $d['id'];?>" class="btn btn-sm font-sm btn-light rounded"> <i class="material-icons md-delete_forever"></i> Delete </a>
                                </div>
                            </div>
                            <!-- row .// -->
                        </article>
                        <!-- itemlist  .// -->

                        <?PHP } ?>

                    </div>
                    <!-- card-body end// -->
                </div>
                <!-- card end// -->
             <?php include "pagination.php";?>


           
  













            </section>
            <!-- content-main end// -->