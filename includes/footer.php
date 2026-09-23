</main>

<footer class="footer">
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <div class="foot-brand">
          <img src="<?= e(media(setting('logo'))) ?>" alt="<?= e(setting('site_name_en')) ?>">
          <strong><?= e(setting('site_name_en')) ?></strong>
        </div>
        <p style="color:var(--muted);font-size:.93rem"><?= e(setting('affiliation_en')) ?></p>
        <p style="color:var(--muted);font-size:.93rem"><?= e(setting('address')) ?></p>
        <div class="socials">
          <a href="<?= e(setting('facebook','#')) ?>" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><path d="M13 22v-9h3l.5-3.5H13V7.4c0-1 .3-1.7 1.7-1.7H17V2.6C16.6 2.5 15.5 2.4 14.2 2.4c-2.7 0-4.6 1.7-4.6 4.7v2.4H6.6V13h3v9z"/></svg></a>
          <a href="<?= e(setting('instagram','#')) ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.9.07 3.3.15 4.8 1.7 5 5 .06 1.3.07 1.7.07 4.9s0 3.6-.07 4.9c-.15 3.3-1.7 4.8-5 5-1.3.06-1.7.07-4.9.07s-3.6 0-4.9-.07c-3.3-.15-4.8-1.7-5-5C2.2 15.6 2.2 15.2 2.2 12s0-3.6.07-4.9c.15-3.3 1.7-4.8 5-5C8.4 2.2 8.8 2.2 12 2.2zm0 4.9A4.9 4.9 0 1 0 16.9 12 4.9 4.9 0 0 0 12 7.1zm0 8.07A3.17 3.17 0 1 1 15.2 12 3.17 3.17 0 0 1 12 15.17zM17.1 5.6a1.15 1.15 0 1 0 1.15 1.15A1.15 1.15 0 0 0 17.1 5.6z"/></svg></a>
          <a href="<?= e(setting('youtube','#')) ?>" target="_blank" rel="noopener" aria-label="YouTube"><svg viewBox="0 0 24 24"><path d="M23 12s0-3.5-.45-5.2a2.8 2.8 0 0 0-2-2C18.9 4.3 12 4.3 12 4.3s-6.9 0-8.6.5a2.8 2.8 0 0 0-2 2C1 8.5 1 12 1 12s0 3.5.45 5.2a2.8 2.8 0 0 0 2 2c1.7.5 8.6.5 8.6.5s6.9 0 8.6-.5a2.8 2.8 0 0 0 2-2C23 15.5 23 12 23 12zM9.8 15.3V8.7l5.7 3.3z"/></svg></a>
        </div>
      </div>

      <div>
        <h4>Quick Links</h4>
        <ul>
          <li><a href="<?= url('index.php') ?>">Home</a></li>
          <li><a href="<?= url('page/about-college') ?>">About College</a></li>
          <li><a href="<?= url('courses.php') ?>">Courses &amp; Programs</a></li>
          <li><a href="<?= url('admission.php') ?>">Admissions</a></li>
          <li><a href="<?= url('page/scholarship') ?>">Scholarships</a></li>
          <li><a href="<?= url('gallery.php') ?>">Gallery</a></li>
          <li><a href="<?= url('contact.php') ?>">Contact Us</a></li>
        </ul>
      </div>

      <div>
        <h4>Important Links</h4>
        <ul>
          <li><a href="<?= url('page/rti') ?>">Right to Information (RTI)</a></li>
          <li><a href="<?= url('page/anti-ragging-cell') ?>">Anti-Ragging Cell</a></li>
          <li><a href="<?= url('page/grievance-redressal') ?>">Grievance Redressal</a></li>
          <li><a href="<?= url('page/fee-refund-policy') ?>">Fee Refund Policy</a></li>
          <li><a href="https://www.mgkvp.ac.in" target="_blank" rel="noopener">MGKVP Varanasi</a></li>
          <li><a href="https://scholarship.up.gov.in" target="_blank" rel="noopener">U.P. Scholarship Portal</a></li>
          <li><a href="https://www.antiragging.in" target="_blank" rel="noopener">Anti-Ragging Portal</a></li>
        </ul>
      </div>

      <div>
        <h4>Contact Us</h4>
        <ul>
          <li style="color:var(--muted)"><?= e(setting('address')) ?></li>
          <li><a href="tel:+91<?= e(setting('phone1')) ?>"><?= e(setting('phone1')) ?></a></li>
          <?php if (setting('phone2')): ?><li><a href="tel:+91<?= e(setting('phone2')) ?>"><?= e(setting('phone2')) ?></a></li><?php endif; ?>
          <li><a href="mailto:<?= e(setting('email')) ?>"><?= e(setting('email')) ?></a></li>
          <li style="color:var(--muted)"><?= e(setting('working_hours')) ?></li>
        </ul>
      </div>
    </div>

    <div class="foot-bottom">
      <span><?= e(setting('footer_note')) ?></span>
      <span>Last Updated: <?= date('d M Y') ?> &nbsp;·&nbsp; <a href="<?= url('admin/login.php') ?>">Admin Portal</a></span>
    </div>
  </div>
</footer>

<?php if (setting('whatsapp')): ?>
<a class="wa" href="https://wa.me/<?= e(setting('whatsapp')) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <svg viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.15-1.7-.85-2-.95s-.45-.15-.65.15-.75.95-.9 1.15-.35.2-.65.05a8 8 0 0 1-2.35-1.45 8.8 8.8 0 0 1-1.6-2c-.17-.3 0-.45.13-.6s.3-.35.45-.53a2 2 0 0 0 .3-.5.55.55 0 0 0 0-.52c-.08-.15-.65-1.57-.9-2.15s-.48-.5-.65-.5h-.55a1.07 1.07 0 0 0-.78.36 3.24 3.24 0 0 0-1 2.4 5.62 5.62 0 0 0 1.18 3 12.87 12.87 0 0 0 4.93 4.35c.69.3 1.23.48 1.65.61a4 4 0 0 0 1.82.11 3 3 0 0 0 1.94-1.37 2.4 2.4 0 0 0 .17-1.37c-.07-.13-.27-.2-.56-.35zM12 2a10 10 0 0 0-8.6 15.1L2 22.5l5.5-1.4A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.1.8.83-3-.2-.31A8.2 8.2 0 1 1 12 20.2z"/></svg>
</a>
<?php endif; ?>

<div class="lightbox" id="galleryLightbox" role="dialog" aria-modal="true" aria-label="Image Preview">
  <button class="lb-close" aria-label="Close" title="Close (Esc)">&times;</button>
  <button class="lb-nav lb-prev" aria-label="Previous image" title="Previous (Left arrow)">
    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
  </button>
  <div class="lb-wrap">
    <div class="lb-img-container">
      <img src="" alt="" class="lb-img">
    </div>
    <div class="lb-meta">
      <div class="lb-caption"></div>
      <div class="lb-counter"></div>
    </div>
  </div>
  <button class="lb-nav lb-next" aria-label="Next image" title="Next (Right arrow)">
    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
  </button>
</div>

<script src="<?= url('assets/js/main.js') ?>?v=<?= time() ?>"></script>
</body>
</html>
