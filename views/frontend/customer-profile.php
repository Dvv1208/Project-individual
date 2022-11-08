<div class="products_pager form-inline flex-md-nowrap justify-content-between justify-content-md-center">


    <form method="get" class="o_wsale_products_searchbar_form w-100 w-md-auto mt-2" action="/shop">
        <div role="search" class="input-group">

            <input type="search" name="search" class="search-query form-control oe_search_box" data-limit="5" data-display-description="true" data-display-price="true" data-display-image="true" placeholder="Search..." value="" autocomplete="off">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary oe_search_button" aria-label="Search" title="Search"><i class="fa fa-search"></i></button>
            </div>
        </div>

        <input name="order" type="hidden" class="o_wsale_search_order_by" value="">
    </form>
    <div class="dropdown mt-2 ml-md-2">

        <a role="button" href="#" class="dropdown-toggle btn btn-secondary" data-toggle="dropdown">
            VNĐ
        </a>
        <div class="dropdown-menu" role="menu">

            <a role="menuitem" class="dropdown-item" href="/shop/change_pricelist/1">
                <span class="switcher_pricelist" data-pl_id="1">Public Pricelist</span>
            </a>

            <a role="menuitem" class="dropdown-item" href="/shop/change_pricelist/11">
                <span class="switcher_pricelist" data-pl_id="11">VNĐ</span>
            </a>

        </div>
    </div>


    <ul class=" pagination m-0 mt-2 ml-md-2">
        <li class="page-item disabled">
            <a class="page-link ">Prev</a>
        </li>

        <li class="page-item active"> <a href="/shop" class="page-link ">1</a></li>

        <li class="page-item "> <a href="/shop/page/2" class="page-link ">2</a></li>

        <li class="page-item ">
            <a href="/shop/page/2" class="page-link ">Next</a>
        </li>
    </ul>

    <div class="btn-group btn-group-toggle mt-2 ml-md-2 d-none d-sm-inline-flex o_wsale_apply_layout" data-toggle="buttons">
        <label title="Grid" class="btn btn-secondary active fa fa-th-large o_wsale_apply_grid">
            <input type="radio" name="wsale_products_layout" checked="checked">
        </label>
        <label title="List" class="btn btn-secondary  fa fa-th-list o_wsale_apply_list">
            <input type="radio" name="wsale_products_layout">
        </label>
    </div>
    <div class="dropdown mt-2 ml-md-2 dropdown_sorty_by">
        <a role="button" href="#" class="dropdown-toggle btn btn-secondary" data-toggle="dropdown">
            <span class="d-none d-lg-inline">

                Sort by

            </span>
            <i class="fa fa-sort-amount-asc d-lg-none"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" role="menu">

            <a role="menuitem" rel="noindex,nofollow" class="dropdown-item" href="/shop?order=list_price+desc">
                <span>Catalog price: High to Low</span>
            </a>

            <a role="menuitem" rel="noindex,nofollow" class="dropdown-item" href="/shop?order=list_price+asc">
                <span>Catalog price: Low to High</span>
            </a>

            <a role="menuitem" rel="noindex,nofollow" class="dropdown-item" href="/shop?order=name+asc">
                <span>Name: A to Z</span>
            </a>

            <a role="menuitem" rel="noindex,nofollow" class="dropdown-item" href="/shop?order=name+desc">
                <span>Name: Z to A</span>
            </a>

        </div>
    </div>

</div>