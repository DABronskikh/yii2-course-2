<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'RBAC',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'admin', 'icon' => 'file-code-o', 'url' => ['/admin']],
                            ['label' => 'route', 'icon' => 'file-code-o', 'url' => ['/admin/route']],
                            ['label' => 'permission', 'icon' => 'file-code-o', 'url' => ['/admin/permission']],
                            ['label' => 'menu', 'icon' => 'file-code-o', 'url' => ['/admin/menu']],
                            ['label' => 'role', 'icon' => 'file-code-o', 'url' => ['/admin/role']],
                            ['label' => 'assignment', 'icon' => 'file-code-o', 'url' => ['/admin/assignment']],
                            ['label' => 'user', 'icon' => 'file-code-o', 'url' => ['/admin/user']],

                        ],

                    ],
                    ['label' => 'задачи', 'icon' => 'file-code-o', 'url' => ['/tasks']],
                    ['label' => 'статусы задач', 'icon' => 'file-code-o', 'url' => ['/task-statuses']],
                    ['label' => 'комменатрии', 'icon' => 'file-code-o', 'url' => ['/comment']],
                    ['label' => 'файлы', 'icon' => 'file-code-o', 'url' => ['/files']],
                ],
            ]
        ) ?>

    </section>

</aside>
