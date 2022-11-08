<?php

                      require_once "connection.php";
                      require_once "students.php";

                      $query  = "SELECT * FROM users";
                      $result = mysqli_query($link,$query);

                      if(mysqli_num_rows($result)>0){
                        foreach ($result as $students) {
                          ?>
                            <tr>
                              <th><?php echo $students['id']; ?></th>
                              <th><?php echo $students['nama']; ?></th>
                              <th><?php echo $students['alamat']; ?></th>
                              <th><?php echo $students['email']; ?></th>

                              <th>
                                <a href="" class="btn btn-info">View</a>
                                <button type="button" value="<?php echo $students['id'];?>" class="editStudentsbtn btn btn-success">Edit</button>
                                <a href="" class="btn btn-danger">Delete</a>
                              </th>
                            </tr>
                          <?php
                        }
                      }
  ?>


  