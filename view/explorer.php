<?php if(isset($trans)) { ?>                                 // if "https://example.com/explorer/tx/{TX_HASH}"/ is Null
<form action="<?= site_url() ?>explorer" method="post">
    <div class="input-group">
        <input class="form-control" type="text" name="txid" placeholder="Search your transaction or check balance, an transaction hash or address">
            <span class="input-group-btn">
                 <button type="submit" class="btn btn-primary">Submit</button>
            </span>
        </div>
</form>
<h2>Summary</h2>
<div class="table-responsive">
 <table class="table" style="margin-bottom: 0px;">
    <tbody>
        <tr>
          <th>Hash</th>
          <td><a href="<?= site_url() ?>explorer/tx/<?= $trans['hash'] ?>"><?= $trans['hash'] ?></a></td>
        </tr>
        <tr>
          <th>Total Value</th>
          <td>
<?php 
    $sum = 0;
       foreach($trans['inputs'] as $key=>$value)
    {
       $sum+= $value['prev_out']['value'];
    }
 { ?>
          <?= number_format($sum*(pow(10, -8)), 8, '.', ''); ?> BTC
<?php } ?>
          </td>
        </tr>
        <tr>
          <th>Fee</th>
          <td><?= number_format(($trans['fee'])*(pow(10, -8)), 8, '.', ''); ?> BTC</td>
        </tr>
        <tr>
          <th>From</th>
          <td>
          <?php foreach($trans['inputs'] as $transac) { ?>
          <p><a href="<?= site_url() ?>explorer/addr/<?= $transac['prev_out']['addr'] ?>"><?= $transac['prev_out']['addr'] ?></a> <?= number_format(($transac['prev_out']['value'])*(pow(10, -8)), 8, '.', ''); ?> BTC</p>
           <?php } ?>
          </td>
        </tr>
        <tr>
          <th>To</th>
          <td>
          <?php foreach($trans['out'] as $transac) { ?>
          <p><a href="<?= site_url() ?>explorer/addr/<?= $transac['addr'] ?>"><?= $transac['addr'] ?></a> <?= number_format(($transac['value'])*(pow(10, -8)), 8, '.', ''); ?> BTC</p>
          <?php } ?>
          </td>
        </tr>
    </tbody>
 </table>
</div>
<hr>
<h2>Details</h2>
<div class="table-responsive">
 <table border="0" class="table" style="margin-bottom: 0px;">
    <tbody>
        <tr>
          <th>Hash</th>
          <td><a href="<?= site_url() ?>explorer/tx/<?= $trans['hash'] ?>"><?= $trans['hash'] ?></a></td>
        </tr>
        <tr>
          <th>Status</th>
          <td><?php if($trans['ver'] == 1){ ?><span class="label label-success label-as-badge">Confirmed</span><?php }else{ ?><span class="label label-warning label-as-badge">Unconfirmed</span><?php } ?></td>
        </tr>
        <tr>
          <th>Fee</th>
          <td><?= number_format(($trans['fee'])*(pow(10, -8)), 8, '.', ''); ?> BTC</td>
        </tr>
        <tr>
          <th>Received Time</th>
          <td><?= date("Y-m-d h:i:sa", $trans['time']); ?></td>
        </tr>
        <tr>
          <th>Size</th>
          <td><?= number_format($trans['size']) ?> bytes</td>
        </tr>
        <tr>
          <th>Weight</th>
          <td><?= number_format($trans['weight']) ?></td>
        </tr>
        <tr>
          <th>Include in block</th>
          <td><a href="https://www.blockchain.com/btc/block/<?= $trans['block_index'] ?>" target="_blank" rel="nofollow"><?= $trans['block_index'] ?></a></td>
        </tr>
    </tbody>
 </table>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
<h3>Inputs</h3>
<?php foreach($trans['inputs'] as $transac) { ?>
<div class="table-responsive">
 <table class="table" style="margin-bottom: 0px;">
    <tbody>
        <tr>
          <th>Index</th>
          <td><?= $transac['index'] ?></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><a href="<?= site_url() ?>explorer/addr/<?= $transac['prev_out']['addr'] ?>"><?= $transac['prev_out']['addr'] ?></a></td>
        </tr>
        <tr>
          <th>Value</th>
          <td><?= number_format(($transac['prev_out']['value'])*(pow(10, -8)), 8, '.', ''); ?> BTC</td>
        </tr>
        <tr>
          <th>Spent</th>
          <td><?php if($transac['prev_out']['spent'] == 1){ ?><span class="label label-danger label-as-badge">Spent</span><?php }else{ ?><span class="label label-warning label-as-badge">Unspent</span><?php } ?></td>
        </tr>
    </tbody>
 </table>
</div>
<?php } ?>
    </div>
    <div class="col-md-6">
<h3>Outputs</h3>
<?php foreach($trans['out'] as $transac) { ?>
<div class="table-responsive">
 <table class="table" style="margin-bottom: 0px;">
    <tbody>
        <tr>
          <th>Index</th>
          <td><?= $transac['n'] ?></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><a href="<?= site_url() ?>explorer/addr/<?= $transac['addr'] ?>"><?= $transac['addr'] ?></a></td>
        </tr>
        <tr>
          <th>Value</th>
          <td><?= number_format(($transac['value'])*(pow(10, -8)), 8, '.', ''); ?> BTC</td>
        </tr>
        <tr>
          <th>Spent</th>
          <td><?php if($transac['spent'] == 1){ ?><span class="label label-danger label-as-badge">Spent</span><?php }else{ ?><span class="label label-warning label-as-badge">Unspent</span><?php } ?></td>
        </tr>
    </tbody>
 </table>
</div>
<hr>
<?php } ?>
    </div>
</div>

<?php }else if(isset($address)) { ?>                          // if "https://example.com/explorer/addr/{ADDRESS}" is Not Null
<form action="<?= site_url() ?>explorer" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="txid" placeholder="Search your transaction or check balance, an transaction hash or address">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Submit</button>
        </span>
        </div>
</form>

<h2>Address Info</h2>
<?php foreach($address as $add) { ?>
<div class="table-responsive">
 <table class="table" style="margin-bottom: 0px;">
    <tbody>
        <tr>
          <th>Address</th>
          <td><?= $the_address ?></td>
        </tr>
        <tr>
          <th>Balance</th>
          <td><?= number_format(($add['final_balance'])*(pow(10, -8)), 8, '.', ''); ?> BTC</td>
        </tr>
        <tr>
          <th>Total Transactions</th>
          <td><?= $add['n_tx'] ?></td>
        </tr>
        <tr>
          <th>Total Received</th>
          <td><?= number_format(($add['total_received'])*(pow(10, -8)), 8, '.', ''); ?> BTC</td>
        </tr>
    </tbody>
 </table>
</div>
<?php } ?>

<?php }else{ ?>                                         // if "https://example.com/explorer/tx/{TX_HASH}" or "https://example.com/explorer/addr/{ADDRESS}"/ is Null
<h1>Bitcoin Explorer</h1>
<form action="<?= site_url() ?>explorer" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="txid" placeholder="Search your transaction or check balance, an transaction hash or address">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Submit</button>
        </span>
        </div>
</form>
<?php } ?>
<h2>Examples of usage</h2>
<p>Usage to check transactions to the url "https://example.com/explorer/tx/{TX_HASH}". <br>Example "https://example.com/explorer/tx/b6f6991d03df0e2e04dafffcd6bc418aac66049e2cd74b80f14ac86db1e3f0da".</p>
<p>Usage to check bitcoin address to url "https://example.com/explorer/addr/{ADDRESS}". <br>Example "https://example.com/explorer/addr/1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq".</p>

