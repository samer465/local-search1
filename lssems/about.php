<?php include 'admin/db_connect.php'; ?>

<div class="about-page py-4 px-2">
  <!-- Page Header -->
  <div class="text-center mb-5">
    <h2 class="about-heading">
      <i class="fas fa-info-circle" style="color:#4f46e5;"></i> About Us
    </h2>
    <p class="about-subtitle">Learn more about our platform and mission</p>
    <div style="width:60px;height:3px;background:#4f46e5;margin:12px auto 0;border-radius:2px;"></div>
  </div>

  <div class="row justify-content-center">
    <!-- Main About Content -->
    <div class="col-lg-8">
      <div class="about-card">
        <div class="about-card-body">
          <h4 class="about-section-title"><i class="fas fa-bullseye mr-2"></i>Our Mission</h4>
          <p class="about-text">
            <?php echo $_SESSION['system']['name'] ?> is a local search and service platform designed to connect people 
            with trusted service providers in their area. Whether you need professional services, 
            skilled freelancers, or reliable companies, our platform makes it easy to find exactly what you are looking for.
          </p>
          
          <div class="about-content-html">
            <?php include 'about.html'; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
      <div class="about-info-card mb-4">
        <div class="about-info-icon">
          <i class="fas fa-search"></i>
        </div>
        <h5>Easy Search</h5>
        <p>Find service providers by category and location with our powerful search tools.</p>
      </div>

      <div class="about-info-card mb-4">
        <div class="about-info-icon">
          <i class="fas fa-users"></i>
        </div>
        <h5>Verified Providers</h5>
        <p>Browse profiles of verified professionals and companies in your area.</p>
      </div>

      <div class="about-info-card mb-4">
        <div class="about-info-icon">
          <i class="fas fa-envelope-open-text"></i>
        </div>
        <h5>Direct Contact</h5>
        <p>Reach out directly to service providers through our integrated messaging system.</p>
      </div>
    </div>
  </div>
</div>

<style>
.about-heading {
  font-family: 'Inter', sans-serif;
  font-size: 28px;
  font-weight: 800;
  color: #1e293b;
}
.about-subtitle {
  color: #94a3b8;
  font-size: 15px;
  margin-top: 8px;
}
.about-card {
  background: #ffffff;
  border: 1px solid rgba(79, 70, 229, 0.15);
  border-radius: 16px;
  overflow: hidden;
}
.about-card-body {
  padding: 32px 28px;
}
.about-section-title {
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  color: #6366f1;
  font-size: 18px;
  margin-bottom: 16px;
}
.about-text {
  color: #64748b;
  font-size: 14px;
  line-height: 1.8;
  margin-bottom: 20px;
}
.about-content-html {
  color: #64748b;
  font-size: 14px;
  line-height: 1.8;
}
.about-content-html img {
  max-width: 100%;
  height: auto;
  border-radius: 12px;
  margin: 12px 0;
}
.about-info-card {
  background: #ffffff;
  border: 1px solid rgba(79, 70, 229, 0.15);
  border-radius: 16px;
  padding: 24px 20px;
  text-align: center;
  transition: all 0.3s ease;
}
.about-info-card:hover {
  border-color: rgba(79, 70, 229, 0.4);
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(79, 70, 229, 0.06);
}
.about-info-icon {
  width: 56px;
  height: 56px;
  background: linear-gradient(135deg, rgba(79,70,229,0.15), rgba(79,70,229,0.08));
  border: 1px solid rgba(79, 70, 229, 0.2);
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 14px;
}
.about-info-icon i {
  font-size: 22px;
  color: #6366f1;
}
.about-info-card h5 {
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 15px;
  color: #1e293b;
  margin-bottom: 8px;
}
.about-info-card p {
  color: #94a3b8;
  font-size: 13px;
  line-height: 1.6;
  margin-bottom: 0;
}
</style>