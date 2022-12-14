<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 29-Jun-18
 * Time: 9:10 AM
 */?>

<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo" data-navbar-theme="theme4">
            <a class="mobile-menu" id="mobile-collapse" style="cursor: pointer;" onclick="return void(0);">
                <i class="ti-menu" <?php  //$RunQuery->guard();?>></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a style="cursor: pointer;" onclick="return RedirectToPage('index');">
                <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" />
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>
        <i class="hide"> </i>
        <div class="navbar-container container-fluid">
            <div>
                <ul class="nav-left">
                    <li>
                        <div class="sidebar_toggle"><a style="cursor: pointer;" onclick="return void(0);"><i class="ti-menu"></i></a></div>
                    </li>


                    <li class="mega-menu-top">
                        <a style="cursor: pointer;" onclick="return void(0);">
                            Mega
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification row">
                            <li class="col-sm-3">
                                <h6 class="mega-menu-title">Popular Links </h6>
                                <ul class="mega-menu-links">
                                    <li><a href="form-elements-component.html">Form Elements </a></li>
                                    <li><a href="button.html">Buttons </a></li>
                                    <li><a href="map-google.html">Maps </a></li>
                                    <li><a href="user-card.html">Contact Cards </a></li>
                                    <li><a href="user-profile.html">User Information </a></li>
                                    <li><a href="auth-lock-screen.html">Lock Screen </a></li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <h6 class="mega-menu-title">Mailbox </h6>
                                <ul class="mega-mailbox">
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">
                                                <i class="ti-folder"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5>Data Backup </h5>
                                                <small class="text-muted">Store your data </small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">
                                                <i class="ti-headphone-alt"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5>Support </h5>
                                                <small class="text-muted">24-hour support </small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">
                                                <i class="ti-dropbox"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5>Drop-box </h5>
                                                <small class="text-muted">Store large amount of ____ in one-box only
                                                </small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="media">
                                            <div class="media-left">
                                                <i class="ti-location-pin"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5>Location </h5>
                                                <small class="text-muted">Find Your Location with ____ of use </small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-sm-3">
                                <h6 class="mega-menu-title">Gallery </h6>
                                <div class="row m-b-20">
                                    <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/01.jpg" alt="Gallery-1" />
                                    </div>
                                    <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/02.jpg" alt="Gallery-2" />
                                    </div>
                                    <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/03.jpg" alt="Gallery-3" />
                                    </div>
                                </div>
                                <div class="row m-b-20">
                                    <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/04.jpg" alt="Gallery-4" />
                                    </div>
                                    <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/05.jpg" alt="Gallery-5" />
                                    </div>
                                    <div class="col-sm-4"><img class="img-fluid img-thumbnail" src="assets/images/mega-menu/06.jpg" alt="Gallery-6" />
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm btn-block">Browse Gallery </button>
                            </li>
                            <li class="col-sm-3">
                                <h6 class="mega-menu-title">Contact Us </h6>
                                <div class="mega-menu-contact">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-3 col-form-label">Name </label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" placeholder="Artisanal kale" id="example-text-input" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-3 col-form-label">Email </label>
                                        <div class="col-9">
                                            <input class="form-control" type="email" placeholder="Enter your E-mail Id" id="example-search-input" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-3 col-form-label">Contact </label>
                                        <div class="col-9">
                                            <input class="form-control" type="number" placeholder="+91-9898989898" id="example-search-input-2" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleTextarea" class="col-3 col-form-label">Message </label>
                                        <div class="col-9">
                                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="header-notification lng-dropdown">
                        <a style="cursor: pointer;" onclick="return void(0);" id="dropdown-active-item">
                            <i class="flag-icon flag-icon-gb m-r-5"></i> English
                        </a>
                        <ul class="show-notification">
                            <li>
                                <a style="cursor: pointer;" onclick="return void(0);" data-lng="en">
                                    <i class="flag-icon flag-icon-gb m-r-5"></i> English
                                </a>
                            </li>

                            <li>
                                <a style="cursor: pointer;" onclick="return void(0);" data-lng="fr">
                                    <i class="flag-icon flag-icon-fr m-r-5"></i> French
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="header-notification">

                        <a style="cursor: pointer;" onclick="return void(0);">
                            <i class="zmdi zmdi-shopping-cart-plus"></i>
                            <span class="badge">5 </span>
                        </a>
                        <ul class="show-notification">

                            <li>
                                <h6>Invoice list </h6>
                                <label class="label label-danger">New </label>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center" src="assets/images/user.png" alt="Generic placeholder image" />
                                    <div class="media-body">
                                        <h5 class="notification-user">John Doe </h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit ____, consectetuer elit. </p>
                                        <span class="notification-time">30 minutes ago </span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center" src="assets/images/user.png" alt="Generic placeholder image" />
                                    <div class="media-body">
                                        <h5 class="notification-user">John Doe </h5>
                                        <p class="notification-msg">Lorem ipsum dolor sit ____, consectetuer elit. </p>
                                        <span class="notification-time">30 minutes ago </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li class="user-profile header-notification">
                        <a style="cursor: pointer;" onclick="return void(0);">
                            <img src="assets/images/user.png" alt="User-Profile-Image" />
                            <span>John Doe </span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a style="cursor: pointer;" onclick="return void(0);">
                                    <i class="ti-settings"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="user-profile.html">
                                    <i class="ti-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="email-inbox.html">
                                    <i class="ti-email"></i> My Messages
                                </a>
                            </li>
                            <li>
                                <a href="auth-lock-screen.html">
                                    <i class="ti-lock"></i> Lock Screen
                                </a>
                            </li>
                            <li>
                                <a style="cursor: pointer;" onclick="return RedirectToPage('logOut')" >
                                    <i class="ti-layout-sidebar-left"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
