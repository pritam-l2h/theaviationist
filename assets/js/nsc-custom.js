jQuery(document).ready(function ($) {
    var timer;
    $('#s').on('keyup', function () {
        clearTimeout(timer);
        var query = $(this).val();
        timer = setTimeout(function () {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_search_params.ajaxurl,
                data: {
                    action: 'ajax_search',
                    nonce: ajax_search_params.nonce,
                    query: query,
                },
                success: function (response) {
                    $('#search-suggestions').html(response);
                },
            });
        }, 500);
    });

    $('#nsc-setting-btn').click(function(){
      $('#nsc-setting-content').toggleClass('show');
    })

    //  light and dark mode
    const isDarkMode = localStorage.getItem('darkMode');

    if (isDarkMode === null) {
      const defaultDarkModeValue = true;
      localStorage.setItem('darkMode', defaultDarkModeValue);
      $('#nsc-theme-modes').attr('checked', '');
    }

    const darkModeValue = localStorage.getItem('darkMode') === 'true';
    $('body').toggleClass('dark-mode', darkModeValue);
    $('#nsc-theme-modes').prop('checked', darkModeValue);

    $('#nsc-theme-modes').on('change', function() {
      const isChecked = $(this).prop('checked');
      $('body').toggleClass('dark-mode', isChecked);
      localStorage.setItem('darkMode', isChecked);
    });

    $('#nsc-home-tab-container').owlCarousel({
      loop:false,
      margin:10,
      nav:true,
      autoWidth:true,
      items:7,
      responsive:{
          0:{
              items:2
          },
          600:{
              items:4
          }
      }
  });

    $('.nsc-owl-carousel').owlCarousel({
        loop: true,
        margin: 24,
        nav: true,  // Ensure this is set to true
        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        items: 3.5,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2.5
            }
        }
    });


$('.multiple-items').slick({
  centerMode: true,
  centerPadding: '0px',
  slidesToShow: 3,
   arrows: true,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});



    //  copy link
    let copy_button = $('#nsc-copy-link');
    if (copy_button.length > 0) {

      $('#nsc-copy-link').click(function(){
        var url = $(this).data('url');
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(url).select();
        document.execCommand('copy');
        tempInput.remove();
        copy_button.addClass('copied');
        setTimeout(function(){
          copy_button.removeClass('copied');
        }, 2500);
      });
    }

    $('.copy-link-pop-btn').each(function() {
      $(this).click(function() {
          var container = $(this).closest('.nsc-popup-container');
          var popup = container.find('.nsc-popups');
          $('.nsc-popups').not(popup).removeClass('show');
          popup.toggleClass('show');
      });
  });

  $(document).click(function(event) {
      var target = $(event.target);
      if (!target.closest('.nsc-popup-container').length) {
          $('.nsc-popups').removeClass('show');
      }
  });

  // menu close
  $('.navbar-close').click(function() {
    $('#nsc-blog-navbar').removeClass('show');
    $('.navbar-toggler').attr('aria-expanded', 'false');
  });




    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            $.ajax({
                url: ajax_search_params.ajax_url,
                type: 'post',
                data: {
                    action: 'nsc_blog_increase_reading_count',
                    post_id: ajax_search_params.post_id
                },
                success: function(response) {
                    // console.log('Reading count increased.');
                    // console.log(response);

                }
            });
        }
    });

});


//  tab widget js
document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll('.nsc-tabs a');
    var tabContents = document.querySelectorAll('.nsc-tab-content');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            tabs.forEach(function (t) {
                t.parentElement.classList.remove('active');
            });

            tabContents.forEach(function (content) {
                content.style.display = 'none';
            });
            this.parentElement.classList.add('active');
            var targetId = this.getAttribute('href');
            document.querySelector(targetId).style.display = 'block';
        });
    });

    // Ensure the default tab is displayed
    let tabnews = document.querySelector('#nsc-news')
    if (tabnews) {
      document.querySelector('#nsc-news').style.display = 'block';
    }

    // Ensure the elements exist before adding event listeners
    var viewAllButton = document.getElementById('view-all-categories');
    var popup = document.getElementById('categories-popup');
    var closeButton = document.getElementById('close-popup');

    if (viewAllButton) {
        viewAllButton.addEventListener('click', function() {
            if (popup) {
                popup.style.display = 'block';
            }
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', function() {
            if (popup) {
                popup.style.display = 'none';
            }
        });
    }

});


jQuery(function($) {
    var page = 1;

    $('.nsc-common-btn').on('click', function(e) {
        e.preventDefault();
        var button = $(this);

        $.ajax({
            url: nsc_loadmore_params.ajaxurl,
            data: {
                action: 'nsc_load_more',
                page: page,
                posts_per_page: nsc_loadmore_params.posts_per_page,
            },
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Loading...'); // Change the button text during the AJAX call
            },
            success: function(response) {
                if (response) {
                    $('.nsc-blog-post-grid').append(response);
                    button.text('Load More');
                    page++;
                } else {
                    button.text('No more posts');
                    button.prop('disabled', true);
                }
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    var searchForm = document.getElementById('searchForm');
    var searchInput = document.getElementById('searchInput');
    var yearSelect = document.getElementById('yearSelect');
    var monthSelect = document.getElementById('monthSelect');
    var searchResults = document.getElementById('search-results');

    function performSearch() {
        // AJAX request to fetch search results
        var xhr = new XMLHttpRequest();
        var url = ajaxUrl + '?action=my_custom_search&search=' + encodeURIComponent(searchInput.value) + '&year=' + encodeURIComponent(yearSelect.value) + '&month=' + encodeURIComponent(monthSelect.value);
        xhr.open('GET', url, true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Success response
                searchResults.innerHTML = xhr.responseText;
                searchResults.style.display = xhr.responseText.trim() ? 'block' : 'none'; // Show or hide based on content
            } else {
                // Error response
                console.error('Request failed: ' + xhr.statusText);
                searchResults.style.display = 'none'; // Hide on error
            }
        };
        xhr.onerror = function() {
            // Connection error
            console.error('Request failed');
            searchResults.style.display = 'none'; // Hide on connection error
        };
        xhr.send();
    }

    searchInput.addEventListener('input', performSearch);
    yearSelect.addEventListener('change', performSearch);
    monthSelect.addEventListener('change', performSearch);

    // Initially hide the search results container
    searchResults.style.display = 'none';

    // Hide search results when clicking outside of them
    document.addEventListener('click', function(event) {
        if (!searchForm.contains(event.target)) {
            searchResults.style.display = 'none';
        }
    });

    // Show search results when interacting with the search form
    searchInput.addEventListener('focus', function() {
        if (searchResults.innerHTML.trim()) {
            searchResults.style.display = 'block';
        }
    });
    yearSelect.addEventListener('focus', function() {
        if (searchResults.innerHTML.trim()) {
            searchResults.style.display = 'block';
        }
    });
    monthSelect.addEventListener('focus', function() {
        if (searchResults.innerHTML.trim()) {
            searchResults.style.display = 'block';
        }
    });
});



jQuery(document).ready(function($) {
    $('.view-all-category-btn').click(function(e) {
        e.preventDefault();

        var button = $(this);
        var container = button.prev('.nsc-posts-cats');
        var cats_num = container.children().length + 3; // Increase by 3
        var data = {
            action: 'nsc_load_more_categories',
            cats_num: cats_num,
        };

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: data,
            success: function(response) {
                container.html(response);
                if (response.trim() == '') {
                    button.text('Show Less');
                    button.addClass('show-less-categories');
                } else {
                    button.text('Show More');
                    button.removeClass('show-less-categories');
                }
            }
        });
    });

    // Show less functionality
    $(document).on('click', '.show-less-categories', function(e) {
        e.preventDefault();

        var button = $(this);
        var container = button.prev('.nsc-posts-cats');
        var cats_num = container.children().length - 3; // Decrease by 3
        var data = {
            action: 'nsc_load_more_categories',
            cats_num: cats_num,
        };

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: data,
            success: function(response) {
                container.html(response);
                button.text('Show More');
                button.removeClass('show-less-categories');
            }
        });
    });
});


   function toggleMoreCategories() {
       console.log("hit")
    jQuery.ajax({
        url: ajaxurl, // WordPress AJAX URL
        type: 'POST',
        data: {
            action: 'load_all_taxonomies' // Action to trigger PHP function
        },
        success: function(response) {
            jQuery('.nsc-popup-content').append(response); // Append the HTML response to the popup content
            jQuery('.view-more-categories-btn').remove(); // Remove the button after loading taxonomies
        },
        error: function(error) {
            console.log(error);
        }
    });
}

