
<div class="content">

<div class="m-content">
    <?php include_once 'toolbar/toolbar.php'; ?>

    <?php
        $this->arrParam['filter_column']    = (isset($this->arrParam['filter_column'])) ? $this->arrParam['filter_column'] : '';
        $this->arrParam['filter_direction'] = (isset($this->arrParam['filter_direction'])) ? $this->arrParam['filter_direction'] : '';
        $this->arrParam['filterStatus']     = (isset($this->arrParam['filterStatus'])) ? $this->arrParam['filterStatus'] : '';
        $this->arrParam['search']           = (isset($this->arrParam['search'])) ? $this->arrParam['search'] : '';

        $columnPost = $this->arrParam['filter_column'];
        $orderPost  = $this->arrParam['filter_direction'];

        $lblName    = Helper::cmsLinkSort('Tên Bài Hát', 'tenbh', $columnPost, $orderPost);
        $lblOffer   = Helper::cmsLinkSort('Offer', 'dexuat', $columnPost, $orderPost);
        $lblNgay    = Helper::cmsLinkSort('Ngày PH', 'ngayphathanh', $columnPost, $orderPost);
        $lblID      = Helper::cmsLinkSort('ID', 'idbaihat', $columnPost, $orderPost);

        $arrStatus = array('default' => '- SelectStatus -', 1 => 'Publish', 0 => 'Unpublish');
        $selectStatus = Helper::cmsSelectBox('filterStatus', $arrStatus, $this->arrParam['filterStatus']);


        //Pagination
        $paginationHTML = $this->pagination->showPagination(URL::createLink('admin','song','index'));

        //MESSAGE
        $message = Session::get('message');
        Session::delete('message');
        $strMessage = Helper::cmsMessage($message);


    ?>
    
    <?php echo $strMessage; ?>
    
  <div class="main">
    <form action="#" id="adminForm" name="adminForm" method="POST">
        <div class="filter">
            <input type="text" name="search" id="search" value="<?php $this->arrParam['search']; ?>">
            <button type="submit" name="btnSearch">Search</button>
            <button type="button" name="btnClear">Clear</button>
        </div>
        <div class="filter-group">
        <?php echo $selectStatus; ?>
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
                    <th><?php echo $lblName; ?></th>
                    <th width="12%"><?php echo $lblNgay ?></th>
                    <th width="8%"><?php echo $lblOffer ?></th>
                    <!-- <th><a href="#">Sáng tác</a></th> -->
                    <th><a href="#">Ca sỹ</a></th>
                    <!-- <th><a href="#">Thể loại</a></th> -->
                    <th><a href="#">Album</a></th>
                    <th width="5%"><?php echo $lblID ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($this->songItems)){
                        $i = 0;
                        foreach($this->songItems as $key => $value){
                            $row = ($i % 2 == 0) ? 'row-chan' : ' ';
                            $id = $value['idbaihat'];
                            $checkbox = '<input type="checkbox" name="cid[]" id="'.$id.'" value="'.$id.'" class="chcktbl" />
                                        <label for="'.$id.'"></label>';
                            $image = '<img width="50" height="50" src="public/images/songs/'.$value['hinhanh'].'" alt="">';
                            $name = $value['tenbh'];
                            $ngayphathanh = Helper::formatDate('d-m-Y', $value['ngayphathanh']);
                            $dexuat = Helper::cmsStatus($value['dexuat'], URL::createLink('admin', 'song', 'ajaxStatus', array('id'=> $id,'status'=> $value['dexuat'])), $id);
                            $casy = $value['tencasy'];
                            $album = $value['tenalbum'];
                            $link = URL::CreateLink('admin', 'song', 'showInfo', array('idbh' => $id));
                            
                        echo '<tr class = "' . $row .'" >
                                <td>'.$checkbox.'</td>
                                <td>'.$image.'</td>
                                <td><a href="'.$link.'">'.$name.'</a></td>
                                <td>'.$ngayphathanh.'</td>
                                <td style="vertical-align:middle;">'.$dexuat.'</td>
                                <td>'.$casy.'</td>
                                <td>'.$album.'</td>
                                <td>'.$id.'</td>
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