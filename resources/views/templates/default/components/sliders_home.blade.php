<div class="mainSlider">
    <ul class="navigation">
        <li>
            <a href="#" id="slider_nav_prev">
                <i class="fas fa-angle-left"></i>
            </a>
        </li>
        <li>
            <a href="#" id="slider_nav_next">
                <i class="fas fa-angle-right"></i>
            </a>
        </li>
    </ul>
    @foreach ($sliders as $slider)
    <div class="slider-item">
        <div class="row">
            <div class="col-md-7 col-12">
                <div class="content">
                    <div class="content-inside">
                        <p>{!! html_entity_decode($slider->content) !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-12">
                <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
            </div>
        </div>
    </div>
    @endforeach
</div>