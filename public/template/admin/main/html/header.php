<div id="loader">
<div class="spinner"></div>
</div>
<script type="text/javascript">
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    setTimeout(() => {
        loader.classList.add('fadeOut');
    }, 300);
});
</script>
<div>
<?php
    $linkHome       = URL::createLink('default', 'index', 'index');
    $linkAdminHome  = URL::createLink('admin', 'index', 'index');
    $linkSong       = URL::createLink('admin', 'song', 'index');
    $linkMV         = URL::createLink('admin', 'mv', 'index');
    $linkAlbum      = URL::createLink('admin', 'album', 'index');
    $linkMusician   = URL::createLink('admin', 'musician', 'index');
    $linkSinger     = URL::createLink('admin', 'singer', 'index');
    $linkUser       = URL::createLink('admin', 'user', 'index');
    $linkCategory   = URL::createLink('admin', 'category', 'index');
    $linkTopic      = URL::createLink('admin', 'topic', 'index');

    $user = $_SESSION['user'];
?>
<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="<?php echo $linkHome; ?>" class="td-n">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo"><img src="assets/static/images/logo.png" alt=""></div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">HOME</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item mT-30 active"><a class="sidebar-link" href="<?php echo $linkAdminHome; ?>" default><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Administrator</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkSong; ?>"><span class="icon-holder"><i class="c-brown-500 ti-email"></i> </span><span class="title">Songs </span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkAlbum; ?>"><span class="icon-holder"><i class="c-blue-500 ti-share"></i> </span><span class="title">Albums </span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkMV; ?>"><span class="icon-holder"><i class="c-deep-orange-500 ti-calendar"></i> </span><span class="title">MVs </span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkSinger; ?>"><span class="icon-holder"><i class="c-deep-purple-500 ti-comment-alt"></i> </span><span class="title">Singers </span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkMusician; ?>"><span class="icon-holder"><i class="c-indigo-500 ti-bar-chart"></i> </span><span class="title">Musicians </span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkUser; ?>"><span class="icon-holder"><i class="c-light-blue-500 ti-pencil"></i> </span><span class="title">Users </span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkCategory; ?>"><span class="icon-holder"><i class="c-pink-500 ti-palette"></i> </span><span class="title">Categories</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="<?php echo $linkTopic; ?>"><span class="icon-holder"><i class="c-orange-500 ti-layout-list-thumb"></i> </span><span class="title">Topics</span></a></li>
            <!--<li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-orange-500 ti-layout-list-thumb"></i> </span><span class="title">Tables</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="basic-table.html">Basic Table</a></li>
                    <li><a class="sidebar-link" href="datatable.html">Data Table</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-purple-500 ti-map"></i> </span><span class="title">Maps</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a href="google-maps.html">Google Map</a></li>
                    <li><a href="vector-maps.html">Vector Map</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Pages</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="404.html">404</a></li>
                    <li><a class="sidebar-link" href="500.html">500</a></li>
                    <li><a class="sidebar-link" href="signin.html">Sign In</a></li>
                    <li><a class="sidebar-link" href="signup.html">Sign Up</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Multiple Levels</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu Item</span></a></li>
                    <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu Item</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">Menu Item</a></li>
                            <li><a href="javascript:void(0);">Menu Item</a></li>
                        </ul>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>
<div class="page-container">
    <div class="header navbar">
        <div class="header-container">
            <ul class="nav-left">
                <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
                <li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i class="search-icon ti-search pdd-right-10"></i> <i class="search-icon-close ti-close pdd-right-10"></i></a></li>
                <li class="search-input"><input class="form-control" type="text" placeholder="Search..."></li>
            </ul>
            <ul class="nav-right">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                        <div class="peer mR-10">
                            <img class="w-2r bdrs-50p" src="public/images/users/<?php echo $user['hinhanh']; ?>" alt="">
                        </div>
                        <div class="peer"><span class="fsz-sm c-grey-900"><?php echo $user['name']; ?></span></div>
                    </a>
                    <ul class="dropdown-menu fsz-sm">
                        <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>Setting</span></a></li>
                        <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i> <span>Profile</span></a></li>
                        <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-email mR-10"></i> <span>Messages</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo URL::createLink('admin', 'index', 'logout') ?>" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>