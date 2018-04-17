<?php
    // $this->arrParam['search']           = (isset($this->arrParam['search'])) ? $this->arrParam['search'] : '';

    // //Pagination
    // $paginationHTML = $this->pagination->showPagination(URL::createLink('admin','album','index'));

    //MESSAGE
    $message = Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);
    if(isset($this->formData)){
        $formData = $this->formData;
    }
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $rowID = '';
    if(isset($formData['idchude'])){
        $inputID	= '<input type="text" name="form[idchude]" id="idchude" value="'.$formData['idchude'].'" class="form-control" readonly>';
        $rowID		= Helper::cmsFormRow('ID', $inputID);
    }
    //Input
    $inputTopic         = Helper::cmsInput('text', 'form[tenchude]', 'tenchude', null, 'form-control required');
    if(isset($formData['tenchude'])){
        $inputTopic         = Helper::cmsInput('text', 'form[tenchude]', 'tenchude', $formData['tenchude'], 'form-control required');
    }
    
    $inputHinhAnh       = Helper::cmsInput('file', 'form[hinhanh]', 'hinhanh', null, 'required');

    $rowTopic        = Helper::cmsFormRow('Tên Thể Loại', $inputTopic, true);
    $rowHinhanh         = Helper::cmsFormRow('Hình ảnh', $inputHinhAnh, true);

    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());

    $this->errors = (isset($this->errors)) ? $this->errors : '';
?>

<div class="content"> 
  <div class="m-content">
    <?php include_once 'toolbar/toolbar.php'; ?>
    <?php echo $strMessage; ?>
    <div class="main">
      <form action="#" id="adminForm" name="adminForm" method="POST" enctype="multipart/form-data">
          
          <div class="clr"></div>
          
          <table class="table table-condensed">
              <thead>
                  <tr>
                      <th width="3%">
                          <input type="checkbox" id="selectAll" name="selectAll" />
                          <label for="selectAll"></label>
                      </th>
                      <th width="46%"><a href="#">Picture</a></th>
                      <th><a href="#">Topic </a></th>
                      <th width="10%"><a href="#">ID</a></th>
                  </tr>
              </thead>
              <tbody>
                    
                <?php
                    $i = 0;
                    foreach($this->topics as $topic){
                        $row = ($i % 2 == 0) ? 'row-chan' : ' ';
                        $id = $topic['idchude'];
                        $image = '<img width="200" height="50" src="public/images/topics/'.$topic['hinhanh'].'" alt="">';
                        $link = URL::CreateLink('admin', 'topic', 'index', array('idchude' => $id));
                        echo '<tr class="'.$row.'">
                            <td>
                                <input type="checkbox" name="cid[]" id="'.$id.'" value="'.$id.'" class="chcktbl" />
                                <label for="'.$id.'"></label></td>
                            <td>'.$image.'</td>
                            <td><a href="'.$link.'">'.$topic['tenchude'].'</a></td>
                            <td>'.$id.'</td>
                        </tr>';
                        $i++;
                    }
                ?>
              </tbody>
          </table>
                  
          <!-- <div>
              <input type="hidden" name="filter_column" value="tennghesy">
              <input type="hidden" name="filter_page" value="1">
              <input type="hidden" name="filter_direction" value="asc">
          </div> -->

          <?php //echo $paginationHTML; ?>

          <div class="category-form">
            <h4>Topic Form</h4>
            <?php echo $this->errors; ?>
            <?php echo $rowID . $rowHinhanh . $rowTopic . $inputToken; ?>
          </div>
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