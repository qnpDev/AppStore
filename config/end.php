    </div>
</div>    
    <!-- End content --> 

<footer id="main-content" class="text-center foot page-content">
  <!-- Copyright -->
  <div class="text-center p-3 text-white">
    © 2021 Copyright:
    <a class="text-danger font-weight-bold text-decoration-none" href="#">QNP</a>
  </div>
  <!-- end Copyright -->
</footer>

<!-- Button top -->
<a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
</a>
<!-- end Button top -->

<?php
$query = mysqli_query($conn, "SELECT * FROM forgottoken");
while ($datatoken = mysqli_fetch_assoc($query)) {
    $timetoken = strtotime($datatoken['date']);
    $currenttime = time() - (60 * 60 * 24);
    if ($currenttime > $timetoken) {
        mysqli_query($conn, "DELETE FROM forgottoken WHERE id=".$datatoken['id']);
    }
}
?>