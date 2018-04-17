<?php
    $this->arrParam['search']           = (isset($this->arrParam['search'])) ? $this->arrParam['search'] : '';

    //Pagination
    //$paginationHTML = $this->pagination->showPagination(URL::createLink('admin','musician','index'));

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
                      <th><a href="#">Tên Bài Hát </a></th>
                      <th width="30%"><a href="#">Info MV</a></th>
                      <th width="7%"><a href="#">Đề xuất</a></th>
                      <th width="7%"><a href="#">Views</a></th>
                      <th width="7%"><a href="#">Likes</a></th>
                      <th width="7%"><a href="#">Download</a></th>
                      <th width="7%"><a href="#">ID</a></th>
                  </tr>
              </thead>
              <tbody>
                <?php
                        $i = 0;
                        foreach($this->mvs as $mv){
                            $row = ($i % 2 == 0) ? 'row-chan' : ' ';
                            $id = $mv['idmv'];
                            $image = '<img width="50" height="50" src="public/images/mv/'.$mv['hinhanh'].'" alt="">';
                            $dexuat = Helper::cmsStatus($mv['dexuat'], URL::createLink('admin', 'mv', 'ajaxStatus', array('id'=> $id,'status'=> $mv['dexuat'])), $id);
                            $link = URL::CreateLink('admin', 'mv', 'form', array('idmv' => $mv['idmv']));
                            echo '<tr class="'.$row.'">
                                <td>
                                    <input type="checkbox" name="cid[]" id="'.$mv['idmv'].'" value="'.$mv['idmv'].'" class="chcktbl" />
                                    <label for="'.$mv['idmv'].'"></label></td>
                                <td>'.$image.'</td>
                                <td><a href="'.$link.'">'.$mv['tenbh'].'</a></td>
                                <td>'.$mv['infomv'].'</td>
                                <td style="vertical-align:middle;">'.$dexuat.'</td>
                                <td>'.$mv['luotxem'].'</td>
                                <td>'.$mv['luotthich'].'</td>
                                <td>'.$mv['luottai'].'</td>
                                <td>'.$mv['idmv'].'</td>
                            </tr>';
                            $i++;
                        }
                    ?>
              </tbody>
          </table>
                  
          <div>
              <input type="hidden" name="filter_column" value="tenbh">
              <input type="hidden" name="filter_page" value="1">
              <input type="hidden" name="filter_direction" value="asc">
          </div>

          <?php //echo $paginationHTML; ?>
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