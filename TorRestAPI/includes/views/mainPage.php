<?php $currentPage = (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT)) ? $_GET['page'] : 1;
      $pagination = new Pagination(count($allIPs));
      $allIPs = $pagination->getResults($allIPs, $currentPage); ?>

<div class="container bg-purple p-4 rounded-bottom">
    <?php if(isset($_SESSION['message'])) { ?>
        <?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?>
    <?php }
    ?>

    <form method="POST" action="../ocultar-ip/index.php" class="mb-3 row">
        <div class="col-md-10">
            <input type="text" placeholder="Ex.: 104.53.221.159" class="form-control" name="AddressIP" required>
        </div>
        <div class="col-md-2"><input type="submit" class="btn btn-primary rounded" value="Ocultar IP"></div>
    </form>

    <div class="d-flex justify-content-center">
        <?php echo $pagination->getButtonsSection($currentPage, 16); ?>
    </div>
    
    <div class="container row d-flex justify-content-between">
        <!-- 57 IPs - paginação - mais de 1mi de páginas -->
        <?php foreach(array_chunk($allIPs, ceil(count($allIPs)/3)) as $row) { ?>
            <div class="p-3 rounded bg-dark text-center" style="width: 33%;">
                <?php foreach($row as $IP) { ?>
                    <div style="color: #40F128"><?php echo $IP ?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>