@extends('front.master)

@section('body')

    <div class="men">
        <div class="container">
            <div class="single_top">
                <div class="col-md-9 single_right">
                    <div class="grid images_3_of_2">
                        <ul id="etalage">
                            <li>
                                <a href="optionallink.html">
                                    <img class="etalage_thumb_image" src="images/s1.jpg" class="img-responsive" />
                                    <img class="etalage_source_image" src="images/s1.jpg" class="img-responsive" title="" />
                                </a>
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="images/s2.jpg" class="img-responsive" />
                                <img class="etalage_source_image" src="images/s2.jpg" class="img-responsive" title="" />
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="images/s3.jpg" class="img-responsive"  />
                                <img class="etalage_source_image" src="images/s3.jpg"class="img-responsive"  />
                            </li>
                            <li>
                                <img class="etalage_thumb_image" src="images/s4.jpg" class="img-responsive"  />
                                <img class="etalage_source_image" src="images/s4.jpg"class="img-responsive"  />
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="desc1 span_3_of_2">
                        <h1>Lorem ipsum dolor sit amet</h1>
                        <p class="m_5">Rs. 888 <span class="reducedfrom">Rs. 999</span> <a href="#">click for offer</a></p>
                        <div class="btn_form">
                            <form>
                                <input type="submit" value="buy" title="">
                            </form>
                        </div>
                        <span class="m_link"><a href="#">login to save in wishlist</a> </span>
                        <p class="m_text2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-3">
                    <!-- FlexSlider -->
                    <section class="slider_flex">
                        <div class="flexslider">
                            <ul class="slides">
                                <li><img src="images/pic4.jpg" class="img-responsive" alt=""/></li>
                                <li><img src="images/pic7.jpg" class="img-responsive" alt=""/></li>
                                <li><img src="images/pic6.jpg" class="img-responsive" alt=""/></li>
                                <li><img src="images/pic5.jpg" class="img-responsive" alt=""/></li>
                            </ul>
                        </div>
                    </section>
                    <!-- FlexSlider -->
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="toogle">
                <h2>Product Details</h2>
                <p class="m_text2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero.</p>
            </div>
            <div class="toogle">
                <h2>More Information</h2>
                <p class="m_text2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
            </div>
            <h4 class="head_single">Related Products</h4>
            <div class="span_3">
                <div class="col-sm-3 grid_1">
                    <a href="single.html">
                        <img src="images/pic9.jpg" class="img-responsive" alt=""/>
                        <h3>parum clari</h3>
                        <p>Duis autem vel eum iriure</p>
                        <h4>Rs.399</h4>
                    </a>
                </div>
                <div class="col-sm-3 grid_1">
                    <a href="single.html">
                        <img src="images/pic8.jpg" class="img-responsive" alt=""/>
                        <h3>parum clari</h3>
                        <p>Duis autem vel eum iriure</p>
                        <h4>Rs.399</h4>
                    </a>
                </div>
                <div class="col-sm-3 grid_1">
                    <a href="single.html">
                        <img src="images/pic1.jpg" class="img-responsive" alt=""/>
                        <h3>parum clari</h3>
                        <p>Duis autem vel eum iriure</p>
                        <h4>Rs.399</h4>
                    </a>
                </div>
                <div class="col-sm-3 grid_1">
                    <a href="single.html">
                        <img src="images/pic3.jpg" class="img-responsive" alt=""/>
                        <h3>parum clari</h3>
                        <p>Duis autem vel eum iriure</p>
                        <h4>Rs.399</h4>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    @endsection