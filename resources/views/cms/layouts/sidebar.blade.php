    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="{{ (Route::current()->getName() == 'cms.index') ? 'active' : '' }}"><a href="{{getenv("CMS_PATH")}}">Overview <span class="sr-only">(current)</span></a></li>
			<li class="{{ (str_contains(Route::current()->getName(), 'regions')) ? 'active' : '' }}"><a href="{{getenv("CMS_PATH")}}/regions">Regions</a></li>
			<li class="{{ (str_contains(Route::current()->getName(), 'cities')) ? 'active' : '' }}"><a href="{{getenv("CMS_PATH")}}/city">Cities</a></li>
            <!--<li>
                <a href="#sublist-1" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu">Item 1 <i class="pull-right glyphicon glyphicon-chevron-down"></i></a>
                <div class="collapse" id="sublist-1">
                    <a href="" class="list-group-item">Subitem 1.1</a>
                    <a href="" class="list-group-item">Subitem 1.2</a>
                    <a href="" class="list-group-item">Subitem 1.3</a>
                </div>
            </li>-->
        </ul>
    </div>