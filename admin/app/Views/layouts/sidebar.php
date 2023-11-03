    <!-- BEGIN #sidebar -->
    <div id="sidebar" class="app-sidebar">
        <!-- BEGIN scrollbar -->
        <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
            <!-- BEGIN menu -->
            <div class="menu">
                <div class="menu-header">Navigation</div>
                <div class="menu-item active">
                    <a href="index.html" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item has-sub">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa fa-shopping-bag"></i>
                            <!-- <span class="menu-icon-label">6</span> -->
                        </span>
                        <span class="menu-text">Inventory</span>
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="email_inbox.html" class="menu-link">
                                <span class="menu-text">Inventory In</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="email_compose.html" class="menu-link">
                                <span class="menu-text">Inventory Out</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-divider"></div>
                <div class="menu-header">Components</div>
                <div class="menu-item">
                    <a href="<?= URL?>/uom" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">UOM</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/variant" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-cube"></i></span>
                        <span class="menu-text">Variants</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/group" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-object-group"></i></span>
                        <span class="menu-text">Groups</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/location" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-map-marker"></i></span>
                        <span class="menu-text">Locations</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= URL?>/category" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-list-alt"></i></span>
                        <span class="menu-text">Categories</span>
                    </a>
                </div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-wallet"></i>
                        </div>
                        <div class="menu-text d-flex align-items-center">Products</div> 
                        <span class="menu-caret"><b class="caret"></b></span>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="<?= URL?>/product" target="_blank" class="menu-link">
                                <div class="menu-text">Product List</div>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="<?= URL?>/product/add" target="_blank" class="menu-link">
                                <div class="menu-text">Add Product</div>
                            </a>
                        </div>
                    </div>
                </div>
                

                <div class="menu-divider"></div>
                <div class="menu-header">Users</div>
                <div class="menu-item">
                    <a href="profile.html" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-user-circle"></i></span>
                        <span class="menu-text">Profile</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="calendar.html" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-calendar"></i></span>
                        <span class="menu-text">Calendar</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="settings.html" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-cog"></i></span>
                        <span class="menu-text">Settings</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="helper.html" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-question-circle"></i></span>
                        <span class="menu-text">Helper</span>
                    </a>
                </div>
                <div class="p-3 px-4 mt-auto hide-on-minified">
                    <a href="https://seantheme.com/studio/documentation/index.html" class="btn btn-secondary d-block w-100 fw-600 rounded-pill">
                        <i class="fa fa-code-branch me-1 ms-n1 opacity-5"></i> Documentation
                    </a>
                </div>
            </div>
            <!-- END menu -->
        </div>
        <!-- END scrollbar -->
        
        <!-- BEGIN mobile-sidebar-backdrop -->
        <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
        <!-- END mobile-sidebar-backdrop -->
    </div>
    <!-- END #sidebar -->