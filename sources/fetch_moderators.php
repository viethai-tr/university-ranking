<?php

$connect = new PDO("mysql:host=localhost; dbname=web", "root", "123456");

/*function get_total_row($connect)
{
  $query = "
  SELECT * FROM tbl_webslesson_post
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  return $statement->rowCount();
}

$total_record = get_total_row($connect);*/

$limit = '10';
$page = 1;
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM account WHERE permission = 2
";

if($_POST['query'] != '')
{
  $query .= '
   AND name LIKE "%'.str_replace(' ', '%', $_POST['query']).'%" 
  ';
}

$query .= 'ORDER BY accid ASC ';

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$page_array = [];

$output = '';
if($total_data > 0)
{
  $output = '
    <table class="table table-striped table-bordered">
      <tr>
          <th class="text-center"> ID </th>
          <th class="text-center"> Tên </th>
          <th class="text-center"> Tên đăng nhập </th>
          <th class="text-center"> Email </th>
          <th class="text-center"> Số điện thoại </th>
          <th class="text-center"> Sửa </th>
          <th class="text-center"> Xóa </th>
      </tr>
    ';
    ?>
    <script type="text/javascript">;
      function confirmDelete(uid) {
        if (confirm("Chắc chắn muốn xoá nhân viên này?")) {
          var url = "delete-moderator.php?id=" + uid;
          location.href= url;
        }
      }
    </script>
<?php
  foreach($result as $row)
  {
    $output .= '
      <tr>
        <td>'.$row["accid"].'</td>
        <td>'.$row["name"].'</td>
        <td>'.$row["username"].'</td>
        <td>'.$row["email"].'</td>
        <td>'.$row["phone"].'</td>
        <td align="center"><a href="edit-moderator.php?id='.$row['accid'].'"><button class="btn btn-warning">Sửa</button></a></td>
        <td align="center"><button onclick="confirmDelete('.$row['accid'].')" class="btn btn-danger">Xóa</button></a></td>
      </tr>
    ';
  }
}
else
{
  $output .= '
    Không tìm thấy
  ';
}

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($total_data/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">‹</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">‹</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">›</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">›</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>