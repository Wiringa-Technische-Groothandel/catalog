<h3 class="underline">Filters</h3>

<div class="row">
    <div id="brand-filter-container" class="col-sm-4">
        @include('catalog::assortment.filters.brand')
    </div>

    <div id="series-filter-container" class="col-sm-4">
        @include('catalog::assortment.filters.series')
    </div>

    <div id="type-filter-container" class="col-sm-4">
        @include('catalog::assortment.filters.type')
    </div>
</div>

<hr />