<?php
  $this->arrParam['search']           = (isset($this->arrParam['search'])) ? $this->arrParam['search'] : '';

  //Pagination
  $paginationHTML = $this->pagination->showPagination(URL::createLink('admin','song','index'));

  //MESSAGE
  $message = Session::get('message');
  Session::delete('message');
  $strMessage = Helper::cmsMessage($message);
?>
<div class="content"> 
  <div class="m-content">
    <?php include_once 'toolbar/toolbar.php'; ?>

    <div class="main">
    <?php echo $strMessage; ?>
      <form action="#" id="adminForm" name="adminForm" method="POST">
          <div class="filter">
              <input type="text" name="search" id="search" value="<?php $this->arrParam['search']; ?>">
              <button type="submit" name="btnSearch">Search</button>
              <button type="button" name="btnClear">Clear</button>
          </div>
          <div class="filter-group">
          <?php //echo $selectStatus; ?>
          </div>
          <div class="clr"></div>
          
          <table class="table table-condensed">
              <thead>
                  <tr>
                      <th width="3%">
                          <input type="checkbox" id="selectAll" name="selectAll" />
                          <label for="selectAll"></label>
                      </th>
                      <th width="6%"><a href="#">Picture</a></th>
                      <th><a href="#">Tên </a></th>
                      <th width="12%"><a href="#">Account</a></th>
                      <th width="8%"><a href="#">Email</a></th>
                      <th><a href="#">Phone</a></th>
                      <th><a href="#">ID</a></th>
                      <th width="10%"><a href="#">Position</a></th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                    if(!empty($this->users)){
                      $i = 0;
                      foreach($this->users as $user){
                        $row = ($i % 2 == 0) ? 'row-chan' : ' ';
                        $image = '<img width="50" height="50" src="public/images/users/'.$user['hinhanh'].'" alt="">';
                        echo '<tr class="' . $row .'">
                            <td>
                              <input type="checkbox" name="cid[]" id="'.$user['iduser'].'" value="'.$user['iduser'].'" class="chcktbl" />
                              <label for="'.$user['iduser'].'"></label></td>
                            <td>'.$image.'</td>
                            <td>'.$user['name'].'</td>
                            <td>'.$user['username'].'</td>
                            <td>'.$user['email'].'</td>
                            <td>'.$user['phone'].'</td>
                            <td>'.$user['iduser'].'</td>
                            <td>'.$user['loaiuser'].'</td>
                          </tr>';
                          $i++;
                      }
                    }
                  ?>
              </tbody>
          </table>
                  
          <div>
              <input type="hidden" name="filter_column" value="tenbh">
              <input type="hidden" name="filter_page" value="1">
              <input type="hidden" name="filter_direction" value="asc">
          </div>

          <?php echo $paginationHTML; ?>
      </form>
    </div>
    
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
    });

    function submitForm(url){
        $("#adminForm").attr('action', url);
        $("#adminForm").submit();
    };

    function sortList(column, order){
        $('input[name=filter_column]').val(column);
        $('input[name=filter_direction]').val(order);
        $("#adminForm").submit();
    }

    function changePage(page){
        $('input[name=filter_page]').val(page);
        $("#adminForm").submit();
    }

</script>