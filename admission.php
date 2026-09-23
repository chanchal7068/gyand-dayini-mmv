<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Admissions';
$courses = get_rows('courses');
$msg = ''; $ok = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $msg = 'Session expired. Please refresh the page and try again.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $phone = preg_replace('/\D/', '', $_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $course = trim($_POST['course'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || strlen($phone) !== 10) {
            $msg = 'Please enter your name and a valid 10-digit mobile number.';
        } else {
            $st = $pdo->prepare("INSERT INTO enquiries (name,phone,email,course,subject,message,type) VALUES (?,?,?,?,?,?,'admission')");
            $st->execute([$name, $phone, $email, $course, 'Admission Inquiry', $message]);
            $ok = true;
            $msg = 'Thank you! Your inquiry has been received. Our admissions office will contact you shortly.';
            @mail(setting('email'), 'Admission Inquiry — ' . $name, "Name: $name\nPhone: $phone\nCourse: $course\nEmail: $email\n\n$message", 'Content-Type: text/plain; charset=UTF-8');
        }
    }
}
include __DIR__ . '/includes/header.php';
?>
<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> &rsaquo; Admissions &amp; Fees &rsaquo; Admission Process</p>
    <h1>Admission Process — Session 2026-27</h1>
    <p class="sub"><?= e(setting('admission_note')) ?></p>
  </div>
</section>

<section class="section">
  <div class="wrap layout">
    <div class="prose reveal">
      <h3>Admission Procedure</h3>
      <ol>
        <li>Obtain the college prospectus and admission application form from the college office.</li>
        <li>Fill out the form completely and attach self-attested copies of all required certificates.</li>
        <li>Submit the completed application form at the office before the notified deadline.</li>
        <li>Merit list will be published based on marks obtained in Intermediate (10+2).</li>
        <li>Upon selection in the merit list, confirm your admission by submitting fees on the scheduled date.</li>
        <li>Submit anti-ragging affidavit and guardian consent form after confirmation of admission.</li>
      </ol>

      <h3>Required Documents</h3>
      <ul>
        <li>High School (10th) &amp; Intermediate (12th) Marksheets and Certificates (Original + Photocopies)</li>
        <li>Transfer Certificate (T.C.) and Character Certificate</li>
        <li>Aadhaar Card (linked with active mobile number)</li>
        <li>Caste and Income Certificates (for reserved category applicants, latest)</li>
        <li>Domicile / Residence Certificate</li>
        <li>Recent Passport-Size Photographs (6 copies)</li>
        <li>Bank Passbook Photocopy (Aadhaar-seeded account for scholarship)</li>
      </ul>

      <h3>Important Guidelines</h3>
      <ul>
        <li>Admission will be cancelled immediately if any submitted information is found false or misleading.</li>
        <li>Minimum 75% classroom attendance is mandatory to appear for university examinations.</li>
        <li>The college campus is strictly ragging-free; indiscipline will attract severe disciplinary action.</li>
        <li>Preserve fee receipts safely — they are required for scholarship applications.</li>
      </ul>

      <p><a class="btn btn-ghost btn-sm" href="<?= url('page/fee-structure') ?>">Fee Structure</a>
         <a class="btn btn-ghost btn-sm" href="<?= url('page/reservation-roster') ?>">Reservation Roster</a>
         <a class="btn btn-ghost btn-sm" href="<?= url('page/scholarship') ?>">Scholarship Details</a></p>
    </div>

    <aside class="sidebar">
      <div class="side-box" id="apply">
        <h4>Online Admission Inquiry</h4>
        <?php if ($msg): ?><div class="alert <?= $ok ? 'alert-ok' : 'alert-err' ?>" style="font-size:.9rem"><?= e($msg) ?></div><?php endif; ?>
        <form method="post" style="display:grid;gap:14px">
          <?= csrf_field() ?>
          <div class="field"><label for="an">Student's Full Name *</label><input id="an" name="name" required value="<?= e($_POST['name'] ?? '') ?>"></div>
          <div class="field"><label for="ap">Mobile Number *</label><input id="ap" name="phone" required inputmode="numeric" value="<?= e($_POST['phone'] ?? '') ?>"></div>
          <div class="field"><label for="ae">Email Address</label><input id="ae" type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>"></div>
          <div class="field"><label for="ac">Course Interested In</label>
            <select id="ac" name="course">
              <?php foreach ($courses as $c): ?><option value="<?= e($c['short_name'] . ' — ' . $c['name']) ?>"><?= e($c['short_name'] . ' — ' . $c['name']) ?></option><?php endforeach; ?>
            </select>
          </div>
          <div class="field"><label for="am">Your Message / Query</label><textarea id="am" name="message" style="min-height:90px"><?= e($_POST['message'] ?? '') ?></textarea></div>
          <button class="btn btn-gold" type="submit">Submit Inquiry</button>
        </form>
        <p class="note">This is an inquiry form — our admission counselors will contact you.</p>
      </div>

      <div class="side-box">
        <h4>Direct Contact</h4>
        <p style="font-size:.93rem;color:var(--muted)"><?= e(setting('working_hours')) ?></p>
        <a class="btn btn-ghost btn-sm" style="width:100%;margin-bottom:8px" href="tel:+91<?= e(setting('phone1')) ?>"><?= e(setting('phone1')) ?></a>
        <a class="btn btn-gold btn-sm" style="width:100%" href="https://wa.me/<?= e(setting('whatsapp')) ?>" target="_blank" rel="noopener">WhatsApp Us</a>
      </div>
    </aside>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
