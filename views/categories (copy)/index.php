<?php
global $mediaFiles;
array_push($mediaFiles['css'], RootREL . 'media/fontawesome/css/all.css');
array_push($mediaFiles['css'], RootREL . 'media/jstree/css/style.min.css');
?>

<?php include_once 'views/layout/' . $this->layout . 'header1.php';?>
<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-12 col-sm-9">
	<div class="table-responsive">
	  <table class="table table-bordered">
        <tbody>
        <?php if ($this->records) {?>
			<?php
$cate = [];
    $product = [];
    while ($row = mysqli_fetch_array($this->records, MYSQLI_ASSOC)) {
        array_push($product, $row);
    }
    // echo '<pre>';
    // var_dump($product);
    // echo '</pre>';
    foreach ($product as $row) {
        $arr = explode(".", $row['path']);
        if (!isset($_GET['cate'])) {
            if (count($arr) == 1) {?>
              <tr>
                <td width="30%" style="vertical-align: middle;">
                <div class="mb-2"> 
                  <h3 class="text-primary"> <?php echo $row['name']; ?> </h3>
                <div class="d-flex flex-row-reverse bd-highlight"> <a class="btn btn-outline-info table-link" role="button" href="<?php echo html_helpers::url(
                ['ctl' => 'categories',
                    'act' => 'view',
                    'params' => array(
                        'id' => $row['categorie_id'],
                    ),
                ]); ?>">
												<i class="fa fa-eye" aria-hidden="true"></i>
											  </a>
											  <a class="btn btn-outline-warning" role="button" href="<?php echo html_helpers::url(
                array('ctl' => 'categories',
                    'act' => 'edit',
                    'params' => array(
                        'id' => $row['categorie_id'],
                    ))); ?>">
												<i class="fas fa-edit"></i>
											  </a>
											  <a class="btn btn-outline-danger table-link danger delete" role="button" href="<?php echo html_helpers::url(
                array('ctl' => 'categories',
                    'act' => 'del',
                    'params' => array(
                        'id' => $row['categorie_id'],
                    ))); ?>" >
												<i class="fas fa-trash"></i>
											  </a></div></div>
                </td>
                <td>
                  <?php foreach ($product as $row1) {
                $arr1 = explode(".", $row1['path']);
                if (str_contains($row1['path'], $row['path']) && count($arr1) == 2) {?>
             <div class="border border-5 p-2 mb-2 border-info rounded"> 
               <h5 class="text-secondary"> <?php echo $row1['name']; ?> </h5>
                <div class="d-flex flex-row-reverse bd-highlight mb-2"> <a class="btn btn-outline-info table-link" role="button" href="<?php echo html_helpers::url(
                    ['ctl' => 'categories',
                        'act' => 'view',
                        'params' => array(
                            'id' => $row1['categorie_id'],
                        ),
                    ]); ?>">
												<i class="fa fa-eye" aria-hidden="true"></i>
											  </a>
											  <a class="btn btn-outline-warning" role="button" href="<?php echo html_helpers::url(
                    array('ctl' => 'categories',
                        'act' => 'edit',
                        'params' => array(
                            'id' => $row1['categorie_id'],
                        ))); ?>">
												<i class="fas fa-edit"></i>
											  </a>
											  <a class="btn btn-outline-danger table-link danger delete" role="button" href="<?php echo html_helpers::url(
                    array('ctl' => 'categories',
                        'act' => 'del',
                        'params' => array(
                            'id' => $row1['categorie_id'],
                        ))); ?>" >
												<i class="fas fa-trash"></i>
											  </a></div>
                        <?php foreach ($product as $row2) {
                    $arr1 = explode(".", $row2['path']);
                    if (str_contains($row2['path'], $row1['path']) && count($arr1) == 3) {?>
             <div class="border border-success p-2 mb-2 rounded-3"> <?php echo $row2['name']; ?>
                <div class="d-flex flex-row-reverse bd-highlight"> <a class="btn btn-outline-info table-link" role="button" href="<?php echo html_helpers::url(
                        ['ctl' => 'categories',
                            'act' => 'view',
                            'params' => array(
                                'id' => $row2['categorie_id'],
                            ),
                        ]); ?>">
												<i class="fa fa-eye" aria-hidden="true"></i>
											  </a>
											  <a class="btn btn-outline-warning" role="button" href="<?php echo html_helpers::url(
                        array('ctl' => 'categories',
                            'act' => 'edit',
                            'params' => array(
                                'id' => $row2['categorie_id'],
                            ))); ?>">
												<i class="fas fa-edit"></i>
											  </a>
											  <a class="btn btn-outline-danger table-link danger delete" role="button" href="<?php echo html_helpers::url(
                        array('ctl' => 'categories',
                            'act' => 'del',
                            'params' => array(
                                'id' => $row2['categorie_id'],
                            ))); ?>" >
												<i class="fas fa-trash"></i>
											  </a></div>

                      </div>
           <?php }
                }
                    ?>
                      </div>
           <?php }
            }
                ?>
                </td>
              </tr>
        <?php }
        }
        if (count($arr) == 1) {
            array_push($cate, $row);
            continue;
        }?>
         <?php if (isset($_GET['cate']) && str_contains($row['path'], $_GET['cate']) && count($arr) == 2) {?>
<tr> <div class="">
            <td width="12%">
				 <h3 class="text-secondary">  <?php echo $row['name']; ?> </h3>
		                  <div class="d-flex flex-row-reverse bd-highlight mb-2"> <a class="btn btn-outline-info table-link" role="button" href="<?php echo html_helpers::url(
            ['ctl' => 'categories',
                'act' => 'view',
                'params' => array(
                    'id' => $row['categorie_id'],
                ),
            ]); ?>">
												<i class="fa fa-eye" aria-hidden="true"></i>
											  </a>
											  <a class="btn btn-outline-warning" role="button" href="<?php echo html_helpers::url(
            array('ctl' => 'categories',
                'act' => 'edit',
                'params' => array(
                    'id' => $row['categorie_id'],
                ))); ?>">
												<i class="fas fa-edit"></i>
											  </a>
											  <a class="btn btn-outline-danger table-link danger delete" role="button" href="<?php echo html_helpers::url(
            array('ctl' => 'categories',
                'act' => 'del',
                'params' => array(
                    'id' => $row['categorie_id'],
                ))); ?>" >
												<i class="fas fa-trash"></i>
											  </a></div> <div>
                        <?php foreach ($product as $row1) {
            if (str_contains($row1['path'], $row['path']) && $row1['path'] != $row['path']) {?>
             <div class="border border-success p-2 mb-2 rounded-3"> <?php
echo $row1['name']; ?>
                <div class="d-flex flex-row-reverse bd-highlight"> <a class="btn btn-outline-info table-link" role="button" href="<?php echo html_helpers::url(
                ['ctl' => 'categories',
                    'act' => 'view',
                    'params' => array(
                        'id' => $row1['categorie_id'],
                    ),
                ]); ?>">
												<i class="fa fa-eye" aria-hidden="true"></i>
											  </a>
											  <a class="btn btn-outline-warning" role="button" href="<?php echo html_helpers::url(
                array('ctl' => 'categories',
                    'act' => 'edit',
                    'params' => array(
                        'id' => $row1['categorie_id'],
                    ))); ?>">
												<i class="fas fa-edit"></i>
											  </a>
											  <a class="btn btn-outline-danger table-link danger delete" role="button" href="<?php echo html_helpers::url(
                array('ctl' => 'categories',
                    'act' => 'del',
                    'params' => array(
                        'id' => $row1['categorie_id'],
                    ))); ?>" >
												<i class="fas fa-trash"></i>
											  </a></div></div>
           <?php }
        }?> </div>
          </td>
           </div>
						</tr>
					<?php }
    }
    ?>
		<?php } else {?>
			  <tr>
				<td colspan="7" scope="row">There are no record!</td>
			  </tr>
		<?php }?>
        </tbody>
      </table>
	</div>
  </div>
  <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
  
  <?php array_push($mediaFiles['js'], RootREL . "media/js/jquery.min.js");?>
	<?php include_once 'views/widgets/sidebar-tree.php';?>
  </div>
</div>

<?php array_push($mediaFiles['js'], RootREL . "media/js/categories.js");?>
<?php include_once 'views/layout/' . $this->layout . 'footer1.php';?>
