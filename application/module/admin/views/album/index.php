<?php
    $this->arrParam['search']           = (isset($this->arrParam['search'])) ? $this->arrParam['search'] : '';

    //Pagination
    $paginationHTML = $this->pagination->showPagination(URL::createLink('admin','album','index'));

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
                      <th><a href="#">Tên Album </a></th>
                      <th width="20%"><a href="#">Info Album</a></th>
                      <th width="8%"><a href="#">Offer</a></th>
                      <th width="12%"><a href="#">Ca sỹ</a></th>
                      <th width="8%"><a href="#">Thể loại</a></th>
                      <th width="15%"><a href="#">Chủ Đề</a></th>
                      <th width="10%"><a href="#">Quốc gia</a></th>
                  </tr>
              </thead>
              <tbody>
                <?php
                    $i = 0;
                    foreach($this->albumItems as $album){
                        $row = ($i % 2 == 0) ? 'row-chan' : ' ';
                        $id = $album['idalbum'];
                        $image = '<img width="50" height="50" src="public/images/albums/'.$album['hinhanh'].'" alt="">';
                        $link = URL::CreateLink('admin', 'album', 'form', array('idalbum' => $album['idalbum']));
                        $dexuat = Helper::cmsStatus($album['dexuat'], URL::createLink('admin', 'album', 'ajaxStatus', array('id'=> $id,'status'=> $album['dexuat'])), $id);
                        echo '<tr class="'.$row.'">
                            <td>
                                <input type="checkbox" name="cid[]" id="'.$album['idalbum'].'" value="'.$album['idalbum'].'" class="chcktbl" />
                                <label for="'.$album['idalbum'].'"></label></td>
                            <td>'.$image.'</td>
                            <td><a href="'.$link.'">'.$album['tenalbum'].'</a></td>
                            <td>'.$album['infoalbum'].'</td>
                            <td style="vertical-align:middle;">'.$dexuat.'</td>
                            <td>'.$album['tencasy'].'</td>
                            <td>'.$album['tentheloai'].'</td>
                            <td>'.$album['tenchude'].'</td>
                            <td>'.$album['tenquocgia'].'</td>
                        </tr>';
                        $i++;
                    }
                ?>
              </tbody>
          </table>
                  
          <div>
              <input type="hidden" name="filter_column" value="tenalbum">
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