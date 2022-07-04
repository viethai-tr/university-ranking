<table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center"> Hạng </th>
                        <th class="text-center"> Tên </th>
                        <th class="text-center"> Quốc Gia </th>
                        <th class="text-center"> Giảng Dạy </th>
                        <th class="text-center"> International </th>
                        <th class="text-center">  Research </th>
                        <th class="text-center">  Income </th>
                        <th class="text-center">  Total Score </th>
                        <th class="text-center"> Sửa </th>
                        <th class="text-center"> Xóa </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                      if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                      } else {
                        $pageno = 1;
                      }
                      $no_of_records_per_page = 10;
                      $offset = ($pageno-1) * $no_of_records_per_page;

                      $total_page_sql = "SELECT COUNT(*) FROM data" ;
                      $result = mysqli_query($conn, $total_page_sql);
                      $total_rows = mysqli_fetch_array($result)[0];
                      $total_pages = ceil($total_rows / $no_of_records_per_page);
                      $sql = "SELECT world_rank, university_name, country, teaching, international, research, citations, income, total_score, num_students, student_staff_ratio, international_students, female_male_ratio, university_id FROM data LIMIT $offset, $no_of_records_per_page";
                      $res_data = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_assoc($res_data)) {
                        echo "<tr>";
                        echo "<td>";
                        echo $row["world_rank"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["university_name"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["country"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["teaching"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["international"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["research"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["income"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["total_score"];
                        echo "</td>";
                        echo "<td>";
                        echo "<a href=\"edit-university.php?id=";
                        echo $row['university_id'];
                        echo "\"><button class=\"btn btn-warning\">Sửa</button></a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href=\"delete-university.php?id=";
                        echo $row['university_id'];
                        echo "\"><button class=\"btn btn-danger\">Xóa</button></a>";
                        echo "</td>";
                        echo "</tr>";
                      }
                  ?>
                    <!-- <td class="text-center" width="20px"><a href="#"><button class="btn btn-warning">Edit</button></a></td>
                    <td class="text-center" width="20px"><a href="#"><button class="btn btn-danger">Delete</button></a></td> -->
                    </tr>
                  </tbody>
                </table>

                <div class="mt-3">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" rel="prev" aria-label="&laquo; Previous">&lsaquo;</a>
                    </li>
                      <?php for ($i = 1; $i <= $total_pages; $i++) {
                        $link = "?pageno=".$i;
                          if ($i == $pageno) echo "<li class=\"page-item active\" aria-current=\"page\"><span class=\"page-link\">$i</span></li>";
                          else {
                            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"$link\">$i</a></li>";
                          }
                        }
                      ?>
                    <li class="page-item">
                       <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
                    </li>
                  </ul>

                </div>