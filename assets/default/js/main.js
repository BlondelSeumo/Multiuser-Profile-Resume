!function(a) {
    "use strict";
    a(document).ready(function() {
        a("#preloader").delay(500).fadeOut("slow"), jQuery("#grid-container").on("initComplete.cbp", function() {
            // a("#ajax-tab-container").length&&a("#ajax-tab-container").easytabs( {
            //     tabs: "header nav ul li"
            // }
            // )
        }
        ), function() {
            a('<div class="menuout"><div class="menuin"><ul class="tabs"></ul></div></div>').appendTo("nav");
            var t=a(".tabs").html();
            a(".menuout .menuin .tabs").append(t), a(".menuin").hide()
        }
        (), a(".hamburger").on("click", function() {
            a(".menuin").slideToggle()
        }
        ), a(".menuout").on("click", function() {
            a(".menuin").slideUp()
        }
        ), a(".owl-carousel").length&&a(".owl-carousel").each(function() {
            a(this).owlCarousel( {
                items: a(this).data("items")?a(this).data("items"): 3, autoPlay: a(this).data("autoplay")?a(this).data("autoplay"): 2500, pagination: !!a(this).data("pagination")&&a(this).data("pagination"), itemsDesktop: [1199, 3], itemsDesktopSmall: [979, 3]
            }
            )
        }
        ), a("#grid-container").cubeportfolio( {
            layoutMode:"grid", filters:"#filters-container", gridAdjustment:"responsive", animationType:"skew", defaultFilter:"*", gapVertical:0, gapHorizontal:0, singlePageAnimation:"fade", mediaQueries:[ {
                width: 700, cols: 3
            }
            , {
                width:480, cols:2, options: {
                    caption: "", gapHorizontal: 30, gapVertical: 20
                }
            }
            , {
                width:320, cols:1, options: {
                    caption: "", gapHorizontal: 50
                }
            }
            ], singlePageCallback:function(t, i) {
                var o=this;
                a.ajax( {
                    url: t, type: "GET", dataType: "html", timeout: 3e4
                }
                ).done(function(a) {
                    o.updateSinglePage(a)
                }
                ).fail(function() {
                    o.updateSinglePage("AJAX Error! Please refresh the page!")
                }
                )
            }
            , plugins: {
                loadMore: {
                    element: "#js-loadMore-agency", action: "click", loadItems: 3
                }
            }
        }
        ), a("#grid-blog").cubeportfolio( {
            layoutMode:"grid", gridAdjustment:"responsive", gapVertical:0, gapHorizontal:0, mediaQueries:[ {
                width: 700, cols: 3
            }
            , {
                width:480, cols:2, options: {
                    caption: "", gapHorizontal: 30, gapVertical: 20
                }
            }
            , {
                width:320, cols:1, options: {
                    caption: "", gapHorizontal: 50
                }
            }
            ], plugins: {
                loadMore: {
                    element: "#load-posts", action: "click", loadItems: 3
                }
            }
        }
        ), a("#widget-gallery").cubeportfolio( {
            layoutMode:"grid", gridAdjustment:"responsive", gapVertical:0, gapHorizontal:0, mediaQueries:[ {
                width: 700, cols: 4
            }
            , {
                width:480, cols:2, options: {
                    caption: "", gapHorizontal: 30, gapVertical: 20
                }
            }
            , {
                width:320, cols:1, options: {
                    caption: "", gapHorizontal: 50
                }
            }
            ]
        }
        )
    }
    )
}

(jQuery);