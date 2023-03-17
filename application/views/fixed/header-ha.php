<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <?php if (@$title) {
        echo "<title>$title</title >";
    } else {
        echo "<title>Geo POS</title >";
    }
    ?>
    <link rel="apple-touch-icon" href="<?= assets_url() ?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= assets_url() ?>app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/<?= LTR ?>/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/fonts/meteocons/style.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/<?= LTR ?>/app.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>app-assets/fonts/simple-line-icons/style.css">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/<?= LTR ?>/core/colors/palette-gradient.css">
    <link rel="stylesheet" href="<?php echo assets_url('assets/custom/datepicker.min.css') . APPVER ?>">
    <link rel="stylesheet" href="<?php echo assets_url('assets/custom/summernote-bs4.css') . APPVER; ?>">
    <link rel="stylesheet" type="text/css"
          href="<?= assets_url() ?>app-assets/vendors/css/forms/selects/select2.min.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>assets/css/style.css<?=APPVER ?>">
    <!-- END Custom CSS-->
    <script src="<?= assets_url() ?>app-assets/vendors/js/vendors.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script type="text/javascript"
            src="<?= assets_url() ?>app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="<?php echo assets_url(); ?>assets/portjs/raphael.min.js" type="text/javascript"></script>
    <script src="<?php echo assets_url(); ?>assets/portjs/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo assets_url('assets/myjs/datepicker.min.js') . APPVER; ?>"></script>
    <script src="<?php echo assets_url('assets/myjs/summernote-bs4.min.js') . APPVER; ?>"></script>
    <script src="<?php echo assets_url('assets/myjs/select2.min.js') . APPVER; ?>"></script>
    <script type="text/javascript">var baseurl = '<?php echo base_url() ?>';
        var crsf_token = '<?=$this->security->get_csrf_token_name()?>';
        var crsf_hash = '<?=$this->security->get_csrf_hash(); ?>';
    </script>

</head>
<body class="horizontal-layout horizontal-menu 2-columns menu-expanded" data-open="hover" data-menu="horizontal-menu"
      data-col="2-columns">
<span id="hdata"
      data-df="<?php echo $this->config->item('dformat2'); ?>"
      data-curr="<?php echo currency($this->aauth->get_user()->loc); ?>"></span>
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-dark bg-gradient-x-grey-blue navbar-border navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand" href="<?= base_url() ?>dashboard/"><img
                                class="brand-logo" alt="logo"
                                src="<?php echo base_url(); ?>userfiles/theme/logo-header.png">
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                                                  data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>


                    <li class="dropdown  nav-item"><a class="nav-link nav-link-label" href="#"
                                                      data-toggle="dropdown"><i
                                    class="ficon ft-map-pin success"></i></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-left">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span
                                            class="grey darken-2"><i
                                                class="ficon ft-map-pin success"></i><?php echo $this->lang->line('Business') . ' ' . $this->lang->line('Location') ?></span>
                                </h6>
                            </li>

                            <li class="dropdown-menu-footer"><span class="dropdown-item text-muted text-center blue"
                                > <?php $loc = location($this->aauth->get_user()->loc);
                                    echo $loc['cname']; ?></span>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-none d-md-block nav-link "><a href="<?= base_url() ?>pos_invoices/create"
                                                                        class="btn btn-info btn-md t_tooltip"
                                                                        title="Access POS"><i
                                    class="icon-handbag"></i><?php echo $this->lang->line('POS') ?> </a>
                    </li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#" aria-haspopup="true"
                                                       aria-expanded="false" id="search-input"><i
                                    class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text"
                                   placeholder="<?php echo $this->lang->line('Search Customer') ?>"
                                   id="head-customerbox">
                        </div>
                        <div id="head-customerbox-result" class="dropdown-menu ml-5"
                             aria-labelledby="search-input"></div>
                    </li>
                </ul>

                <ul class="nav navbar-nav float-right"><?php if ($this->aauth->get_user()->roleid == 5) { ?>
                        <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link " href="#"
                                                                       data-toggle="dropdown"><?php echo $this->lang->line('Business') ?> <?php echo $this->lang->line('Settings') ?></a>
                            <ul class="mega-dropdown-menu dropdown-menu row">
                                <li class="col-md-3">

                                    <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading1" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap" href="#accordion1"
                                                   aria-controls="accordion1"><i
                                                            class="fa fa-leaf"></i> <?php echo $this->lang->line('Business') . '  ' . $this->lang->line('Settings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion1" role="tabpanel"
                                                 aria-labelledby="heading1" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/company"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Company') . ' ' . $this->lang->line('Settings') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>locations"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Business Locations') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>tools/setgoals"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Set Goals') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading2" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap" href="#accordion2"
                                                   aria-controls="accordion2"> <i
                                                            class="fa fa-calendar"></i><?php echo $this->lang->line('Localisation') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion2" role="tabpanel"
                                                 aria-labelledby="heading2" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/currency"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Currency') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/language"><i
                                                                        class="ft-chevron-right"></i>Languages</a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/dtformat"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Date & Time Format') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/theme"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Theme') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-3">

                                    <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">


                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading2" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap1" href="#accordion5"
                                                   aria-controls="accordion5"> <i
                                                            class="fa fa-shopping-cart"></i><?php echo $this->lang->line('Billing') . ' ' . $this->lang->line('Settings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion5" role="tabpanel"
                                                 aria-labelledby="heading5" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/warehouse"><i class="ft-chevron-right"></i> <?php echo $this->lang->line('Default') . ' ' . $this->lang->line('Warehouse') ?>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/discship"><i class="ft-chevron-right"></i> <?php echo $this->lang->line('Discount') . ' & ' . $this->lang->line('Shipping') ?>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading6" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap1" href="#accordion6"
                                                   aria-controls="accordion6"><i
                                                            class="fa fa-scissors"></i><?php echo $this->lang->line('Tax') . ' ' . $this->lang->line('Settings') ?>
                                                </a>
                                            </div>
                                            <div class="card-collapse collapse mb-1 " id="accordion6" role="tabpanel"
                                                 aria-labelledby="heading6" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/tax"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Tax') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/taxslabs"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Other') . ' ' . $this->lang->line('Tax') . ' ' . $this->lang->line('Settings') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                    </div>
                                </li>
                                <li class="col-md-3">

                                    <div id="accordionWrap2" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading7" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap2" href="#accordion7"
                                                   aria-controls="accordion7"><i
                                                            class="fa fa-flask"></i><?php echo $this->lang->line('Products') . ' ' . $this->lang->line('Settings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion7" role="tabpanel"
                                                 aria-labelledby="heading7" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>units"><i
                                                                        class="ft-chevron-right"></i><?php echo $this->lang->line('Measurement Unit') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>units/variations"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Products') . ' ' . $this->lang->line('Variations') ?>
                                                            </a></li>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>units/variables"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Variations') . ' ' . $this->lang->line('Variables') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                <li class="col-md-3">

                                    <div id="accordionWrap3" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">

                                            <div class="card-header p-0 pb-1 border-0 mt-1" id="heading11" role="tab">
                                                <a class=" text-uppercase black" data-toggle="collapse"
                                                   data-parent="#accordionWrap3" href="#accordion11"
                                                   aria-controls="accordion11"> <i
                                                            class="fa fa-eye"></i><?php echo $this->lang->line('Templates') . ' ' . $this->lang->line('Settings') ?>
                                                </a></div>
                                            <div class="card-collapse collapse mb-1 " id="accordion11" role="tabpanel"
                                                 aria-labelledby="heading8" aria-expanded="true">
                                                <div class="card-content">
                                                    <ul>
                                                        <li><a class="dropdown-item"
                                                               href="<?php echo base_url(); ?>settings/print_invoice"><i
                                                                        class="ft-chevron-right"></i> <?php echo $this->lang->line('Print Invoice') ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>


                            </ul>
                        </li>       <?php } ?>


                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown"><span
                                    class="avatar avatar-online"><img
                                        src="<?php echo base_url('userfiles/employee/thumbnail/' . $this->aauth->get_user()->picture) ?>"
                                        alt="avatar"><i></i></span><span
                                    class="user-name"><?php echo $this->lang->line('Account') ?></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"
                                                                          href="<?php echo base_url(); ?>user/profile"><i
                                        class="ft-user"></i> <?php echo $this->lang->line('Profile') ?>
                            </a>

                            

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>"><i
                                        class="ft-power"></i> <?php echo $this->lang->line('Logout') ?></a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->
<!-- Horizontal navigation-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border"
     role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">

        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>dashboard/"><i
                            class="icon-speedometer 5555"></i><span><?= $this->lang->line('Dashboard') ?></span></a>

            </li>
            <?php
            if ($this->aauth->premission(1)) { ?>
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-basket-loaded"></i><span><?php echo $this->lang->line('sales') ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-paper-plane"></i><?php echo $this->lang->line('pos sales') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>pos_invoices/create"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('New Invoice'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>pos_invoices/create?v2=true"
                                                    data-toggle="dropdown"><?= $this->lang->line('New Invoice'); ?>
                                        V2 - Mobile</a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>pos_invoices"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Manage Invoices'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu="">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>pos_invoices/stitching"><i class="fa fa-scissors"></i>Stitching Sales
                            </a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-basket"></i><?php echo $this->lang->line('sales') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>invoices/create"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('New Invoice'); ?></a>
                                </li>

                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>invoices"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Manage Invoices'); ?></a>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-call-out"></i><?php echo $this->lang->line('Quotes') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>quote/create"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('New Quote'); ?></a>
                                </li>

                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>quote"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Manage Quotes'); ?></a>
                            </ul>
                        </li>

                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-radio"></i><?php echo $this->lang->line('Subscriptions') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>subscriptions/create"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('New Subscription'); ?></a>
                                </li>

                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>subscriptions"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Subscriptions'); ?></a>
                            </ul>
                        </li>
                        <li data-menu="">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>stockreturn/creditnotes"><i
                                        class="icon-screen-tablet"></i><?php echo $this->lang->line('Credit Notes'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php }
            if ($this->aauth->premission(2)) { ?>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="ft-layers"></i><span><?php echo $this->lang->line('Stock') ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-list"></i> <?php echo $this->lang->line('Items Manager') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>products/add"
                                                    data-toggle="dropdown"> <?php echo $this->lang->line('New Product'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>products"
                                                    data-toggle="dropdown"><?= $this->lang->line('Manage Products'); ?></a>
                                </li>


                            </ul>
                        </li>
                        <li data-menu=""><a class="dropdown-item"
                                            href="<?php echo base_url(); ?>productcategory"
                                            data-toggle="dropdown"><i
                                        class="ft-umbrella"></i><?php echo $this->lang->line('Product Categories'); ?>
                            </a>
                        </li>
                        <li data-menu=""><a class="dropdown-item"
                                            href="<?php echo base_url(); ?>productcategory/warehouse"
                                            data-toggle="dropdown"><i
                                        class="ft-sliders"></i><?php echo $this->lang->line('Warehouses'); ?></a>
                        </li>
                        <li data-menu=""><a class="dropdown-item"
                                            href="<?php echo base_url(); ?>products/stock_transfer"
                                            data-toggle="dropdown"><i
                                        class="ft-wind"></i><?php echo $this->lang->line('Stock Transfer'); ?></a>
                        </li>
                        </li>

                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-handbag"></i> <?php echo $this->lang->line('Purchase Order') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>purchase/create"
                                                    data-toggle="dropdown"> <?php echo $this->lang->line('New Order'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>purchase"
                                                    data-toggle="dropdown"><?= $this->lang->line('Manage Orders'); ?></a>
                                </li>


                            </ul>
                        </li>

                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-puzzle"></i> <?php echo $this->lang->line('Stock Return') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>stockreturn"
                                                    data-toggle="dropdown"> <?php echo $this->lang->line('Suppliers') . ' ' . $this->lang->line('Records'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>stockreturn/customer"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Customers') . ' ' . $this->lang->line('Records'); ?></a>
                                </li>


                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-target"></i><?php echo $this->lang->line('Suppliers') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?= base_url(); ?>supplier/create"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('New Supplier'); ?></a>
                                </li>

                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>supplier"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Manage Suppliers'); ?></a>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php }
            if ($this->aauth->premission(3)) {
                ?>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-diamond"></i><span><?php echo $this->lang->line('CRM') ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-users"></i><?php echo $this->lang->line('Clients') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>customers/create"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('New Client') ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>customers"
                                                    data-toggle="dropdown"><?= $this->lang->line('Manage Clients'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu="">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>clientgroup"><i
                                        class="icon-grid"></i><?php echo $this->lang->line('Client Groups'); ?></a>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-ticket"></i><?php echo $this->lang->line('Support Tickets') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>tickets/?filter=unsolved"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('UnSolved') ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>tickets"
                                                    data-toggle="dropdown"><?= $this->lang->line('Manage Tickets'); ?></a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            <?php }
            if ($this->aauth->premission(5)) {
                ?>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-calculator"></i><span><?= $this->lang->line('Accounts') ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-book-open"></i><?php echo $this->lang->line('Accounts') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>accounts"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Manage Accounts') ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>accounts/balancesheet"
                                                    data-toggle="dropdown"><?= $this->lang->line('BalanceSheet'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/accountstatement"
                                                    data-toggle="dropdown"><?= $this->lang->line('Account Statements'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-wallet"></i><?php echo $this->lang->line('Transactions') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>transactions"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('View Transactions') ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>transactions/add"
                                                    data-toggle="dropdown"><?= $this->lang->line('New Transaction'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>transactions/transfer"
                                                    data-toggle="dropdown"><?= $this->lang->line('New Transfer'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>transactions/income"
                                                    data-toggle="dropdown"><?= $this->lang->line('Income'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>transactions/expense"
                                                    data-toggle="dropdown"><?= $this->lang->line('Expense'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>customers"
                                                    data-toggle="dropdown"><?= $this->lang->line('Clients Transactions'); ?></a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                        <i class="ft-file-text"></i><span><?php echo $this->lang->line('HRM') ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-users"></i><?php echo $this->lang->line('Employees') ?></a>
                            <ul class="dropdown-menu">
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>employee"
                                                    data-toggle="dropdown"><?php echo $this->lang->line('Employees') ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>employee/permissions"
                                                    data-toggle="dropdown"><?= $this->lang->line('Permissions'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>employee/salaries"
                                                    data-toggle="dropdown"><?= $this->lang->line('Salaries'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>employee/attendances"
                                                    data-toggle="dropdown"><?= $this->lang->line('Attendance'); ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>employee/holidays"
                                                    data-toggle="dropdown"><?= $this->lang->line('Holidays'); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li data-menu="">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>employee/departments"><i
                                        class="icon-folder"></i><?php echo $this->lang->line('Departments'); ?></a>
                        </li>
                        <li data-menu="">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>employee/payroll"><i
                                        class="icon-notebook"></i><?php echo $this->lang->line('Payroll'); ?></a>
                        </li>

                    </ul>
                </li>
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-pie-chart"></i><span><?php echo 'Data & Reports' ?></span></a>
                    <ul class="dropdown-menu">
                        <!-- <li data-menu="">
                            <a class="dropdown-item" href="<?php echo base_url(); ?>register"><i
                                        class="icon-eyeglasses"></i><?php echo 'Business Registers' ?>
                            </a>
                        </li> -->

                        <!-- <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-doc"></i><?php echo 'Statements' ?></a>
                            <ul class="dropdown-menu">

                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/accountstatement"
                                                    data-toggle="dropdown"><?= 'Account Statements' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/customerstatement"
                                                    data-toggle="dropdown"><?php echo 'Customer_Account_Statements'  ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/supplierstatement"
                                                    data-toggle="dropdown"><?php echo 'Supplier_Account_Statements' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/taxstatement"
                                                    data-toggle="dropdown"><?php echo 'TAX_Statements' ?></a>
                                </li>
                            </ul>
                        </li> -->

                        <!-- <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-bar-chart"></i><?php echo 'Graphical Reports' ?>
                            </a>
                            <ul class="dropdown-menu">

                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>chart/product_cat"
                                                    data-toggle="dropdown"><?= 'Product Categories' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>chart/trending_products"
                                                    data-toggle="dropdown"><?= 'Trending Products' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>chart/profit"
                                                    data-toggle="dropdown"><?= 'Profit' ?></a>
                                </li>

                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>chart/topcustomers"
                                                    data-toggle="dropdown"><?php echo 'Top_Customers' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>chart/incvsexp"
                                                    data-toggle="dropdown"><?php echo 'income_vs_expenses' ?></a>
                                </li>

                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>chart/income"
                                                    data-toggle="dropdown"><?= 'Income' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>chart/expenses"
                                                    data-toggle="dropdown"><?= 'Expenses' ?></a>


                            </ul>
                        </li> -->
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-bulb"></i><?php echo 'Summary & Report' ?>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/statistics"
                                                    data-toggle="dropdown"><?php echo 'Statistics' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/profitstatement"
                                                    data-toggle="dropdown"><?= 'Profit' ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/incomestatement"
                                                    data-toggle="dropdown"><?php echo 'Calculate Income'; ?></a>
                                </li>
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/expensestatement"
                                                    data-toggle="dropdown"><?php echo 'Calculate Expenses' ?></a>
                                </li> -->
                                <!-- <li data-menu=""><a class="dropdown-item" href="<?php echo base_url(); ?>reports/sales"
                                                    data-toggle="dropdown"><?php echo 'Sales' ?></a>
                                </li> -->
                                <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/products"
                                                    data-toggle="dropdown"><?php echo 'Products' ?></a>
                                </li>
                                <!-- <li data-menu=""><a class="dropdown-item"
                                                    href="<?php echo base_url(); ?>reports/commission"
                                                    data-toggle="dropdown"><?= 'Employee_Commission' ?></a>
                                </li> -->

                            </ul>
                        </li>

                    </ul>
                </li>
            <?php }
            ?>

        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- Horizontal navigation-->
<div id="c_body"></div>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">