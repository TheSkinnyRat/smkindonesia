<?php
session_start();
session_destroy();
session_start();
$_SESSION['notif'] = "<div class='notif-warning-a'>ANDA BERHASIL LOGOUT</div>";
?>
<script type="text/javascript">
  window.location = '../index.php';
</script>
