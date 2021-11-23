        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                <div class="x_title">
        	<form method="post" action="?pg=8" name="frmReg" onsubmit="return markStudents()">
              <table >
                  <tr>

                  	<td>Class: </td>
                      <td> 
                      <select name="class" id="class" style="width:130px" class="form-control"  onchange="return mySearch()">
                        <option value="">--Select Class</option>
                        <?php
                            echo $aLoader->getClassTeacher($_SESSION["teacherlog"], $classv);
                        ?>
                      </select>
                      </td>
                      <td >
                     	 <select name="cgroup" class="form-control"  style="width:130px">
                          <option value="">--Select Group</option>
                          <?php
                              echo $aLoader->getClassTeacherGroup($_SESSION["teacherlog"], $cgroup);
                          ?>
                        </select>
                     </td>
                      <td >
                      	<select name="term" class="form-control" style="width:130px">
                        <option value="">--Select Term</option>
                        <?php
                              $select_content2=("select * from terms order by term asc");
                              $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                              $content2 = mysqli_fetch_assoc($content_result2);
                              $num_chk2 = mysqli_num_rows ($content_result2);
                              $k = 0
                          ?>
                        <?php do { 	?>
                        <option value="<?php echo  $content2['tid']?>" <?php if($content2['tid'] == $term){?> selected="selected" <?php } ?>><?php echo  $content2['term']?></option>
                        <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                      </select>
                      </td>
                      <td >
                      	<select name="year" class="form-control" style="width:130px">
                         <?php
                              $select_content1=("select * from schsession order by status desc");
                              $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
                              $content1 = mysqli_fetch_assoc($content_result1);
                          ?>
                        <?php do { 	?>
                        <option value="<?php echo  $content1['sid']?>" <?php if($content1['sid'] == $yeardb){?> selected="selected" <?php } ?>><?php echo  $content1['sesion']?></option>
                        <?php } while ($content1 = mysqli_fetch_assoc($content_result1)); ?>
                      </select>
                      </td>
                      <td > <input  type="button" class="btn btn-primary" value="Load Students" onclick="return laodstudents();" /></td>
                  </tr>
              </table>
           <div class="clearfix"></div>
            </div>
                             