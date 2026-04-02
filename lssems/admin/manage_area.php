<?php
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM areas where id={$_GET['id']}")->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<style>
    /* Professional Form Styling */
    .area-form-container {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border-radius: 20px;
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
        padding: 20px 25px;
        border-bottom: 3px solid #c0392b;
        margin-bottom: 25px;
    }
    
    .form-header h4 {
        margin: 0;
        color: white;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-header h4 i {
        color: #c0392b;
        font-size: 24px;
    }
    
    .form-header p {
        margin: 5px 0 0;
        color: #aaa;
        font-size: 13px;
    }
    
    .form-body {
        padding: 0 25px 25px;
    }
    
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }
    
    .form-group label i {
        color: #c0392b;
        margin-right: 8px;
    }
    
    .required-star {
        color: #c0392b;
        margin-left: 4px;
    }
    
    .input-group-custom {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        color: #c0392b;
        z-index: 1;
        font-size: 16px;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }
    
    .form-control-custom:focus {
        border-color: #c0392b;
        box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.1);
        outline: none;
    }
    
    .form-control-custom:hover {
        border-color: #c0392b;
    }
    
    .character-counter {
        position: absolute;
        right: 15px;
        bottom: 12px;
        font-size: 11px;
        color: #999;
        background: white;
        padding: 2px 6px;
        border-radius: 20px;
    }
    
    /* Slug Preview */
    .slug-preview {
        margin-top: 8px;
        padding: 8px 12px;
        background: #f5f5f5;
        border-radius: 8px;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .slug-preview i {
        color: #c0392b;
    }
    
    .slug-preview span {
        color: #666;
        font-family: monospace;
    }
    
    .location-link {
        color: #c0392b;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-left: auto;
        padding: 4px 12px;
        background: rgba(192, 57, 43, 0.1);
        border-radius: 20px;
        transition: all 0.3s ease;
    }
    
    .location-link:hover {
        background: #c0392b;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Map Preview */
    .map-preview {
        margin-top: 15px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: none;
    }
    
    .map-preview iframe {
        width: 100%;
        height: 300px;
        border: none;
    }
    
    /* Country Grid */
    .country-grid {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 12px;
        border-left: 3px solid #c0392b;
    }
    
    .country-grid h6 {
        margin: 0 0 15px;
        font-size: 14px;
        font-weight: 700;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .country-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 10px;
        max-height: 300px;
        overflow-y: auto;
        padding-right: 10px;
    }
    
    .country-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: white;
        border-radius: 10px;
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid #e0e0e0;
    }
    
    .country-item:hover {
        border-color: #c0392b;
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(192, 57, 43, 0.1);
    }
    
    .country-flag {
        font-size: 24px;
    }
    
    .country-info {
        flex: 1;
    }
    
    .country-name {
        font-weight: 600;
        font-size: 13px;
        color: #333;
    }
    
    .country-link {
        font-size: 11px;
        color: #c0392b;
        text-decoration: none;
        display: block;
        margin-top: 2px;
    }
    
    .country-link i {
        font-size: 10px;
    }
    
    .country-link:hover {
        text-decoration: underline;
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }
    
    .btn-custom {
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-save {
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        color: white;
        flex: 1;
        justify-content: center;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(192, 57, 43, 0.3);
    }
    
    .btn-cancel {
        background: #6c757d;
        color: white;
        flex: 1;
        justify-content: center;
    }
    
    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
    
    .btn-delete {
        background: #dc3545;
        color: white;
        justify-content: center;
    }
    
    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-2px);
    }
    
    /* Loading State */
    .btn-loading {
        opacity: 0.7;
        cursor: not-allowed;
    }
    
    .spinner-sm {
        display: inline-block;
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* Validation Styles */
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 11px;
        margin-top: 5px;
        display: block;
    }
    
    /* Toast Notification */
    .toast-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 9999;
        animation: slideInRight 0.3s ease;
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .toast-success {
        border-left: 4px solid #28a745;
    }
    
    .toast-error {
        border-left: 4px solid #dc3545;
    }
    
    .toast-success i {
        color: #28a745;
        font-size: 18px;
    }
    
    .toast-error i {
        color: #dc3545;
        font-size: 18px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .form-body {
            padding: 0 20px 20px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn-custom {
            width: 100%;
        }
        
        .country-list {
            grid-template-columns: 1fr;
        }
        
        .slug-preview {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .location-link {
            margin-left: 0;
        }
    }
    
    /* Custom Scrollbar for Country List */
    .country-list::-webkit-scrollbar {
        width: 6px;
    }
    
    .country-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .country-list::-webkit-scrollbar-thumb {
        background: #c0392b;
        border-radius: 10px;
    }
</style>

<div class="area-form-container">
    <div class="form-header">
        <h4>
            <i class="fas fa-map-marker-alt"></i>
            <?php echo isset($id) ? 'Edit Area' : 'Add New Area' ?>
        </h4>
        <p><?php echo isset($id) ? 'Update the area details below' : 'Fill in the details to add a new service area' ?></p>
    </div>
    
    <div class="form-body">
        <form action="" id="manage-area">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            
            <div class="form-group">
                <label for="area">
                    <i class="fas fa-location-dot"></i> Area/City/Country Name <span class="required-star">*</span>
                </label>
                <div class="input-group-custom">
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <input type="text" class="form-control-custom" name="area" id="area" 
                           value="<?php echo isset($area) ? htmlspecialchars($area) : '' ?>"
                           placeholder="e.g., New York, London, Tokyo, Paris"
                           maxlength="100" required>
                    <span class="character-counter"><span id="charCount">0</span>/100</span>
                </div>
                <div class="slug-preview" id="slugPreview" style="display: none;">
                    <i class="fas fa-link"></i>
                    <span>Location Link: <strong id="slugValue"></strong></span>
                    <a href="#" id="locationLinkBtn" class="location-link" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View on Map
                    </a>
                </div>
                <div class="invalid-feedback" id="areaError"></div>
            </div>
            
            <!-- Map Preview -->
            <div class="map-preview" id="mapPreview">
                <iframe id="mapFrame" src="" title="Location Map"></iframe>
            </div>
            
            <!-- 20 Countries with Location Links -->
            <div class="country-grid">
                <h6>
                    <i class="fas fa-globe-americas"></i> 
                    Popular Locations (Click to Select)
                    <span style="font-size: 11px; color: #999; margin-left: auto;">20+ Countries</span>
                </h6>
                <div class="country-list" id="countryList">
                    <?php
                    // Array of 20 countries with flags, names, and Google Maps links
                    $countries = [
                        ['flag' => '🇺🇸', 'name' => 'United States', 'city' => 'New York', 'link' => 'https://www.google.com/maps/search/New+York,+USA'],
                        ['flag' => '🇬🇧', 'name' => 'United Kingdom', 'city' => 'London', 'link' => 'https://www.google.com/maps/search/London,+UK'],
                        ['flag' => '🇨🇦', 'name' => 'Canada', 'city' => 'Toronto', 'link' => 'https://www.google.com/maps/search/Toronto,+Canada'],
                        ['flag' => '🇦🇺', 'name' => 'Australia', 'city' => 'Sydney', 'link' => 'https://www.google.com/maps/search/Sydney,+Australia'],
                        ['flag' => '🇩🇪', 'name' => 'Germany', 'city' => 'Berlin', 'link' => 'https://www.google.com/maps/search/Berlin,+Germany'],
                        ['flag' => '🇫🇷', 'name' => 'France', 'city' => 'Paris', 'link' => 'https://www.google.com/maps/search/Paris,+France'],
                        ['flag' => '🇯🇵', 'name' => 'Japan', 'city' => 'Tokyo', 'link' => 'https://www.google.com/maps/search/Tokyo,+Japan'],
                        ['flag' => '🇮🇳', 'name' => 'India', 'city' => 'Mumbai', 'link' => 'https://www.google.com/maps/search/Mumbai,+India'],
                        ['flag' => '🇮🇹', 'name' => 'Italy', 'city' => 'Rome', 'link' => 'https://www.google.com/maps/search/Rome,+Italy'],
                        ['flag' => '🇧🇷', 'name' => 'Brazil', 'city' => 'São Paulo', 'link' => 'https://www.google.com/maps/search/Sao+Paulo,+Brazil'],
                        ['flag' => '🇪🇸', 'name' => 'Spain', 'city' => 'Madrid', 'link' => 'https://www.google.com/maps/search/Madrid,+Spain'],
                        ['flag' => '🇲🇽', 'name' => 'Mexico', 'city' => 'Mexico City', 'link' => 'https://www.google.com/maps/search/Mexico+City,+Mexico'],
                        ['flag' => '🇳🇱', 'name' => 'Netherlands', 'city' => 'Amsterdam', 'link' => 'https://www.google.com/maps/search/Amsterdam,+Netherlands'],
                        ['flag' => '🇸🇪', 'name' => 'Sweden', 'city' => 'Stockholm', 'link' => 'https://www.google.com/maps/search/Stockholm,+Sweden'],
                        ['flag' => '🇨🇭', 'name' => 'Switzerland', 'city' => 'Zurich', 'link' => 'https://www.google.com/maps/search/Zurich,+Switzerland'],
                        ['flag' => '🇸🇬', 'name' => 'Singapore', 'city' => 'Singapore', 'link' => 'https://www.google.com/maps/search/Singapore'],
                        ['flag' => '🇦🇪', 'name' => 'UAE', 'city' => 'Dubai', 'link' => 'https://www.google.com/maps/search/Dubai,+UAE'],
                        ['flag' => '🇿🇦', 'name' => 'South Africa', 'city' => 'Cape Town', 'link' => 'https://www.google.com/maps/search/Cape+Town,+South+Africa'],
                        ['flag' => '🇰🇷', 'name' => 'South Korea', 'city' => 'Seoul', 'link' => 'https://www.google.com/maps/search/Seoul,+South+Korea'],
                        ['flag' => '🇳🇿', 'name' => 'New Zealand', 'city' => 'Auckland', 'link' => 'https://www.google.com/maps/search/Auckland,+New+Zealand']
                    ];
                    
                    foreach($countries as $country):
                    ?>
                    <div class="country-item" data-name="<?php echo $country['name']; ?>" data-city="<?php echo $country['city']; ?>" data-link="<?php echo $country['link']; ?>">
                        <div class="country-flag"><?php echo $country['flag']; ?></div>
                        <div class="country-info">
                            <div class="country-name"><?php echo $country['name']; ?> - <?php echo $country['city']; ?></div>
                            <a href="<?php echo $country['link']; ?>" class="country-link" target="_blank">
                                <i class="fas fa-map-marker-alt"></i> View Location
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-custom btn-save" id="saveBtn">
                    <i class="fas fa-save"></i> 
                    <span id="saveText"><?php echo isset($id) ? 'Update Area' : 'Save Area' ?></span>
                    <span id="saveSpinner" class="spinner-sm" style="display: none;"></span>
                </button>
                <button type="button" class="btn-custom btn-cancel" onclick="window.location.href='index.php?page=areas'">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <?php if(isset($id)): ?>
                <button type="button" class="btn-custom btn-delete" onclick="deleteArea(<?php echo $id ?>)">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){
    // Character counter
    function updateCharCount() {
        var length = $('#area').val().length;
        $('#charCount').text(length);
        
        if(length > 90) {
            $('#charCount').css('color', '#ff9800');
        } else if(length > 95) {
            $('#charCount').css('color', '#dc3545');
        } else {
            $('#charCount').css('color', '#999');
        }
    }
    
    // Generate Google Maps search URL
    function generateMapLink(location) {
        return 'https://www.google.com/maps/search/' + encodeURIComponent(location);
    }
    
    // Update slug preview and map link
    function updateSlugPreview() {
        var area = $('#area').val();
        if(area.length > 0) {
            var slug = generateMapLink(area);
            $('#slugValue').text(slug);
            $('#locationLinkBtn').attr('href', slug);
            $('#locationLinkBtn').attr('onclick', 'window.open(this.href, "_blank"); return false;');
            $('#slugPreview').slideDown(200);
            
            // Show map preview
            $('#mapFrame').attr('src', 'https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=' + encodeURIComponent(area));
            $('#mapPreview').slideDown(200);
        } else {
            $('#slugPreview').slideUp(200);
            $('#mapPreview').slideUp(200);
        }
    }
    
    // Validate area name
    function validateArea() {
        var area = $('#area').val().trim();
        var isValid = true;
        
        if(area === '') {
            $('#areaError').text('Area name is required');
            $('#area').addClass('is-invalid');
            isValid = false;
        } else if(area.length < 3) {
            $('#areaError').text('Area name must be at least 3 characters');
            $('#area').addClass('is-invalid');
            isValid = false;
        } else if(area.length > 100) {
            $('#areaError').text('Area name must not exceed 100 characters');
            $('#area').addClass('is-invalid');
            isValid = false;
        } else {
            $('#area').removeClass('is-invalid');
            $('#areaError').text('');
        }
        
        return isValid;
    }
    
    // Auto-capitalize first letter of each word
    function capitalizeWords(str) {
        return str.replace(/\b\w/g, function(l) { return l.toUpperCase(); });
    }
    
    // Input event handlers
    $('#area').on('input', function() {
        updateCharCount();
        updateSlugPreview();
        validateArea();
    });
    
    $('#area').on('blur', function() {
        var val = $(this).val().trim();
        if(val.length > 0) {
            $(this).val(capitalizeWords(val));
            updateSlugPreview();
        }
        validateArea();
    });
    
    // Country item click handler
    $('.country-item').click(function() {
        var city = $(this).data('city');
        var country = $(this).data('name');
        var fullLocation = city + ', ' + country;
        var locationLink = $(this).data('link');
        
        $('#area').val(fullLocation);
        updateCharCount();
        updateSlugPreview();
        validateArea();
        
        showToast('Selected: ' + fullLocation, 'success');
    });
    
    // Initialize
    updateCharCount();
    updateSlugPreview();
    
    // Form submission
    $('#manage-area').submit(function(e){
        e.preventDefault();
        
        if(!validateArea()) {
            showToast('Please enter a valid area/location name', 'error');
            return false;
        }
        
        var $btn = $('#saveBtn');
        var $saveText = $('#saveText');
        var $spinner = $('#saveSpinner');
        
        // Show loading state
        $btn.addClass('btn-loading');
        $saveText.text('Saving...');
        $spinner.show();
        
        $.ajax({
            url: 'ajax.php?action=save_area',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp == 1){
                    showToast('Area saved successfully!', 'success');
                    setTimeout(function(){
                        window.location.href = 'index.php?page=areas';
                    }, 1500);
                } else if(resp == 2){
                    showToast('Area name already exists!', 'error');
                    $('#area').addClass('is-invalid');
                    $('#areaError').text('This area already exists');
                } else {
                    showToast('Error saving area. Please try again.', 'error');
                }
                
                // Reset button
                $btn.removeClass('btn-loading');
                $saveText.text('<?php echo isset($id) ? "Update Area" : "Save Area" ?>');
                $spinner.hide();
            },
            error: function(xhr, status, error){
                showToast('Connection error. Please try again.', 'error');
                $btn.removeClass('btn-loading');
                $saveText.text('<?php echo isset($id) ? "Update Area" : "Save Area" ?>');
                $spinner.hide();
            }
        });
    });
    
    // Show toast notification
    function showToast(message, type) {
        var toastHtml = `
            <div class="toast-custom toast-${type}">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        $('body').append(toastHtml);
        
        setTimeout(function() {
            $('.toast-custom').fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }
});

// Delete area function
function deleteArea(id) {
    if(confirm('Are you sure you want to delete this area? This action cannot be undone.')) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_area',
            method: 'POST',
            data: {id: id},
            success: function(resp){
                if(resp == 1){
                    alert_toast('Area deleted successfully', 'success');
                    setTimeout(function(){
                        location.href = 'index.php?page=areas';
                    }, 1500);
                } else {
                    alert_toast('Error deleting area', 'error');
                }
                end_load();
            },
            error: function(){
                alert_toast('Connection error', 'error');
                end_load();
            }
        });
    }
}
</script>