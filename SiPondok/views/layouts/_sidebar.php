<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SiPondok</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            if (Yii::$app->user->identity->role == 'admin') {
                echo \hail812\adminlte\widgets\Menu::widget([
                    'items' => [
                        // ['label' => 'Yii2 PROVIDED', 'header' => true],
                        ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                        // ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                        ['label' => 'Santri', 'icon' => 'user', 'url' => ['/santri']],
                        ['label' => 'Kelas', 'icon' => 'user', 'url' => ['/kelas']],
                        ['label' => 'Pembayaran', 'icon' => 'coins', 'url' => ['/pembayaran']],
                        ['label' => 'Jenis Pembayaran', 'icon' => 'file', 'url' => ['/jenis-pembayaran']],
                        ['label' => 'Tahun ajaran', 'icon' => 'calendar', 'url' => ['/tahun-ajaran']],
                        ['label' => 'Tagihan', 'icon' => 'pen', 'url' => ['/tagihan']],
                        ['label' => 'Laporan', 'icon' => 'clipboard', 'url' => ['/laporan-pembayaran']],
                    ],
                ]);
            } else {
                echo \hail812\adminlte\widgets\Menu::widget([
                    'items' => [
                            ['label' => 'Tagihan', 'icon' => 'pen', 'url' => ['/tagihan-santri']],
                        ],
                    ]);
            }
           
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>