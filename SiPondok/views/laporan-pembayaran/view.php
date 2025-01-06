<?php

use SiPondok\models\Pembayaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var SiPondok\models\PembayaranSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Laporan Pembayaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-index">

    <form method="get" action="<?= \yii\helpers\Url::to(['laporan-pembayaran/index']) ?>"> <!-- Sesuaikan URL sesuai rute Anda -->
        <div class="form-group">
            <label for="id_tahun_ajaran">Tahun Ajaran</label>
            <select class="form-control" id="id_tahun_ajaran" name="id_tahun_ajaran">
                <option value="">Pilih Tahun Ajaran</option>
                <?php foreach ($dataTahunAjaran as $id => $tahun): ?>
                    <option value="<?= $id ?>" <?= isset($_GET['id_tahun_ajaran']) && $_GET['id_tahun_ajaran'] == $id ? 'selected' : '' ?>>
                        <?= Html::encode($tahun) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="bulan">Bulan</label>
            <select class="form-control" id="bulan" name="bulan">
                <option value="">Pilih Bulan</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>

        

        <button type="button" class="btn btn-primary" onclick="submitFilter()">Filter</button>
    </form>
    <?php Pjax::begin(); ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Santri</th>
                <th>Tanggal Bayar</th>
                <th>Jumlah Bayar</th>
                <th>Metode Pembayaran</th>
                <th>Keterangan</th>
                <th>Tahun Ajaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalPembayaran = 0;
            foreach ($pembayaran as $index => $model): 
                $totalPembayaran += $model->jumlah_bayar; 
            ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <?= Html::encode($model->tagihan->santri->nis) ?><br>
                        <?= Html::encode($model->tagihan->santri->nama_santri) ?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDatetime($model->tanggal_bayar, 'php:d F Y H:i') . ' WIB' ?>
                    </td>
                    <td><?= Yii::$app->formatter->asCurrency($model->jumlah_bayar) ?></td>
                    <td><?= Html::encode($model->metode_pembayaran) ?></td>
                    <td><?= Html::encode($model->keterangan) ?></td>
                    <td><?= Html::encode($model->tahunAjaran->tahun_ajaran) ?></td>
                    <td>
                        <?php
                        $status = $model->status;
                        $badgeClass = '';

                        switch ($status) {
                            case 'Belum Lunas':
                                $badgeClass = 'badge badge-danger';
                                break;
                            case 'Validasi':
                                $badgeClass = 'badge badge-warning';
                                break;
                            case 'Lunas':
                                $badgeClass = 'badge badge-success';
                                break;
                            default:
                                $badgeClass = 'badge badge-secondary';
                                break;
                        }

                        echo Html::tag('span', ucfirst($status), ['class' => $badgeClass]);
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold;">Total Pembayaran:</td>
                <td style="font-weight: bold;"><?= Yii::$app->formatter->asCurrency($totalPembayaran) ?></td>
                <td colspan="4"></td>
            </tr>
        </tbody>
    </table>

    <?php Pjax::end(); ?>

</div>
<script>
    function submitFilter() {
        var selectedTahunAjaran = document.getElementById('id_tahun_ajaran').value;
        var selectedBulan = document.getElementById('bulan').value;

        if (!selectedTahunAjaran) {
            alert('Pilih Tahun Ajaran terlebih dahulu');
            return;
        }

        var url = '<?= \yii\helpers\Url::to(['laporan-pembayaran/view']) ?>';
        var queryParams = 'id_tahun_ajaran=' + selectedTahunAjaran;

        if (selectedBulan) {
            queryParams += '&bulan=' + selectedBulan;
        }

        window.location.href = url + '&' + queryParams;
    }
</script>