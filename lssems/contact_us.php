<div class="col-lg-12">
    <style>
        /* Professional Contact Page Styles */
        .contact-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }
        
        .contact-header h2 {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
        }
        
        .contact-header p {
            color: #666;
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .contact-header .underline {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #c0392b, #e74c3c);
            margin: 20px auto 0;
            border-radius: 2px;
        }
        
        /* Contact Info Cards */
        .contact-info-card {
            background: white;
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .contact-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #c0392b, #e74c3c);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .contact-info-card:hover::before {
            transform: scaleX(1);
        }
        
        .contact-info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(192, 57, 43, 0.15);
        }
        
        .contact-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.3s ease;
        }
        
        .contact-info-card:hover .contact-icon {
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(192, 57, 43, 0.3);
        }
        
        .contact-icon i {
            font-size: 35px;
            color: white;
        }
        
        .contact-info-card h4 {
            font-size: 18px;
            font-weight: 600;
            color: #c0392b;
            margin-bottom: 10px;
        }
        
        .contact-info-card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 0;
            word-break: break-word;
        }
        
        /* Message Form Card */
        .message-form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 30px;
        }
        
        .form-header {
            background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
            padding: 25px 30px;
            border-bottom: 3px solid #c0392b;
        }
        
        .form-header h3 {
            color: white;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        
        .form-header p {
            color: #aaa;
            margin: 5px 0 0;
            font-size: 14px;
        }
        
        .form-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-group label i {
            color: #c0392b;
            margin-right: 8px;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .form-control:focus {
            border-color: #c0392b;
            box-shadow: 0 0 0 0.2rem rgba(192, 57, 43, 0.1);
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }
        
        .btn-send-message {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border: none;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-send-message:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(192, 57, 43, 0.3);
        }
        
        /* Service Categories Section - Enhanced */
        .services-section {
            margin-top: 60px;
            padding-top: 40px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 30px;
            padding: 40px;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-title h3 {
            font-size: 36px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 15px;
        }
        
        .section-title h3 i {
            color: #c0392b;
            margin-right: 10px;
        }
        
        .section-title p {
            color: #666;
            font-size: 16px;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .service-category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .service-category-item {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            position: relative;
        }
        
        .service-category-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(192, 57, 43, 0.2);
        }
        
        .service-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .service-category-item:hover .service-image {
            transform: scale(1.05);
        }
        
        .service-content {
            padding: 20px;
            position: relative;
        }
        
        .service-category-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -40px auto 15px;
            position: relative;
            z-index: 1;
            box-shadow: 0 5px 15px rgba(192, 57, 43, 0.3);
        }
        
        .service-category-icon i {
            font-size: 28px;
            color: white;
        }
        
        .service-category-item h5 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 15px 0 10px;
            text-align: center;
        }
        
        .service-description {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: center;
            min-height: 60px;
        }
        
        .service-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
            margin-top: 10px;
        }
        
        .service-price {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .service-link {
            color: #c0392b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .service-link:hover {
            color: #e74c3c;
            text-decoration: underline;
        }
        
        .service-link i {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }
        
        .service-link:hover i {
            transform: translateX(5px);
        }
        
        .service-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(192, 57, 43, 0.9);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            z-index: 2;
            backdrop-filter: blur(5px);
        }
        
        /* Modal Styles for Service Details */
        .service-modal-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        
        .service-modal-header {
            background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
            color: white;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        
        .service-modal-body {
            padding: 25px;
        }
        
        .service-features {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .service-features li {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .service-features li i {
            color: #c0392b;
            width: 20px;
        }
        
        .btn-book-now {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-book-now:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(192, 57, 43, 0.3);
        }
        
        /* Loading Spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .contact-header h2 {
                font-size: 28px;
            }
            
            .form-body {
                padding: 20px;
            }
            
            .service-category-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .services-section {
                padding: 20px;
            }
            
            .section-title h3 {
                font-size: 28px;
            }
        }
    </style>

    <!-- Header Section -->
    <div class="contact-header">
        <h2><i class="fas fa-envelope-open-text"></i> Contact Us</h2>
        <p>Have questions? We're here to help! Send us a message and we'll respond within 24 hours.</p>
        <div class="underline"></div>
    </div>

    <!-- Contact Info Cards -->
    <div class="row">
        <div class="col-md-4">
            <div class="contact-info-card">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h4>Email Us</h4>
                <p><?php echo htmlspecialchars($_SESSION['system']['email'] ?? 'admin@lssems.com') ?></p>
                <small style="color: #999;">We respond within 24h</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-info-card">
                <div class="contact-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h4>Call Us</h4>
                <p><?php echo htmlspecialchars($_SESSION['system']['contact'] ?? '+1 000 000 0000') ?></p>
                <small style="color: #999;">Mon-Fri, 9am-6pm</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-info-card">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h4>Visit Us</h4>
                <p><?php echo htmlspecialchars($_SESSION['system']['address'] ?? 'Your Address Here') ?></p>
                <small style="color: #999;">Get directions</small>
            </div>
        </div>
    </div>

    <!-- Message Form -->
    <div class="message-form-card">
        <div class="form-header">
            <h3><i class="fas fa-paper-plane"></i> Send Us a Message</h3>
            <p>We'd love to hear from you! Fill out the form below and we'll get back to you shortly.</p>
        </div>
        <div class="form-body">
            <div id="msg-alert"></div>
            
            <form id="contactForm" autocomplete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Full Name </label>
                            <input type="text" class="form-control" name="sender_name" 
                                   placeholder="Enter your full name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> Email Address </label>
                            <input type="email" class="form-control" name="sender_email" 
                                   placeholder="your@email.com" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Subject </label>
                    <input type="text" class="form-control" name="subject" 
                           placeholder="What is this regarding?" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Message </label>
                    <textarea class="form-control" name="message" rows="5" 
                              placeholder="Please provide as much detail as possible..." 
                              required></textarea>
                    <small class="text-muted" style="display: block; margin-top: 5px;">
                        <i class="fas fa-info-circle"></i> 
                    </small>
                </div>
                
                <button type="submit" class="btn btn-send-message" id="sendBtn">
                    <span id="sendTxt"><i class="fas fa-paper-plane"></i> Send Message</span>
                    <span id="sendSpin" class="d-none">
                        <span class="spinner-border spinner-border-sm"></span> Sending...
                    </span>
                </button>
            </form>
        </div>
    </div>

    <!-- Service Categories Section with Images and Descriptions -->
    <div class="services-section">
        <div class="section-title">
            <h3><i class="fas fa-th-large"></i> Our Premium Services</h3>
            <p>Discover our wide range of professional services with detailed descriptions, pricing, and more</p>
        </div>
        <div class="service-category-grid" id="serviceCategories">
            <?php
            // Get service categories with enhanced data
            $services_query = $conn->query("SELECT * FROM services ORDER BY service ASC");
            $service_count = $services_query->num_rows;
            
            // Professional service images and descriptions
            $service_images = [
                'web development' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Web+Development',
                'graphic design' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Graphic+Design',
                'digital marketing' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Digital+Marketing',
                'mobile app' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Mobile+Apps',
                'database' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Database',
                'cloud services' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Cloud+Services',
                'cybersecurity' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Cyber+Security',
                'photography' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Photography',
                'video editing' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Video+Editing',
                'music production' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Music+Production',
                'writing' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Writing',
                'education' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Education',
                'repair services' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Repair+Services',
                'delivery' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Delivery',
                'beauty' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Beauty',
                'cleaning' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Cleaning',
                'consulting' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Consulting',
                'training' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Training',
                'it support' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=IT+Support',
                'networking' => 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=Networking'
            ];
            
            $service_descriptions = [
                'web development' => 'Professional website development using latest technologies. Responsive design, e-commerce solutions, and custom web applications.',
                'graphic design' => 'Creative graphic design services including logos, branding, social media graphics, and print materials.',
                'digital marketing' => 'Boost your online presence with SEO, social media marketing, email campaigns, and PPC advertising.',
                'mobile app' => 'Native and cross-platform mobile app development for iOS and Android devices.',
                'database' => 'Database design, optimization, management, and migration services.',
                'cloud services' => 'Cloud infrastructure setup, migration, and management on AWS, Azure, and Google Cloud.',
                'cybersecurity' => 'Comprehensive security assessments, penetration testing, and security implementation.',
                'photography' => 'Professional photography services for events, products, portraits, and commercial use.',
                'video editing' => 'Professional video editing, post-production, and motion graphics services.',
                'music production' => 'Music composition, mixing, mastering, and audio production services.',
                'writing' => 'Content writing, copywriting, technical writing, and editing services.',
                'education' => 'Online tutoring, course creation, and educational consulting services.',
                'repair services' => 'Professional repair services for electronics, appliances, and devices.',
                'delivery' => 'Fast and reliable delivery services for businesses and individuals.',
                'beauty' => 'Professional beauty services including hair, makeup, and skincare treatments.',
                'cleaning' => 'Residential and commercial cleaning services with eco-friendly products.',
                'consulting' => 'Business consulting, strategy development, and operational improvement.',
                'training' => 'Professional training programs and workshops for individuals and teams.',
                'it support' => '24/7 IT support, help desk services, and technical assistance.',
                'networking' => 'Network setup, configuration, and maintenance services.'
            ];
            
            $service_prices = [
                'web development' => 'Starting at $499',
                'graphic design' => 'Starting at $99',
                'digital marketing' => 'Starting at $299',
                'mobile app' => 'Starting at $999',
                'database' => 'Starting at $199',
                'cloud services' => 'Starting at $149',
                'cybersecurity' => 'Starting at $299',
                'photography' => 'Starting at $199',
                'video editing' => 'Starting at $149',
                'music production' => 'Starting at $99',
                'writing' => 'Starting at $49',
                'education' => 'Starting at $29/hr',
                'repair services' => 'Starting at $39',
                'delivery' => 'Starting at $9.99',
                'beauty' => 'Starting at $49',
                'cleaning' => 'Starting at $79',
                'consulting' => 'Starting at $149/hr',
                'training' => 'Starting at $199/session',
                'it support' => 'Starting at $49/month',
                'networking' => 'Starting at $199'
            ];
            
            $icons = ['fas fa-code', 'fas fa-paint-brush', 'fas fa-chart-line', 'fas fa-mobile-alt', 
                      'fas fa-database', 'fas fa-cloud', 'fas fa-shield-alt', 'fas fa-camera',
                      'fas fa-video', 'fas fa-music', 'fas fa-book', 'fas fa-graduation-cap',
                      'fas fa-tools', 'fas fa-truck', 'fas fa-cut', 'fas fa-broom',
                      'fas fa-hands-helping', 'fas fa-chalkboard', 'fas fa-laptop', 'fas fa-server'];
            
            if($service_count > 0):
                $i = 0;
                while($service = $services_query->fetch_assoc()):
                    $service_name = strtolower($service['service']);
                    $image_url = isset($service_images[$service_name]) ? $service_images[$service_name] : 'https://via.placeholder.com/400x200/1a1a1a/c0392b?text=' . urlencode($service['service']);
                    $description = isset($service_descriptions[$service_name]) ? $service_descriptions[$service_name] : 'Professional ' . $service['service'] . ' services tailored to your needs. Quality guaranteed with expert professionals.';
                    $price = isset($service_prices[$service_name]) ? $service_prices[$service_name] : 'Contact for pricing';
            ?>
                <div class="service-category-item" data-id="<?php echo $service['id'] ?>" data-name="<?php echo htmlspecialchars($service['service']) ?>" data-description="<?php echo htmlspecialchars($description) ?>" data-price="<?php echo $price ?>">
                    <div class="service-badge">Featured</div>
                    <img src="<?php echo $image_url; ?>" alt="<?php echo htmlspecialchars($service['service']); ?>" class="service-image">
                    <div class="service-content">
                        <div class="service-category-icon">
                            <i class="<?php echo $icons[$i % count($icons)]; ?>"></i>
                        </div>
                        <h5><?php echo htmlspecialchars(ucwords($service['service'])); ?></h5>
                        <div class="service-description">
                            <?php echo substr(htmlspecialchars($description), 0, 80) . '...'; ?>
                        </div>
                        <div class="service-meta">
                            <span class="service-price"><?php echo $price; ?></span>
                            <a href="javascript:void(0)" class="service-link view-service" data-id="<?php echo $service['id'] ?>">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php 
                $i++;
                endwhile; 
            else:
            ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No service categories available yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Service Details Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header service-modal-header">
                <h5 class="modal-title" id="serviceModalTitle">Service Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body service-modal-body" id="serviceModalBody">
                <div class="text-center">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-book-now" id="bookNowBtn">
                    <i class="fas fa-calendar-check"></i> Book This Service
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    // Contact form submission
    $('#contactForm').on('submit', function(e){
        e.preventDefault();
        var $form = $(this);
        
        $form.find('.is-invalid').removeClass('is-invalid');
        $('#msg-alert').html('');
        
        var valid = true;
        $form.find('[required]').each(function(){
            if(!$(this).val().trim()){ 
                $(this).addClass('is-invalid'); 
                valid=false; 
            }
        });
        
        var email = $('[name="sender_email"]').val();
        var emailPattern = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
        if(email && !emailPattern.test(email)) {
            $('[name="sender_email"]').addClass('is-invalid');
            valid = false;
        }
        
        if(!valid){
            $('#msg-alert').html('<div class="alert alert-danger-custom alert-custom"><i class="fas fa-exclamation-circle"></i> Please fill in all required fields correctly.</div>');
            return;
        }
        
        $('#sendTxt').addClass('d-none');
        $('#sendSpin').removeClass('d-none');
        $('#sendBtn').prop('disabled', true);
        
        $.ajax({
            url: 'admin/ajax.php',
            method: 'POST',
            data: $form.serialize() + '&action=send_message',
            dataType: 'json',
            success: function(res){
                if(res && res.status === 'success'){
                    $('#msg-alert').html('<div class="alert alert-success-custom alert-custom"><i class="fas fa-check-circle"></i> ' + res.message + '</div>');
                    $form[0].reset();
                    setTimeout(function() {
                        $('#msg-alert').fadeOut();
                    }, 5000);
                } else {
                    var errMsg = (res && res.message) ? res.message : 'Something went wrong. Please try again.';
                    $('#msg-alert').html('<div class="alert alert-danger-custom alert-custom"><i class="fas fa-exclamation-circle"></i> ' + errMsg + '</div>');
                }
            },
            error: function(xhr){
                $('#msg-alert').html('<div class="alert alert-danger-custom alert-custom"><i class="fas fa-exclamation-circle"></i> Could not connect to server. Please try again.</div>');
            },
            complete: function(){
                $('#sendTxt').removeClass('d-none');
                $('#sendSpin').addClass('d-none');
                $('#sendBtn').prop('disabled', false);
            }
        });
    });
    
    $('#contactForm [required]').on('input', function(){
        $(this).removeClass('is-invalid');
        $('#msg-alert').html('');
    });
    
    // View service details
    $('.view-service').click(function(e){
        e.preventDefault();
        var $item = $(this).closest('.service-category-item');
        var id = $item.data('id');
        var name = $item.data('name');
        var description = $item.data('description');
        var price = $item.data('price');
        var imageSrc = $item.find('.service-image').attr('src');
        
        var modalBody = `
            <img src="${imageSrc}" alt="${name}" class="service-modal-img">
            <h4 class="mt-3">${name}</h4>
            <p class="text-muted">${description}</p>
            <hr>
            <h6><i class="fas fa-tag"></i> Pricing</h6>
            <p class="text-danger font-weight-bold">${price}</p>
            <h6><i class="fas fa-check-circle"></i> What's Included</h6>
            <ul class="service-features">
                <li><i class="fas fa-check"></i> Professional consultation</li>
                <li><i class="fas fa-check"></i> Quality assurance guarantee</li>
                <li><i class="fas fa-check"></i> 24/7 customer support</li>
                <li><i class="fas fa-check"></i> Free revisions (if applicable)</li>
                <li><i class="fas fa-check"></i> Detailed project report</li>
            </ul>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Contact us for custom packages and bulk discounts.
            </div>
        `;
        
        $('#serviceModalTitle').text(name);
        $('#serviceModalBody').html(modalBody);
        $('#serviceModal').modal('show');
    });
    
    // Book now button
    $('#bookNowBtn').click(function(){
        var serviceName = $('#serviceModalTitle').text();
        $('#contactForm input[name="subject"]').val('Booking Request: ' + serviceName);
        $('#serviceModal').modal('hide');
        $('html, body').animate({
            scrollTop: $('.message-form-card').offset().top - 100
        }, 500);
    });
});
</script>