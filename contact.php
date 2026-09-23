<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Contact Us';
$msg = ''; $ok = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $msg = 'Session expired. Please refresh the page and try again.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || $phone === '' || $message === '') {
            $msg = 'Please provide your name, mobile number, and message.';
        } elseif (!preg_match('/^[0-9]{10}$/', preg_replace('/\D/', '', $phone))) {
            $msg = 'Please enter a valid 10-digit mobile number.';
        } else {
            $st = $pdo->prepare("INSERT INTO enquiries (name,phone,email,subject,message,type) VALUES (?,?,?,?,?,'contact')");
            $st->execute([$name, $phone, $email, $subject, $message]);
            $ok = true;
            $msg = 'Your message has been received successfully! Our administrative office will contact you soon.';
            @mail(setting('email'), 'Website Contact: ' . $subject, "Name: $name\nPhone: $phone\nEmail: $email\n\n$message", 'Content-Type: text/plain; charset=UTF-8');
        }
    }
}
include __DIR__ . '/includes/header.php';
?>
<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> &rsaquo; Contact Us</p>
    <h1>Contact Us</h1>
    <p class="sub">For admissions, scholarships, or general inquiries</p>
  </div>
</section>

<section class="section">
  <div class="wrap contact-grid">
    <div class="reveal">
      <div class="info-row">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-5.6 7-11a7 7 0 10-14 0c0 5.4 7 11 7 11z"/><circle cx="12" cy="10" r="2.6"/></svg>
        <div><b>Address</b><span><?= e(setting('address')) ?></span></div>
      </div>
      <div class="info-row">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3h4l2 5-3 2a13 13 0 006 6l2-3 5 2v4a2 2 0 01-2 2A17 17 0 013 5a2 2 0 012-2z"/></svg>
        <div><b>Phone</b><span><a href="tel:+91<?= e(setting('phone1')) ?>"><?= e(setting('phone1')) ?></a><?php if (setting('phone2')): ?>, <a href="tel:+91<?= e(setting('phone2')) ?>"><?= e(setting('phone2')) ?></a><?php endif; ?></span></div>
      </div>
      <div class="info-row">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
        <div><b>Email</b><span><a href="mailto:<?= e(setting('email')) ?>"><?= e(setting('email')) ?></a></span></div>
      </div>
      <div class="info-row">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
        <div><b>Office Hours</b><span><?= e(setting('working_hours')) ?></span></div>
      </div>

      <div class="map-frame" style="margin-top:26px;min-height:280px">
        <iframe src="<?= e(setting('map_embed')) ?>" loading="lazy" title="College Location Map" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

    <div class="card reveal">
      <h3>Send Us a Message</h3>
      <?php if ($msg): ?><div class="alert <?= $ok ? 'alert-ok' : 'alert-err' ?>"><?= e($msg) ?></div><?php endif; ?>
      <form method="post" class="form-grid">
        <?= csrf_field() ?>
        <div class="field"><label for="n">Full Name *</label><input id="n" name="name" required value="<?= e($_POST['name'] ?? '') ?>"></div>
        <div class="field"><label for="p">Mobile Number *</label><input id="p" name="phone" required inputmode="numeric" value="<?= e($_POST['phone'] ?? '') ?>"></div>
        <div class="field"><label for="e">Email Address</label><input id="e" type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>"></div>
        <div class="field"><label for="s">Subject</label><input id="s" name="subject" value="<?= e($_POST['subject'] ?? '') ?>"></div>
        <div class="field full"><label for="m">Message *</label><textarea id="m" name="message" required><?= e($_POST['message'] ?? '') ?></textarea></div>
        <div class="field full"><button class="btn btn-gold" type="submit">Send Message</button></div>
      </form>
      <p class="note">* Marked fields are required.</p>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
