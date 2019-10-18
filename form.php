<?php
function add_laisuat_form() { 
  ob_start();
  $options = get_option('laisuat');
  ?>
  <form class="input-form">
      <label for="amount"><?php _e('Amount', 'laisuat'); ?></label>
      <div class="input-box">
          <input type="number" class="form-control" name="amount" id="amount" class="amount" value="" size="30" required>
      </div>
      <label for="month"><?php _e('Month', 'laisuat'); ?></label>
      <div class="input-box">
          <input type="number" class="form-control" name="month" id="month" class="month" value="" size="30" required>
      </div>
      <label for="rate"><?php _e('Rate (%)', 'laisuat'); ?></label>
      <div class="input-box">
          <input type="number" class="form-control" name="rate" id="rate" class="rate" value="" size="30" required>
      </div>
      <div class="show">SHOW</div>
  </form>
  <div id="show-rate-result">
    <table class="bangtinh">
      <thead>
        <th colspan="2">
          Kỳ thanh toán
        </th>
        <th>
          Ngày tính lãi
        </th>
        <th>
          Tiền còn phải trả
        </th>
        <th>
          Tiền gốc phải trả/tháng
        </th>
        <th>
          Tiền lãi phải trả/tháng
        </th>
        <th>
          Tổng tiền trả hàng tháng
        </th>
      </thead>
      <tbody class="result-body">
        <tr>
          <td>0</td>
          <td class="ky-thanh-toan"></td>
          <td></td>
          <td class="amount-start"></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    
    <div>Tổng lãi gộp: <span class="tong-lai-gop">0</span></div>
    <div>Tổng gốc + lãi gộp: <span class="tong-goc-lai-gop">0</span></div>
  </div>
  <script type = 'text/javascript'>
    var congthuc = "<?php echo $options['basic_rate']; ?>";
    var BASE_URL = "<?php echo plugins_url(); ?>/laisuat";
  </script>
<?php 
$result = ob_get_contents();
ob_end_clean();
return $result;

} 

add_shortcode('laisuat','add_laisuat_form');
?>