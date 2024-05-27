// JavaScript for handling the category popup and "View More Categories" functionality

function openCategoryPopup() {
    document.getElementById('nsc-category-popup').style.display = 'block';
}

function closeCategoryPopup() {
    document.getElementById('nsc-category-popup').style.display = 'none';
}

function toggleMoreCategories() {
    const moreCategoriesBtn = document.querySelector('.view-more-categories-btn');
    const popupContent = document.querySelector('.nsc-popup-content');
    
    if (popupContent.classList.contains('expanded')) {
        popupContent.classList.remove('expanded');
        moreCategoriesBtn.innerHTML = 'View More Categories';
    } else {
        popupContent.classList.add('expanded');
        moreCategoriesBtn.innerHTML = 'View Fewer Categories';
        
        // Perform AJAX request to fetch more categories
        jQuery.ajax({
            url: ajax_object.ajax_url, // Ensure this is correctly set
            type: 'POST',
            data: {
                action: 'fetch_more_categories'
            },
            success: function(response) {
                // Append the response (more categories) to the popup content
                jQuery('.nsc-popup-content').append(response);
            },
            error: function(error) {
                console.log('Error fetching more categories:', error);
            }
        });
    }
}

// Ensure this code runs after the document is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.nsc-popup-close').addEventListener('click', closeCategoryPopup);
    document.querySelector('.nsc-view-all-button').addEventListener('click', openCategoryPopup);
    document.querySelector('.view-more-categories-btn').addEventListener('click', toggleMoreCategories);
});
