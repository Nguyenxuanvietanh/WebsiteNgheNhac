<?php
    $this->arrParam['search']           = (isset($this->arrParam['search'])) ? $this->arrParam['search'] : '';

    //Pagination
    $paginationHTML = $this->pagination->showPagination(URL::createLink('admin','musician','index'));

    //MESSAGE
    $message = Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);
?>

<div class="content"> 
  <div class="m-content">
    <?php include_once 'toolbar/toolbar.php'; ?>
    <?php echo $strMessage; ?>
    <div class="main">
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
                      <th><a href="#">Tên Nhạc Sỹ </a></th>
                      <th width="40%"><a href="#">Info Nhạc sỹ</a></th>
                      <th width="12%"><a href="#">Lượt Quan Tâm</a></th>
                      <th width="10%"><a href="#">ID</a></th>
                  </tr>
              </thead>
              <tbody>
                <?php
                    $i = 0;
                    foreach($this->musicianItems as $musician){
                        $row = ($i % 2 == 0) ? 'row-chan' : ' ';
                        $image = '<img width="50" height="50" src="public/images/musicians/'.$musician['hinhanh'].'" alt="">';
                        $link = URL::CreateLink('admin', 'musician', 'form', array('idnghesy' => $musician['idnghesy']));
                        echo '<tr style="line-height: 101px;" class="'.$row.'">
                            <td>
                                <input type="checkbox" name="cid[]" id="'.$musician['idnghesy'].'" value="'.$musician['idnghesy'].'" class="chcktbl" />
                                <label for="'.$musician['idnghesy'].'"></label></td>
                            <td>'.$image.'</td>
                            <td><a href="'.$link.'">'.$musician['tennghesy'].'</a></td>
                            <td style="text-align: left;">'.$musician['infonghesy'].'</td>
                            <td>'.$musician['luotquantam'].'</td>
                            <td>'.$musician['idnghesy'].'</td>
                        </tr>';
                        $i++;
                    }
                ?>
              </tbody>
          </table>
                  
          <div>
              <input type="hidden" name="filter_column" value="tennghesy">
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