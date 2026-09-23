-- =====================================================================
--  Gyandayini Women's College — Database Schema + Seed Data (English)
-- =====================================================================
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(60) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(120) DEFAULT '',
  `email` VARCHAR(120) DEFAULT '',
  `last_login` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default login:  admin  /  gdmmv@2026
INSERT INTO `admins` (`username`,`password`,`full_name`,`email`) VALUES
('admin','$2a$10$tKPc2gnKnZ6Vwa0NzT.5LOGftz83cL3fatdA6n3JFBJNEizMN9PJ2','Administrator','info@gyandayanigmmv.com');

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `skey` VARCHAR(80) PRIMARY KEY,
  `svalue` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`skey`,`svalue`) VALUES
('site_name_hi','ज्ञानदायिनी महिला महाविद्यालय'),
('site_name_en','Gyandayini Women\'s College'),
('affiliation_hi','महात्मा गांधी काशी विद्यापीठ, वाराणसी से सम्बद्ध'),
('affiliation_en','Affiliated to Mahatma Gandhi Kashi Vidyapith, Varanasi'),
('logo','https://gyandayanigmmv.com/wp-content/uploads/2026/05/gdmmv-logo-150x150.png'),
('logo_large','https://gyandayanigmmv.com/wp-content/uploads/2026/05/ggm-lOGO.jpeg'),
('address','Parampur, Akelwa, Varanasi, Uttar Pradesh – 221302'),
('phone1','8601889999'),
('phone2','9026466186'),
('whatsapp','918601889999'),
('email','info@gyandayanigmmv.com'),
('working_hours','Mon – Sat : 08:00 AM – 02:00 PM  |  Sunday Closed'),
('tagline','Knowledge • Values • Education • Self-Reliance'),
('motto','Educated Women — Empowered Society'),
('hero_line','When a woman is educated, the entire family is empowered. Women’s education is the greatest force in nation building.'),
('facebook','https://facebook.com'),
('instagram','https://instagram.com'),
('youtube','https://youtube.com'),
('twitter','https://twitter.com'),
('map_embed','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14421.6!2d82.98!3d25.28!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sVaranasi!5e0!3m2!1sen!2sin!4v1700000000000'),
('stat_students','1200'),
('stat_years','25'),
('stat_faculty','24'),
('stat_courses','2'),
('admission_open','1'),
('admission_note','Admissions Open for B.A. & B.Com. 1st Year — Academic Session 2026-27'),
('meta_desc','Gyandayini Women\'s College, Varanasi — Premier Girls Degree College Affiliated to Mahatma Gandhi Kashi Vidyapith. Admissions open for B.A. & B.Com.'),
('footer_note','© 2026 Gyandayini Women\'s College, Varanasi. All Rights Reserved.');

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `parent_id` INT DEFAULT 0,
  `title` VARCHAR(160) NOT NULL,
  `url` VARCHAR(255) DEFAULT '#',
  `sort_order` INT DEFAULT 0,
  `open_new` TINYINT(1) DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `menus` (`id`,`parent_id`,`title`,`url`,`sort_order`) VALUES
(1,0,'Home','index.php',1),
(2,0,'About Us','#',2),
(3,0,'Administration','#',3),
(5,0,'College','#',4),
(8,0,'Notice Board','#',5),
(9,0,'Gallery','gallery.php',6),
(10,0,'Contact Us','contact.php',7),

(20,2,'About the College','page/about-college',1),
(21,2,'Vision & Mission','page/vision-mission',2),
(22,2,'Our Inspiration','page/our-inspiration',3),
(23,2,'Affiliating University','page/affiliating-university',4),

(31,3,'Manager\'s Message','page/manager-message',1),
(32,3,'Principal\'s Message','page/principal-message',2),

(50,5,'Courses & Programs','courses.php',1),
(51,5,'Faculty & Staff','faculty.php',2),
(52,5,'Examinations','page/examinations',3),
(54,5,'Calendar','page/academic-calendar',4),

(80,8,'Right to Information (RTI)','page/rti',1),
(81,8,'Notices & Circulars','notices.php',2),
(82,8,'Events & Achievements','events.php',3),
(83,8,'College Newsletters','page/newsletters',4),
(84,8,'Job Openings','page/job-openings',5),
(85,8,'Academic Collaboration','page/academic-collaboration',6);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(160) NOT NULL UNIQUE,
  `title` VARCHAR(200) NOT NULL,
  `subtitle` VARCHAR(255) DEFAULT '',
  `banner` VARCHAR(255) DEFAULT '',
  `content` LONGTEXT,
  `meta_desc` VARCHAR(300) DEFAULT '',
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pages` (`slug`,`title`,`subtitle`,`content`) VALUES
('about-college','About the College','Center for Higher Education for Rural Women',
'<p>Gyandayini Women\'s College was established with the prime objective of providing accessible, high-quality, and value-oriented higher education to women in rural regions close to their homes. The college is permanently affiliated with Mahatma Gandhi Kashi Vidyapith, Varanasi.</p>
<p>The college operates undergraduate faculties in Arts (B.A.) and Commerce (B.Com.). The campus is tranquil and lush green, equipped with spacious classrooms, a central library, a computer lab, sports grounds, and dedicated student common rooms.</p>
<h3>Salient Features</h3>
<ul>
<li>Dedicated Women\'s Institution — Safe, disciplined, and empowering environment</li>
<li>Experienced, qualified, and student-centric faculty</li>
<li>Strict commitment to transparent and fair examinations</li>
<li>100% Ragging-Free and inclusive campus</li>
<li>Comprehensive guidance for UP Government scholarship and fee reimbursement</li>
<li>Strong tradition of sports, cultural, and National Service Scheme (NSS) activities</li>
</ul>
<p>Our guiding motto is <strong>“Educated Women — Empowered Society”</strong>. We believe that educating a woman educates and uplifts entire generations.</p>'),

('vision-mission','Vision & Mission','Our Guiding Principles & Purpose',
'<h3>Our Vision</h3>
<p>To deliver quality higher education to every aspiring young woman in rural and semi-urban communities, nurturing them into confident, self-reliant, ethical, and responsible citizens.</p>
<h3>Our Mission</h3>
<ul>
<li>Provide affordable, accessible, and high-standard undergraduate education.</li>
<li>Harmonize modern academic knowledge with Indian heritage and moral values.</li>
<li>Cultivate leadership, effective communication, and career-oriented skillsets in students.</li>
<li>Raise awareness regarding women\'s rights, wellness, and self-defense.</li>
<li>Foster a strong spirit of community service, social harmony, and nation building.</li>
</ul>
<h3>Core Values</h3>
<p>Discipline • Integrity • Equality • Service • Self-Reliance</p>'),

('our-inspiration','Our Inspiration & Founders','Founding Visionaries of the Institution',
'<p>This institution is the fruition of the noble dream envisioned by three dedicated pioneers who devoted their lives to promoting women\'s education in rural areas.</p>
<h3>Late Kalika Pandey <small>(01.10.1917 – 08.11.2008)</small></h3>
<p><em>Dedication & Blessing</em> — Whose selfless sacrifice, blessing, and values laid the foundational stone of this institution.</p>
<h3>Late Shyam Narayan Pandey <small>(01.07.1951 – 17.11.2016)</small></h3>
<p><em>Founder – Director</em> — An ardent champion of education who transformed the vision of a women\'s college into a living reality.</p>
<h3>Late Satyabhama Pandey <small>(01.07.1947 – 01.05.2021)</small></h3>
<p><em>Founder – Manager</em> — Whose maternal care, strict discipline, and leadership guided the college over decades.</p>
<p>The entire college fraternity bows in gratitude to their legacy and resolves to follow the path shown by them.</p>'),

('affiliating-university','Affiliating University','Mahatma Gandhi Kashi Vidyapith, Varanasi',
'<p>Gyandayini Women\'s College is affiliated with <strong>Mahatma Gandhi Kashi Vidyapith (MGKVP), Varanasi</strong>. All curriculum, examinations, evaluation processes, and degree awards are governed by the ordinances and regulations of the university.</p>
<h3>Important University Links</h3>
<ul>
<li><a href="https://www.mgkvp.ac.in" target="_blank" rel="noopener">Mahatma Gandhi Kashi Vidyapith — Official Portal</a></li>
<li><a href="https://scholarship.up.gov.in" target="_blank" rel="noopener">UP Govt. Scholarship &amp; Fee Reimbursement Portal</a></li>
<li><a href="https://www.ugc.gov.in" target="_blank" rel="noopener">University Grants Commission (UGC)</a></li>
<li><a href="https://www.antiragging.in" target="_blank" rel="noopener">National Anti-Ragging Helpline &amp; Portal</a></li>
</ul>
<p><em>Copies of the university affiliation certificates are available for verification at the administrative office.</em></p>'),

('college-development-plan','College Development Plan','Strategic Institutional Roadmap',
'<h3>Short-Term Goals</h3>
<ul>
<li>Expansion of smart classrooms equipped with interactive multimedia projectors.</li>
<li>Enhancement of library facilities with e-resources and competitive examination section.</li>
<li>Upgradation of high-speed broadband computer laboratory.</li>
<li>Introduction of add-on skill development certificate programs.</li>
</ul>
<h3>Long-Term Roadmap</h3>
<ul>
<li>Application for Post-Graduate (PG) degree courses.</li>
<li>Construction of a multi-purpose auditorium and indoor sports complex.</li>
<li>Expansion of safe hostel and accommodation facilities.</li>
<li>Preparation and accreditation under National Assessment and Accreditation Council (NAAC).</li>
<li>Solar energy and rainwater harvesting systems for a sustainable green campus.</li>
</ul>'),

('recognition-status','Recognition & Affiliation Status','Affiliation & Statutory Information',
'<p>Gyandayini Women\'s College is recognized and affiliated with Mahatma Gandhi Kashi Vidyapith, Varanasi, and is registered on the AISHE portal.</p>
<table>
<tr><th>Parameter</th><th>Status</th></tr>
<tr><td>Affiliating University</td><td>Mahatma Gandhi Kashi Vidyapith, Varanasi</td></tr>
<tr><td>Institution Type</td><td>Self-Financed Girls Degree College</td></tr>
<tr><td>AISHE Registration</td><td>Available at Office</td></tr>
<tr><td>NAAC Accreditation</td><td>In Process</td></tr>
</table>
<p>Statutory letters and certificates are available for review in the <a href="notices.php">Notices section</a>.</p>'),

('management-committee','Management Committee','Board of Governance',
'<p>The college is governed by an executive Management Committee responsible for policy making, institutional infrastructure, financial management, and academic excellence.</p>
<table>
<tr><th>S.No.</th><th>Name</th><th>Designation</th></tr>
<tr><td>1</td><td>—</td><td>President</td></tr>
<tr><td>2</td><td>—</td><td>Manager / Secretary</td></tr>
<tr><td>3</td><td>—</td><td>Treasurer</td></tr>
<tr><td>4</td><td>Principal</td><td>Ex-Officio Member / Secretary</td></tr>
<tr><td>5</td><td>—</td><td>Faculty Representative</td></tr>
</table>
<p><em>Names and official designations are managed through the admin portal.</em></p>'),

('manager-message','Manager\'s Message','A Message from the College Manager',
'<p>Dear Parents, Guardians, and Students,</p>
<p>Gyandayini Women\'s College is not just an educational institution; it is a solemn commitment to ensure that no girl in our region is deprived of higher education due to geographical or financial constraints.</p>
<p>Our constant endeavor is that every student graduating from our portals carries forward confidence, deep knowledge, and strong moral character. I urge all parents to actively participate in empowering their daughters through education.</p>
<p><strong>— Manager</strong><br>Gyandayini Women\'s College</p>'),

('principal-message','Principal\'s Message','Welcome Message from the Principal',
'<p>A warm welcome to Gyandayini Women\'s College.</p>
<p>The true goal of education extends beyond obtaining a degree; it lies in cultivating wisdom, integrity, and self-reliance. Our dedicated faculty ensures personalized academic care for each student.</p>
<p>We place paramount emphasis on disciplined learning, regular classroom attendance, and transparent examinations. We encourage all students to make the best use of college opportunities and strive toward excellence.</p>
<p><strong>— Principal</strong><br>Gyandayini Women\'s College</p>'),

('office-staff','Office & Support Staff','Administrative and Office Team',
'<table>
<tr><th>S.No.</th><th>Name</th><th>Designation</th></tr>
<tr><td>1</td><td>—</td><td>Head Clerk</td></tr>
<tr><td>2</td><td>—</td><td>Accountant</td></tr>
<tr><td>3</td><td>—</td><td>Library Assistant</td></tr>
<tr><td>4</td><td>—</td><td>Computer Operator</td></tr>
</table>
<p>Office Working Hours: Monday to Saturday, 08:00 AM to 02:00 PM.</p>'),

('internal-complaint-committee','Internal Complaints Committee (ICC)','Women Safety & Grievance Prevention',
'<p>As per the UGC Regulations and statutory directives, an Internal Complaints Committee (ICC) operates in the college.</p>
<h3>Responsibilities</h3>
<ul>
<li>Receive and handle grievances in a strictly confidential manner.</li>
<li>Conduct fair inquiries and ensure prompt resolution within stipulated timelines.</li>
<li>Maintain a secure, respectful, and zero-harassment environment on campus.</li>
</ul>
<table><tr><th>Member</th><th>Role</th></tr>
<tr><td>Principal</td><td>Chairperson</td></tr>
<tr><td>Senior Female Faculty</td><td>Convenor</td></tr>
<tr><td>Faculty Member</td><td>Member</td></tr>
<tr><td>Student Representative</td><td>Member</td></tr>
</table>
<p>To lodge a query or grievance, contact the office or use the <a href="contact.php">Contact Form</a>.</p>'),

('sexual-harassment-committee','Prevention of Sexual Harassment','POSH Cell & Women Safety',
'<p>The college strictly adheres to the provisions of the POSH Act 2013. Any form of harassment is strictly prohibited and constitutes a punishable offense.</p>
<h3>Grievance Procedure</h3>
<ul>
<li>Complaints can be submitted in writing or orally to the convenor of the committee.</li>
<li>The identity of the complainant is kept strictly confidential.</li>
<li>Inquiries are concluded within the statutory 90-day period.</li>
<li>Right of appeal to university authorities in accordance with applicable rules.</li>
</ul>
<p>National Commission for Women Helpline: <strong>7827170170</strong></p>'),

('grievance-redressal','Student Grievance Redressal Cell','Student Welfare & Support',
'<p>A dedicated Student Grievance Redressal Cell functions to address academic, administrative, and infrastructural concerns of students efficiently.</p>
<h3>Scope of Grievances Handled</h3>
<ul>
<li>Admissions, tuition fees, and scholarship applications.</li>
<li>Classroom teaching, scheduling, and syllabus coverage.</li>
<li>Examination forms, admit cards, and marksheet corrections.</li>
<li>Campus amenities, sanitation, and safety.</li>
</ul>
<p>A physical suggestion and grievance box is placed outside the principal\'s office. Online submissions can be made via <a href="contact.php">Contact Us</a>.</p>'),

('iqac','Internal Quality Assurance Cell (IQAC)','Institutional Quality Assurance',
'<p>The IQAC oversees the continuous enhancement of academic and administrative standards across the institution.</p>
<h3>Key Activities</h3>
<ul>
<li>Annual institutional quality audits and report preparations.</li>
<li>Collection and analysis of feedback from students, faculty, and alumni.</li>
<li>Organization of faculty development workshops and student enrichment seminars.</li>
<li>Comprehensive documentation for institutional accreditation and benchmarks.</li>
</ul>'),

('admission-committee','Admission Committee','Admissions Governance',
'<p>The Admission Committee supervises the entire admissions cycle, ensuring compliance with merit criteria and statutory reservation rosters.</p>
<ul>
<li>Scrutiny of applications and verification of eligibility.</li>
<li>Preparation and publication of transparent merit lists.</li>
<li>Strict compliance with governmental reservation policies.</li>
<li>Redressal of admission-related student queries.</li>
</ul>'),

('sc-st-obc-committee','SC / ST / OBC Committee','Welfare of Reserved Category Students',
'<p>This committee is constituted to safeguard the rights and interests of students from SC, ST, and OBC communities.</p>
<ul>
<li>Assistance with state scholarship and fee reimbursement applications.</li>
<li>Monitoring the proper implementation of reservation policies.</li>
<li>Redressal of discrimination-related issues, if any.</li>
<li>Remedial coaching and career counseling support.</li>
</ul>'),

('anti-ragging-cell','Anti-Ragging Cell','Zero Tolerance Against Ragging',
'<p><strong>The college campus is 100% ragging-free. Ragging in any form is a cognizable criminal offense.</strong></p>
<h3>Penalties for Ragging</h3>
<ul>
<li>Immediate cancellation of admission.</li>
<li>Suspension from attending classes and academic privileges.</li>
<li>Debarring from university examinations.</li>
<li>Registration of FIR and legal prosecution.</li>
</ul>
<h3>National Anti-Ragging Helpline</h3>
<p>Toll-Free Helpline: <strong>1800-180-5522</strong><br>
Portal: <a href="https://www.antiragging.in" target="_blank" rel="noopener">www.antiragging.in</a></p>'),

('examinations','Examinations','University & Internal Evaluation',
'<p>All semester and annual examinations are conducted strictly in accordance with the schedule and norms of Mahatma Gandhi Kashi Vidyapith, Varanasi.</p>
<h3>Evaluation Scheme</h3>
<ul>
<li>Internal continuous assessments, assignments, and annual university examinations.</li>
<li>Mandatory minimum 75% attendance to qualify for university exams.</li>
<li>Online examination form submission with full assistance from college office.</li>
<li>Commitment to completely fair, cheat-free, and transparent testing.</li>
</ul>
<h3>Admit Cards &amp; Results</h3>
<p>Admit cards and results can be downloaded directly from the university portal. For updates, check the <a href="notices.php">Notices section</a>.</p>'),

('library','Central Library','Books, Journals & Digital Resources',
'<p>The college library houses an extensive collection of textbooks, reference works, competitive examination guides, journals, and literary classics.</p>
<h3>Facilities</h3>
<ul>
<li>Comprehensive course textbooks and reference volumes.</li>
<li>Daily national newspapers and academic periodicals.</li>
<li>Specialized section for competitive examinations (UPSC, UPPSC, TET, SSC, Banking).</li>
<li>Quiet and comfortable student reading room.</li>
<li>Internet access for academic e-resources.</li>
</ul>
<h3>Library Rules</h3>
<ul>
<li>Valid Library Card is required for book issuance.</li>
<li>Up to 2 books issued at a time for a 14-day duration.</li>
<li>Strict silence and discipline must be maintained in the reading hall.</li>
</ul>'),

('academic-calendar','Academic Calendar','Annual Academic Schedule 2026-27',
'<table>
<tr><th>Month</th><th>Planned Activities</th></tr>
<tr><td>June – July</td><td>Admission applications, merit list announcement, admissions</td></tr>
<tr><td>August</td><td>Commencement of classes and fresher orientation</td></tr>
<tr><td>September</td><td>Teachers\' Day celebrations, NSS unit enrollment</td></tr>
<tr><td>October</td><td>First internal mid-term assessments</td></tr>
<tr><td>November</td><td>Annual sports meet and athletic competitions</td></tr>
<tr><td>December</td><td>Annual cultural festival and celebrations</td></tr>
<tr><td>January</td><td>Republic Day celebration, second internal evaluation</td></tr>
<tr><td>February</td><td>University exam form submission &amp; practical exams</td></tr>
<tr><td>March – April</td><td>University annual &amp; semester examinations</td></tr>
</table>
<p><em>Dates are subject to modifications as per official MGKVP notifications.</em></p>'),

('statutes-ordinances','Statutes & Ordinances','Rules & Regulations',
'<p>Gyandayini Women\'s College functions strictly within the framework of the Acts, Statutes, and Ordinances of Mahatma Gandhi Kashi Vidyapith.</p>
<ul>
<li>Rules governing student admissions, attendance, and exam eligibility.</li>
<li>Code of conduct and institutional disciplinary regulations.</li>
<li>Teacher qualifications and service conditions.</li>
<li>Fee regulation and statutory refund policies.</li>
</ul>
<p>Detailed statutes are accessible on the university official portal.</p>'),

('fee-structure','Fee Structure','Fee Schedule 2026-27',
'<table>
<tr><th>Particulars</th><th>B.A.</th><th>B.Com.</th></tr>
<tr><td>Admission Fee (One Time)</td><td>—</td><td>—</td></tr>
<tr><td>Annual Tuition Fee</td><td>—</td><td>—</td></tr>
<tr><td>Examination Fee</td><td>As prescribed by University</td><td>As prescribed by University</td></tr>
<tr><td>Library &amp; Activity Fee</td><td>—</td><td>—</td></tr>
</table>
<p><strong>Note:</strong> Please contact the college office for the complete approved fee chart. Eligible students from reserved and economically weaker sections receive full support for UP Government scholarship and fee reimbursement.</p>
<p>Fees can be paid at the college fee counter. Always obtain and preserve official receipts.</p>'),

('prospectus','College Prospectus','Admissions Prospectus & Guidelines',
'<p>The detailed admission brochure and application forms are available at the college administrative office.</p>
<h3>General Directives</h3>
<ul>
<li>Candidates are required to thoroughly read all guidelines before submitting application forms.</li>
<li>Admissions to B.A. 1st Year and B.Com. 1st Year are merit-based.</li>
<li>Academic sessions commence in the first week of August.</li>
<li>The college maintains high standards of academic discipline and conduct.</li>
</ul>
<p>Downloadable notices and admission forms are published in the <a href="notices.php">Notices section</a>.</p>'),

('reservation-roster','Reservation Roster','Government Reservation Norms',
'<p>Admissions strictly follow the reservation policies prescribed by the Government of Uttar Pradesh and Mahatma Gandhi Kashi Vidyapith.</p>
<table>
<tr><th>Category</th><th>Reservation Percentage</th></tr>
<tr><td>Scheduled Castes (SC)</td><td>21%</td></tr>
<tr><td>Scheduled Tribes (ST)</td><td>02%</td></tr>
<tr><td>Other Backward Classes (OBC)</td><td>27%</td></tr>
<tr><td>Economically Weaker Sections (EWS)</td><td>10%</td></tr>
<tr><td>Persons with Disabilities (PwD)</td><td>Horizontal as per rules</td></tr>
</table>
<p>Valid caste and income certificates issued by competent revenue authorities are required at the time of admission verification.</p>'),

('fee-refund-policy','Fee Refund Policy','UGC Norms Compliant Refund Policy',
'<p>The college complies with the fee refund guidelines established by the University Grants Commission (UGC).</p>
<table>
<tr><th>Cancellation Request Received</th><th>Refund Percentage</th></tr>
<tr><td>15 days or more before the formal last date of admission</td><td>100% (minus processing charges)</td></tr>
<tr><td>Less than 15 days before the last date of admission</td><td>90%</td></tr>
<tr><td>15 days or less after the last date of admission</td><td>80%</td></tr>
<tr><td>30 days or less, but more than 15 days after last date</td><td>50%</td></tr>
<tr><td>More than 30 days after the formal last date</td><td>No refund</td></tr>
</table>
<p>To request a refund, submit a written application along with original fee receipt and bank account details at the office.</p>'),

('infrastructure','Campus Infrastructure','Facilities & Campus Amenities',
'<ul>
<li>Spacious, well-ventilated, and naturally lit classrooms.</li>
<li>Computer lab with high-speed internet connectivity.</li>
<li>Central library with rich book stock and quiet reading hall.</li>
<li>Home Science and practical laboratories.</li>
<li>Spacious playground for outdoor sports and athletics.</li>
<li>Clean, hygienic washrooms and dedicated girls\' common room.</li>
<li>Purified RO drinking water coolers.</li>
<li>CCTV surveillance and 24/7 security cover across the campus.</li>
<li>Transportation convenience for commuting students.</li>
</ul>'),

('sports','Sports & Physical Education','Physical Fitness & Athletic Training',
'<p>The college actively encourages sports and physical fitness alongside academics for the holistic development of students.</p>
<h3>Available Sports &amp; Games</h3>
<ul>
<li>Kabaddi and Kho-Kho</li>
<li>Badminton and Volleyball</li>
<li>Track Athletics — Sprints, Shot Put, Long Jump</li>
<li>Indoor Games — Chess, Carrom</li>
<li>Daily Yoga and Pranayama sessions</li>
</ul>
<p>The annual sports meet is held every winter, and outstanding student athletes are awarded trophies and certificates.</p>'),

('nss','National Service Scheme (NSS)','Community Service & Leadership',
'<p>The NSS motto is <strong>“NOT ME BUT YOU”</strong> — reflecting selfless service to society and community.</p>
<h3>Key NSS Activities</h3>
<ul>
<li>Cleanliness drives (Swachh Bharat) and tree plantation.</li>
<li>Blood donation camps and free health check-up drives.</li>
<li>Women literacy and community empowerment initiatives.</li>
<li>Voter awareness rallies and national integration programs.</li>
<li>7-Day annual residential village camp.</li>
</ul>
<p>To enroll as an NSS volunteer, contact the NSS Program Officer at the college office.</p>'),

('placement','Training & Placement Guidance','Career Guidance & Skill Building',
'<p>The college provides active guidance and training programs to prepare students for successful careers and competitive exams.</p>
<h3>Services Offered</h3>
<ul>
<li>Coaching and guidance for competitive exams (TET, UPPSC, SSC, Banking, Police).</li>
<li>Digital literacy and computer application training.</li>
<li>Workshops on tailoring, handicrafts, and self-employment skills.</li>
<li>Personality development, soft skills, and mock interview sessions.</li>
<li>Career counseling for higher studies (M.A., M.Com., B.Ed.).</li>
</ul>'),

('scholarship','Scholarships & Assistance','UP Govt. Scholarship Guidance',
'<p>Eligible students are supported in applying for the Post-Matric Scholarship and Fee Reimbursement Schemes of the Uttar Pradesh Government.</p>
<h3>Required Documents for Application</h3>
<ul>
<li>Aadhaar Card (linked with active mobile number)</li>
<li>Latest Income Certificate &amp; Caste Certificate</li>
<li>Domicile Certificate</li>
<li>Previous qualifying examination marksheets</li>
<li>Bank Passbook (Aadhaar-seeded bank account)</li>
<li>College admission fee receipt</li>
</ul>
<p>Official Portal: <a href="https://scholarship.up.gov.in" target="_blank" rel="noopener">scholarship.up.gov.in</a><br>
A dedicated helpdesk is set up in the college office to assist students with online applications.</p>'),

('healthcare','Healthcare & Wellness','Student Wellness & First Aid',
'<ul>
<li>First-aid medical kits and trained emergency care staff on campus.</li>
<li>Annual student general health and dental check-up camps.</li>
<li>Anemia detection, nutrition, and personal hygiene awareness seminars.</li>
<li>Professional counseling on women health and wellness.</li>
<li>Tie-ups with nearby healthcare centers for emergency medical response.</li>
</ul>
<p>National Emergency Ambulance Service: <strong>108</strong></p>'),

('equal-opportunity-cell','Equal Opportunity Cell','Inclusivity & Equal Rights',
'<p>This cell ensures that no student faces discrimination on the grounds of caste, creed, religion, economic background, or physical ability.</p>
<ul>
<li>Personalized mentoring and academic counseling for marginalized students.</li>
<li>Workshops on gender equality and constitutional rights.</li>
<li>Prompt grievance redressal and psychological support.</li>
</ul>'),

('differently-abled','Facilities for Divyangjan','Accessibility & Inclusive Support',
'<ul>
<li>Ground-floor classroom access and ramp facilities across key buildings.</li>
<li>Scribe assistance and compensatory time during examinations as per university rules.</li>
<li>Priority issuance and assistance in the central library.</li>
<li>Support in applying for specialized disability scholarships.</li>
<li>Website with high-contrast accessibility mode.</li>
</ul>'),

('disadvantaged-groups','Disadvantaged Groups Cell','Supporting Underprivileged Students',
'<p>This cell focuses on retaining students from economically and socially underprivileged backgrounds in higher education.</p>
<ul>
<li>Facilitating government financial aid and fee waivers.</li>
<li>Free distribution of textbooks and reference learning kits.</li>
<li>Remedial and tutorial classes after regular lectures.</li>
<li>Parent engagement to prevent dropouts and encourage completion of degrees.</li>
</ul>'),

('alumni','Alumni Association','Lifelong Bond with Our Graduates',
'<p>Our alumnae are the pride and ambassadors of the institution. The Alumni Association connects past graduates with current students.</p>
<h3>Association Objectives</h3>
<ul>
<li>Mentorship and motivational talks for enrolled students.</li>
<li>Annual alumni reunion meet and networking.</li>
<li>Career advice and guidance for competitive examinations.</li>
<li>Contribution towards institutional development and scholarships.</li>
</ul>
<p>To register as an alumna, fill out the <a href="contact.php">Contact Form</a>.</p>'),

('rti','Right to Information (RTI)','Transparency & Public Accountability',
'<p>Citizens can seek institutional information under the Right to Information Act 2005.</p>
<table>
<tr><th>Role</th><th>Designated Officer</th></tr>
<tr><td>Public Information Officer (PIO)</td><td>Principal</td></tr>
<tr><td>Assistant Public Information Officer (APIO)</td><td>Head Clerk</td></tr>
<tr><td>First Appellate Authority (FAA)</td><td>Manager</td></tr>
</table>
<h3>Filing Procedure</h3>
<ul>
<li>Submit a written application in the prescribed format to the office.</li>
<li>Application fee of ₹10 (as per government rules).</li>
<li>Information is ordinarily furnished within 30 days of application receipt.</li>
</ul>'),

('newsletters','College Newsletters','Annual Chronicle & Publications',
'<p>Our annual newsletters highlight the academic achievements, cultural festivals, student write-ups, and institutional milestones of each session.</p>
<p>Download recent newsletter editions from the <a href="notices.php">Notices section</a>. Students can submit articles, essays, and poems for publication at the editorial desk.</p>'),

('job-openings','Job Openings','Employment & Career Opportunities',
'<p>Gyandayini Women\'s College invites applications for teaching and non-teaching positions from time to time as per vacancies.</p>
<p>Currently, there are no active vacancies. Prospective candidates may send their updated CV to <strong>info@gyandayanigmmv.com</strong> for future consideration.</p>'),

('academic-collaboration','Academic Collaboration','Institutional Partnerships & Linkages',
'<p>The college collaborates with diverse academic institutions, NGOs, and community bodies to enrich the student learning experience.</p>
<ul>
<li>Academic alignment and faculty exchange with university departments.</li>
<li>Educational outreach and interaction with regional schools.</li>
<li>Skill development and vocational training workshops.</li>
<li>Community service drives with NSS and social welfare organizations.</li>
</ul>');

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `image` VARCHAR(255) NOT NULL,
  `caption` VARCHAR(200) DEFAULT '',
  `sub_caption` VARCHAR(255) DEFAULT '',
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sliders` (`image`,`caption`,`sub_caption`,`sort_order`) VALUES
('https://gyandayanigmmv.com/wp-content/uploads/2026/05/College-building-scaled.jpg','Campus Infrastructure','Peaceful, secure, and disciplined academic environment',1),
('https://gyandayanigmmv.com/wp-content/uploads/2026/05/481806585_951523443852198_5597899675212083623_n.jpg','Education with Values','Dedicated to empowering every woman towards self-reliance',2),
('https://gyandayanigmmv.com/wp-content/uploads/2026/05/481779223_951523487185527_248403223807654509_n.jpg','Vibrant Campus Life','Sports, cultural celebrations, and community service',3);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `notice_date` DATE NULL,
  `file_path` VARCHAR(255) DEFAULT '',
  `link_url` VARCHAR(255) DEFAULT '',
  `is_new` TINYINT(1) DEFAULT 1,
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notices` (`title`,`notice_date`,`is_new`,`sort_order`) VALUES
('Session 2026-27: Admissions Open for B.A. and B.Com. First Year','2026-06-15',1,1),
('List of Required Documents for Online UP Scholarship Application','2026-07-05',1,2),
('College Prospectus & Guidelines for Session 2026-27 Available at Office','2026-06-20',0,3),
('Important Notice Regarding Last Date for University Examination Forms','2026-02-10',0,4),
('Mandatory Anti-Ragging Affidavit Submission for All Enrolled Students','2026-08-01',1,5);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(160) NOT NULL,
  `short_name` VARCHAR(60) DEFAULT '',
  `duration` VARCHAR(60) DEFAULT '',
  `eligibility` VARCHAR(255) DEFAULT '',
  `subjects` TEXT,
  `seats` VARCHAR(60) DEFAULT '',
  `description` TEXT,
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `courses` (`name`,`short_name`,`duration`,`eligibility`,`subjects`,`seats`,`description`,`sort_order`) VALUES
('Bachelor of Arts','B.A.','3 Years (6 Semesters)','10+2 / Intermediate Pass','Hindi, English, Sociology, Ancient History, Political Science, Geography, Home Science, Education','Merit Based','The Faculty of Arts enables students to choose multidisciplinary subject combinations tailored to their academic and career goals, offering a solid foundation for teaching, civil services, and competitive examinations.',1),
('Bachelor of Commerce','B.Com.','3 Years (6 Semesters)','10+2 / Intermediate (Commerce / Any Stream) Pass','Financial Accounting, Business Economics, Business Organization, Auditing, Statistics, Taxation','Merit Based','The Faculty of Commerce prepares students for dynamic careers in accounting, banking, insurance, finance, and corporate management.',2);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `faculty`;
CREATE TABLE `faculty` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(160) NOT NULL,
  `designation` VARCHAR(120) DEFAULT '',
  `department` VARCHAR(120) DEFAULT '',
  `qualification` VARCHAR(200) DEFAULT '',
  `photo` VARCHAR(255) DEFAULT '',
  `email` VARCHAR(120) DEFAULT '',
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faculty` (`name`,`designation`,`department`,`qualification`,`sort_order`) VALUES
('—','Principal','Administration','M.A., Ph.D.',1),
('—','Assistant Professor','Hindi','M.A., NET',2),
('—','Assistant Professor','Sociology','M.A.',3),
('—','Assistant Professor','Ancient History','M.A.',4),
('—','Assistant Professor','Political Science','M.A.',5),
('—','Assistant Professor','Home Science','M.Sc.',6),
('—','Assistant Professor','Commerce','M.Com.',7);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `leaders`;
CREATE TABLE `leaders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(160) NOT NULL,
  `designation` VARCHAR(160) DEFAULT '',
  `photo` VARCHAR(255) DEFAULT '',
  `link_url` VARCHAR(255) DEFAULT '',
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `leaders` (`name`,`designation`,`photo`,`link_url`,`sort_order`) VALUES
('Late Kalika Pandey','Dedication & Foundation (01.10.1917 – 08.11.2008)','','page/our-inspiration',1),
('Late Shyam Narayan Pandey','Founder – Director (01.07.1951 – 17.11.2016)','https://gyandayanigmmv.com/wp-content/uploads/2026/05/S.N.-Pandey-scaled.jpg','page/our-inspiration',2),
('Late Satyabhama Pandey','Founder – Manager (01.07.1947 – 01.05.2021)','https://gyandayanigmmv.com/wp-content/uploads/2026/05/Satya-Bhama-Pandey-scaled.jpg','page/our-inspiration',3);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `quicklinks`;
CREATE TABLE `quicklinks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(120) NOT NULL,
  `icon` VARCHAR(60) DEFAULT 'link',
  `url` VARCHAR(255) DEFAULT '#',
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `quicklinks` (`title`,`icon`,`url`,`sort_order`) VALUES
('Apply for Admission','edit','admission.php',1),
('UP Scholarship Portal','coin','https://scholarship.up.gov.in',2),
('MGKVP University','university','https://www.mgkvp.ac.in',3),
('Exam Results','result','#',4),
('Courses & Syllabi','book','courses.php',5),
('College Prospectus','file','page/prospectus',6),
('Anti-Ragging Cell','shield','page/anti-ragging-cell',7),
('Contact Us','phone','contact.php',8);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) DEFAULT '',
  `category` VARCHAR(100) DEFAULT 'Campus',
  `image` VARCHAR(255) NOT NULL,
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `gallery` (`title`,`category`,`image`,`sort_order`) VALUES
('College Main Building','Campus','https://gyandayanigmmv.com/wp-content/uploads/2026/05/College-building-scaled.jpg',1),
('Campus Event Highlights','Events','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481806585_951523443852198_5597899675212083623_n.jpg',2),
('Campus Celebration Moments','Events','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481779223_951523487185527_248403223807654509_n.jpg',3),
('Annual Sports & Cultural Day','Events','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481260593_951523350518874_6994401351672395813_n.jpg',4),
('Academic & Workshop Activities','Events','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481701687_951523450518864_2708532927571556395_n.jpg',5),
('Student Seminar Sessions','Events','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481663286_951523293852213_7466308168845127883_n.jpg',6),
('Community Service & NSS Activities','Events','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481812548_951523287185547_881003595673824686_n.jpg',7);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(220) NOT NULL,
  `event_date` DATE NULL,
  `image` VARCHAR(255) DEFAULT '',
  `description` TEXT,
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `events` (`title`,`event_date`,`image`,`description`,`sort_order`) VALUES
('Independence Day Celebration','2026-08-15','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481806585_951523443852198_5597899675212083623_n.jpg','Flag hoisting ceremony, patriotic songs, and vibrant cultural performances celebrated with high enthusiasm.',1),
('Fresher Orientation Program','2026-08-20','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481779223_951523487185527_248403223807654509_n.jpg','Warm welcome for the incoming batch of students with an orientation on college academics and campus facilities.',2),
('Annual Sports Meet','2026-11-20','https://gyandayanigmmv.com/wp-content/uploads/2026/05/481260593_951523350518874_6994401351672395813_n.jpg','Enthusiastic student participation in kabaddi, kho-kho, badminton, and track and field athletics competitions.',3);

-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE `enquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(160) NOT NULL,
  `phone` VARCHAR(30) DEFAULT '',
  `email` VARCHAR(160) DEFAULT '',
  `course` VARCHAR(120) DEFAULT '',
  `subject` VARCHAR(200) DEFAULT '',
  `message` TEXT,
  `type` VARCHAR(30) DEFAULT 'contact',
  `is_read` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
