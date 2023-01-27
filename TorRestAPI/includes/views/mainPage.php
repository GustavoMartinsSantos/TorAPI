<?php $currentPage = (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT)) ? $_GET['page'] : 1;
      $pagination = new Pagination(count($allIPs), $limit ?? 54);
      $allIPs = $pagination->getResults($allIPs, $currentPage); ?>
<!-- setting the pagination to all pages that are using this file -->

<div class="container bg-purple p-4 rounded-bottom">
    <?php if(isset($_SESSION['message'])) { ?>
        <?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?>
    <?php }
    ?>

    <form method="<?php echo (TITLE == 'Tor REST API') ? 'GET' : 'POST' ?>"
    action="<?php echo TITLE == 'Tor REST API' ? null : firstEndpoint ?>" 
    class="mb-3 input-group form-row">
        <input type="text" placeholder="Ex.: 104.53.221.159" class="form-control w-75" name="AddressIP"
        <?php echo TITLE == 'Tor REST API' ? "value='$search' oninput='this.form.submit()'" : "required" ?>>
        <?php if(TITLE == 'Tor REST API') { ?> <!-- you are at the index page -->   
                <label class="input-group-text">IPs por página</label>
                <input type="number" name="limit" value="<?php echo $limit ?>" class="form-control col-auto" min="1">

                <button class="btn bg-dark text-light input-group-addon" type="submit"><i class="bi bi-search"></i></button>
        <?php } else { ?>
                <input type="submit" class="btn btn-warning input-group-addon" value="<?php
                    if(firstEndpoint == '../ips-desocultos/desocultarIP.php')
                        echo "Desocultar IP";
                    else
                        echo "Ocultar IP";
                ?>">
        <?php } ?>
    </form>

    <!-- current page button is always at the middle, having 2 buttons to the left and 2 to the right -->
    <?php echo $pagination->getButtonsSection($currentPage, 5); ?>
    
    <div style="float: right" class="mx-4 mb-3">
        <a href="<?php echo secndEndpoint ?>">
            <button class="btn btn-primary">
            <?php 
                if(secndEndpoint == '../')
                    echo 'Todos os IPs';
                else
                    echo 'IPs ocultos';
            ?>
            </button>
        </a>

        <a href="<?php echo thirdEndpoint ?>">
            <button class="btn btn-primary">
                <?php
                    if(thirdEndpoint == '../ips-ocultos')
                        echo 'IPs ocultos';
                    else
                        echo 'IPs não ocultos';
                ?>
            </button>
        </a>
    </div>

    <div class="container row d-flex justify-content-between">
        <?php 
            if($allIPs == null) {
                echo "<div class='bg-dark p-3 container rounded'>";
                if(TITLE == 'IPs ocultos')
                    echo "Nenhum IP foi ocultado até o momento";
                else
                    echo "IPs não encontrados!!";
                echo "</div>";
            } else { // slices all IPs in 3 arrays (row), each one with the same number of values
                foreach(array_chunk($allIPs, ceil(count($allIPs)/3)) as $row) { ?>
                    <div class="p-3 rounded bg-dark text-center" style="width: 33%;">
                        <?php foreach($row as $IP) { ?>
                            <div style="color: #40F128"><?php echo $IP ?></div>
                        <?php } ?>
                    </div>
                <?php } 
            } ?>
    </div>
</div>