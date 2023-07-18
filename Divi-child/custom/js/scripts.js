//Residential Lightbox Gallery
jQuery(document).ready(function(){
    jQuery('.residential-gallery-trigger').click(function(){
        jQuery('.residential-gallery .et_pb_gallery_item:nth-child(1) img').click();
    });
});

//Commercial Lightbox Gallery
jQuery(document).ready(function(){
    jQuery('.commercial-gallery-trigger').click(function(){
        jQuery('.commercial-gallery .et_pb_gallery_item:nth-child(1) img').click();
    });
});

//Institutional Lightbox Gallery
jQuery(document).ready(function(){
    jQuery('.institutional-gallery-trigger').click(function(){
        jQuery('.institutional-gallery .et_pb_gallery_item:nth-child(1) img').click();
    });
});