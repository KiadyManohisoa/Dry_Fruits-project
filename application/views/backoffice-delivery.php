<!-- livraison en attente -->
<div class="content col-lg-6 col-md-6">
    <h2>Lists of pending baskets</h2>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Baskets</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>xx-xx-xxxx</td>
                    <td><a href="">Baskets-Link</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- livraison en attente -->

<!-- deja livree -->
<div class="content col-lg-6 col-md-6">
    <h2>Lists of delivered baskets</h2>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Baskets</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>xx-xx-xxxx</td>
                    <td><a href="">Baskets-Link</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- deja livree -->

<!-- livraison a faire -->
<div class="content col-lg-12">
    <h2>Delivery managment</h2>
    <form class="col-lg-6 col-md-6">
        <div class="form-group">
            <input class="form-control" type="date" class="form-control form-control-custom">
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <hr>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Client full name</th>
                    <th>Adress</th>
                    <th>Baskets</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ninja Kassadias</td>
                    <td>10 N. Martingale Road, Suite 400 Schaumburg</td>
                    <td><a href="">Baskets-Link</a></td>
                    <td>
                        <?php $statut="delivered"; if($statut=="delivered") { ?>
                            <a class="round-check disabled-link">
                                <input type="radio" checked>
                                <span></span>
                            </a>
                        <?php } else { ?>
                            <a href="" class="round-check">
                                <input type="radio">
                                <span></span>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- livraison a faire -->