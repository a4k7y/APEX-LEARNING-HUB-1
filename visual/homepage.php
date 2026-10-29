<?php
$pageTitle = 'APEX Learning Hub — Home';
$activePage = 'home';
$bodyClass = 'home-page';
include '_partials/head.php';
?>

<main id="home">

    <!-- =============================================================
         1. HERO SECTION (Serif Font, Left-Aligned, No Chevron Icons)
         ============================================================= -->
    <section class="hero-section">
        <div class="hero-glow-blob" aria-hidden="true"></div>
        <div class="hero-glow-blob-2" aria-hidden="true"></div>

        <div class="hero-content">
            <h1 class="hero-title">
                <span data-lang-en>Learn<br>Advance<br>Achieve</span>
                <span data-lang-fil>Matuto<br>Umunlad<br>Magtagumpay</span>
            </h1>

            <p class="hero-desc">
                <span data-lang-en>Welcome to APEX, institution that supports students, faculty, and
                    administrators with simple, effective digital learning site.</span>
                <span data-lang-fil>Maligayang pagdating sa APEX, isang institusyong sumusuporta sa mga mag-aaral,
                    guro, at administrador sa pamamagitan ng simple at mahusay na digital na lugar para sa pag-aaral.</span>
            </p>

            <div class="hero-cta-group">
                <!-- Button 1: Explore Offerings -->
                <a href="#offerings" class="btn-hero-primary" id="btnExploreOfferings">
                    <span data-lang-en>Explore</span>
                    <span data-lang-fil>Tuklasin</span>
                </a>


                <!-- Button 3: Enter Portal -->
                <a href="../auth/login.php" class="btn-hero-secondary">
                    <span data-lang-en>Sign In to Portal</span>
                    <span data-lang-fil>Mag-sign in sa Portal</span>
                </a>
            </div>
        </div>
    </section>

    <!-- =============================================================
         2. WHAT WE OFFER (Picture Containers with Hover-Up & Border Highlight)
         ============================================================= -->
    <section class="section" id="offerings">
        <div class="container">
            <div class="section-header-block">
                <h2 class="section-title centered" data-lang-en>What APEX Offers</h2>
                <h2 class="section-title centered" data-lang-fil style="display:none;">Mga Iniaalok ng APEX
                </h2>
            </div>

            <div class="media-carousel" role="region" aria-label="What APEX Learning Hub Offers">
                <button class="media-carousel-arrow" type="button" data-direction="previous"
                    aria-label="Previous offering">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </button>
                <div class="media-carousel-viewport">
                    <div class="media-grid">
                        <!-- Card 1 -->
                        <article class="media-card" tabindex="0">
                            <div class="media-pic-wrap">
                                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=700&q=80"
                                    alt="Students studying with digital resources" loading="lazy">
                                <div class="media-pic-overlay"></div>
                                <span class="media-tag-badge"><span data-lang-en>Curriculum</span><span data-lang-fil style="display:none;">Kurikulum</span></span>
                            </div>
                            <div class="media-card-body">
                                <h3 class="media-card-title">
                                    <span data-lang-en>Comprehensive Digital Library</span>
                                    <span data-lang-fil>Malawak na Aklatan ng mga Digital na Sanggunian</span>
                                </h3>
                                <p class="media-card-desc">
                                    <span data-lang-en>Browse course offerings, review course details, and find syllabi,
                                        lecture presentations, lab exercises, and reference materials shared by faculty.
                                        Everything is organized for quick reference on desktop or mobile.</span>
                                    <span data-lang-fil>Mag-browse ng mga kurso, tingnan ang mga detalye nito, at hanapin ang mga silabus,
                                        presentasyon ng lektura, pagsasanay sa laboratoryo, at iba pang sangguniang ibinahagi ng mga guro.
                                        Maayos na nakaayos ang lahat upang madaling makita sa computer o cellphone.</span>
                                </p>
                            </div>
                        </article>

                        <!-- Card 2 -->
                        <article class="media-card" tabindex="0">
                            <div class="media-pic-wrap">
                                <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=700&q=80"
                                    alt="Interactive modern software interface" loading="lazy">
                                <div class="media-pic-overlay"></div>
                                <span class="media-tag-badge"><span data-lang-en>Coursework</span><span data-lang-fil style="display:none;">Kurso at mga Gawain</span></span>
                            </div>
                            <div class="media-card-body">
                                <h3 class="media-card-title">
                                    <span data-lang-en>Interactive Coursework Tracker</span>
                                    <span data-lang-fil>Tagasubaybay ng mga Kurso at Gawain</span>
                                </h3>
                                <p class="media-card-desc">
                                    <span data-lang-en>Keep approved courses, pending applications, and the course
                                        catalog in one place. Check assigned instructors, application updates, and
                                        course capacity as you plan your semester.</span>
                                    <span data-lang-fil>Nasa iisang lugar ang mga aprubadong kurso, nakabinbing aplikasyon, at katalogo ng mga kurso.
                                        Tingnan ang mga nakatalagang guro, update sa aplikasyon, at bilang ng bakanteng puwesto habang
                                        pinaplano ang iyong semestre.</span>
                                </p>
                            </div>
                        </article>

                        <!-- Card 3 -->
                        <article class="media-card" tabindex="0">
                            <div class="media-pic-wrap">
                                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=700&q=80"
                                    alt="Examinations and university notices" loading="lazy">
                                <div class="media-pic-overlay"></div>
                                <span class="media-tag-badge"><span data-lang-en>Bulletins</span><span data-lang-fil style="display:none;">Mga Anunsyo</span></span>
                            </div>
                            <div class="media-card-body">
                                <h3 class="media-card-title">
                                    <span data-lang-en>Institutional Bulletins &amp; Alerts</span>
                                    <span data-lang-fil>Mga Anunsyo at Abiso ng Paaralan</span>
                                </h3>
                                <p class="media-card-desc">
                                    <span data-lang-en>Find campus-wide notices and course-specific updates, including
                                        schedules, deadlines, and maintenance advisories. Each post includes its
                                        publishing details and relevant course context.</span>
                                    <span data-lang-fil>Basahin ang mga anunsyo para sa buong kampus at mga update para sa partikular na kurso,
                                        kabilang ang mga iskedyul, deadline, at abiso sa pagpapanatili ng sistema. Makikita sa bawat post
                                        ang petsa ng paglalathala at kaugnay na impormasyon tungkol sa kurso.</span>
                                </p>
                            </div>
                        </article>

                        <!-- Card 4 -->
                        <article class="media-card" tabindex="0">
                            <div class="media-pic-wrap">
                                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=700&q=80"
                                    alt="Professor mentorship and classroom discussion" loading="lazy">
                                <div class="media-pic-overlay"></div>
                                <span class="media-tag-badge"><span data-lang-en>Faculty</span><span data-lang-fil style="display:none;">Mga Guro</span></span>
                            </div>
                            <div class="media-card-body">
                                <h3 class="media-card-title">
                                    <span data-lang-en>Faculty Mentorship &amp; Evaluation</span>
                                    <span data-lang-fil>Paggabay at Pagsusuri ng mga Guro</span>
                                </h3>
                                <p class="media-card-desc">
                                    <span data-lang-en>See which faculty members are assigned to each course and follow
                                        enrollment requests through review. Course-level announcements help keep
                                        important learning updates connected to the right class.</span>
                                    <span data-lang-fil>Tingnan kung aling mga guro ang nakatalaga sa bawat kurso at subaybayan ang mga aplikasyon
                                        habang sinusuri ang mga ito. Iniuugnay ng mga anunsyo para sa bawat kurso ang mahahalagang update
                                        sa tamang klase.</span>
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
                <button class="media-carousel-arrow" type="button" data-direction="next" aria-label="Next offering">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- =============================================================
         3. LATEST ANNOUNCEMENTS
         ============================================================= -->
    <section class="section" id="announcements">
        <div class="container">
            <div class="section-header-block announcement-header">
                <h2 class="section-title centered" data-lang-en>Latest Announcements</h2>
                <h2 class="section-title centered" data-lang-fil style="display:none;">Pinakabagong mga Anunsyo</h2>
            </div>

            <div class="home-card-carousel" role="region" aria-label="Latest announcements carousel">
                <button class="media-carousel-arrow" type="button" data-direction="previous"
                    aria-label="Previous announcement">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </button>
                <div class="home-card-carousel-viewport">
                    <div class="announcement-cards-grid home-card-carousel-track">
                <!-- Ann 1 -->
                <article class="ann-card" onclick="window.location.href='announcement.php'">
                    <div>
                        <div class="ann-badge-row">
                            <span class="badge-tag badge-academic" data-lang-en>Academic Advisory</span>
                            <span class="badge-tag badge-academic" data-lang-fil style="display:none;">Abisong Akademiko</span>
                            <span class="ann-date"><span data-lang-en>October 24, 2026</span><span data-lang-fil>Oktubre 24, 2026</span></span>
                        </div>
                        <h3 class="ann-title">
                            <span data-lang-en>Midterm Examination Schedule Released</span>
                            <span data-lang-fil>Inilabas na ang Iskedyul ng mga Pagsusulit sa Midterm</span>
                        </h3>
                        <p class="ann-snippet">
                            <span data-lang-en>Room allocations, proctor schedules, and subject time slots are
                                finalized. Check your registered student portal for individual schedules.</span>
                            <span data-lang-fil>Itinakda na ang mga silid, tagapagbantay, at oras ng pagsusulit. Tingnan ang iyong portal ng mag-aaral
                                para sa iskedyul mo.</span>
                        </p>
                    </div>
                </article>

                <!-- Ann 2 -->
                <article class="ann-card" onclick="window.location.href='announcement.php'">
                    <div>
                        <div class="ann-badge-row">
                            <span class="badge-tag badge-system" data-lang-en>System Maintenance</span>
                            <span class="badge-tag badge-system" data-lang-fil style="display:none;">Pagpapanatili ng Sistema</span>
                            <span class="ann-date"><span data-lang-en>October 20, 2026</span><span data-lang-fil>Oktubre 20, 2026</span></span>
                        </div>
                        <h3 class="ann-title">
                            <span data-lang-en>Scheduled LMS Infrastructure Upgrade</span>
                            <span data-lang-fil>Nakatakdang Pag-upgrade ng Sistema ng LMS</span>
                        </h3>
                        <p class="ann-snippet">
                            <span data-lang-en>Routine database optimization and security maintenance will be conducted
                                this Saturday from 2:00 AM to 4:00 AM UTC. Plan uploads accordingly.</span>
                            <span data-lang-fil>Isasagawa ang regular na pag-optimize ng database at pagpapanatili ng seguridad sa Sabado,
                                mula 2:00 hanggang 4:00 ng madaling-araw (UTC). Planuhin nang maaga ang pag-upload ng mga file.</span>
                        </p>
                    </div>
                </article>

                <!-- Ann 3 -->
                <article class="ann-card" onclick="window.location.href='announcement.php'">
                    <div>
                        <div class="ann-badge-row">
                            <span class="badge-tag badge-event" data-lang-en>Admissions Notice</span>
                            <span class="badge-tag badge-event" data-lang-fil style="display:none;">Abiso sa Pagpapatala</span>
                            <span class="ann-date"><span data-lang-en>October 18, 2026</span><span data-lang-fil>Oktubre 18, 2026</span></span>
                        </div>
                        <h3 class="ann-title">
                            <span data-lang-en>Second Semester Course Enrollment Deadline</span>
                            <span data-lang-fil>Huling Araw ng Pagpapatala para sa Ikalawang Semestre</span>
                        </h3>
                        <p class="ann-snippet">
                            <span data-lang-en>Course application queues close on November 8, 2026. Ensure that all
                                course requests are submitted to instructors before the cut-off.</span>
                            <span data-lang-fil>Magsasara ang mga aplikasyon para sa kurso sa Nobyembre 8, 2026. Isumite sa mga guro ang lahat ng
                                kahilingan bago ang huling araw.</span>
                        </p>
                    </div>
                </article>
                    </div>
                </div>
                <button class="media-carousel-arrow" type="button" data-direction="next"
                    aria-label="Next announcement">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </div>

            <div class="section-action-center">
                <a href="announcement.php" class="btn-all-bulletins">
                    <span data-lang-en>View All Past Bulletins &amp; Archives &rarr;</span>
                    <span data-lang-fil>Tingnan ang Lahat ng Naunang Anunsyo at mga Naka-archive &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- =============================================================
         4. INTERACTIVE CHEVRON ACCORDION (Campus Essentials & FAQ)
         ============================================================= -->
    <section class="section section-alt" id="essentials">
        <div class="container">
            <div class="section-header-block">
                <h2 class="section-title centered" data-lang-en>Campus Essentials &amp;<br> Student Guide</h2>
                <h2 class="section-title centered" data-lang-fil style="display:none;">Mahahalagang Impormasyon sa Kampus at Gabay ng Mag-aaral</h2>
            </div>

            <div class="home-card-carousel" role="region" aria-label="Student guide carousel">
                <button class="media-carousel-arrow" type="button" data-direction="previous"
                    aria-label="Previous student guide card">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </button>
                <div class="home-card-carousel-viewport">
                    <div class="guide-cards-grid home-card-carousel-track">
                <!-- Item 1 -->
                <article class="guide-card">
                    <div class="ann-badge-row">
                        <span class="badge-tag badge-academic" data-lang-en>Course Enrollment</span>
                        <span class="badge-tag badge-academic" data-lang-fil style="display:none;">Pagpapatala sa Kurso</span>
                    </div>
                    <h3 class="ann-title">
                        <span data-lang-en>How do students enroll in courses for the new semester?</span>
                        <span data-lang-fil>Paano magpatala ng mga kurso para sa bagong semestre?</span>
                    </h3>
                    <div class="guide-answer">
                        <p class="guide-answer-copy" data-lang-en>
                            Registered students can sign in to their student workspace, navigate to the Course Catalog,
                            and submit enrollment applications with a single click. Your professor will review and
                            approve pending requests directly.
                        </p>
                        <p class="guide-answer-copy" data-lang-fil style="display:none;">
                            Mag-sign in sa iyong workspace ng mag-aaral, buksan ang Katalogo ng Kurso, at isumite ang aplikasyon sa pagpapatala
                            sa isang pindot. Susuriin at aaprubahan ng iyong guro ang mga nakabinbing kahilingan.
                        </p>
                    </div>
                    <button type="button" class="guide-toggle" aria-expanded="false">
                        Read more
                    </button>
                </article>

                <!-- Item 2 -->
                <article class="guide-card">
                    <div class="ann-badge-row">
                        <span class="badge-tag badge-system" data-lang-en>Announcements</span>
                        <span class="badge-tag badge-system" data-lang-fil style="display:none;">Mga Anunsyo</span>
                    </div>
                    <h3 class="ann-title">
                        <span data-lang-en>Where can I check exam schedules and faculty announcements?</span>
                        <span data-lang-fil>Saan ko makikita ang iskedyul ng pagsusulit at mga anunsyo ng mga guro?</span>
                    </h3>
                    <div class="guide-answer">
                        <p class="guide-answer-copy" data-lang-en>
                            All official updates, midterm room assignments, and maintenance alerts are posted on our
                            public Announcements page as well as inside the authenticated student and faculty feeds.
                        </p>
                        <p class="guide-answer-copy" data-lang-fil style="display:none;">
                            Inilalathala ang lahat ng opisyal na update, takdang silid para sa midterm, at abiso sa pagpapanatili ng sistema
                            sa pampublikong pahina ng Mga Anunsyo at sa mga feed ng mag-aaral at guro.
                        </p>
                    </div>
                    <a href="announcement.php" class="guide-card-link">
                        <span data-lang-en>Go to Announcements Page &rarr;</span>
                        <span data-lang-fil>Pumunta sa pahina ng Mga Anunsyo &rarr;</span>
                    </a>
                    <button type="button" class="guide-toggle" aria-expanded="false">
                        Read more
                    </button>
                </article>

                <!-- Item 3 -->
                <article class="guide-card">
                    <div class="ann-badge-row">
                        <span class="badge-tag badge-event" data-lang-en>Academic Policies</span>
                        <span class="badge-tag badge-event" data-lang-fil style="display:none;">Mga Patakarang Pang-akademiko</span>
                    </div>
                    <h3 class="ann-title">
                        <span data-lang-en>What are the institutional policies on attendance and grading?</span>
                        <span data-lang-fil>Ano ang mga patakaran ng institusyon tungkol sa pagdalo at pagmamarka?</span>
                    </h3>
                    <div class="guide-answer">
                        <p class="guide-answer-copy" data-lang-en>
                            A minimum of 80% attendance is strictly enforced across all academic courses. The grading
                            scale follows standard percentage computation (Quizzes 30%, Midterm 30%, Final 30%,
                            Participation 10%).
                        </p>
                        <p class="guide-answer-copy" data-lang-fil style="display:none;">
                            Kinakailangang makadalo ang mga mag-aaral sa hindi bababa sa 80% ng mga klase. Hinahati ang marka sa mga pagsusulit
                            (30%), midterm (30%), final (30%), at pakikilahok (10%).
                        </p>
                    </div>
                    <a href="policies.php" class="guide-card-link">
                        <span data-lang-en>Read Complete Policies &rarr;</span>
                        <span data-lang-fil>Basahin ang Buong Patakaran &rarr;</span>
                    </a>
                    <button type="button" class="guide-toggle" aria-expanded="false">
                        Read more
                    </button>
                </article>

                <!-- Item 4 -->
                <article class="guide-card">
                    <div class="ann-badge-row">
                        <span class="badge-tag badge-event" data-lang-en>Support</span>
                        <span class="badge-tag badge-event" data-lang-fil style="display:none;">Suporta</span>
                    </div>
                    <h3 class="ann-title">
                        <span data-lang-en>How can I contact technical support or admissions officers?</span>
                        <span data-lang-fil>Paano makikipag-ugnayan sa pangkat ng suporta sa teknikal na usapin o sa tanggapan ng pagpapatala?</span>
                    </h3>
                    <div class="guide-answer">
                        <p class="guide-answer-copy" data-lang-en>
                            Our support staff and department registrars are available from Monday to Friday, 8:00 AM to
                            5:00 PM. You can submit an inquiry through our Contact page or message support directly.
                        </p>
                        <p class="guide-answer-copy" data-lang-fil style="display:none;">
                            Naka-duty ang aming pangkat ng suporta at mga registrar ng departamento mula Lunes hanggang Biyernes, 8:00 ng umaga hanggang 5:00 ng hapon.
                            Magpadala ng tanong sa pahina ng Pakikipag-ugnayan o direktang makipag-ugnayan sa pangkat ng suporta.
                        </p>
                    </div>
                    <a href="contact.php" class="guide-card-link">
                        <span data-lang-en>Open Contact Page &rarr;</span>
                        <span data-lang-fil>Buksan ang Pahina ng Pakikipag-ugnayan &rarr;</span>
                    </a>
                    <button type="button" class="guide-toggle" aria-expanded="false">
                        Read more
                    </button>
                </article>
                    </div>
                </div>
                <button class="media-carousel-arrow" type="button" data-direction="next"
                    aria-label="Next student guide card">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- =============================================================
         5. ABOUT OUR SCHOOL
         ============================================================= -->
    <section class="about-school-section" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-text-col">
                    <h2 data-lang-en>About APEX</h2>
                    <h2 data-lang-fil style="display:none;">Kilalanin ang APEX</h2>

                    <p data-lang-en>
                        The Academy for Programming Excellence (APEX) is a physical school committed to supporting
                        students in their academic growth. APEX Learning Hub is the school's online learning platform,
                        created to make key academic information and resources easier for students to access wherever
                        they are. Through the Hub, students can review courses and schedules, keep track of learning
                        tasks, and find important announcements in one convenient place. It complements the school's
                        in-person learning environment by helping students stay informed and connected beyond the
                        classroom.
                    </p>
                    <p data-lang-fil style="display:none;">
                        Ang Academy for Programming Excellence (APEX) ay isang paaralang may pisikal na kampus na
                        nakatuon sa pagsuporta sa pag-unlad pang-akademiko ng mga mag-aaral. Ang APEX Learning Hub
                        naman ang online na plataporma ng paaralan upang mas madaling ma-access ng mga mag-aaral ang
                        mahahalagang impormasyong pang-akademiko at mga sanggunian saanman sila naroroon. Sa Hub,
                        maaaring tingnan ang mga kurso at iskedyul, subaybayan ang mga gawain, at hanapin ang mahahalagang
                        anunsyo sa iisang maginhawang lugar. Karagdagan ito sa harapang pagkatuto sa paaralan at
                        tumutulong upang manatiling may alam at konektado ang mga mag-aaral kahit wala sa silid-aralan.
                    </p>

                </div>
                <div class="about-values-grid">
                    <article class="about-value-card">
                        <h3 data-lang-en>Our Mission</h3>
                        <h3 data-lang-fil style="display:none;">Aming Misyon</h3>
                        <p data-lang-en>
                            To provide APEX students with an easy-to-access online learning hub for course information,
                            learning resources, tasks, schedules, and timely school updates that support their
                            education on and off campus.
                        </p>
                        <p data-lang-fil style="display:none;">
                            Magbigay sa mga mag-aaral ng APEX ng madaling ma-access na online learning hub para sa
                            impormasyon ng kurso, mga sanggunian sa pag-aaral, gawain, iskedyul, at napapanahong
                            mga anunsyo ng paaralan na sumusuporta sa kanilang pag-aaral sa loob at labas ng kampus.
                        </p>
                    </article>
                    <article class="about-value-card">
                        <h3 data-lang-en>Our Vision</h3>
                        <h3 data-lang-fil style="display:none;">Aming Bisyon</h3>
                        <p data-lang-en>
                            To help every APEX student stay connected to learning through a welcoming, reliable, and
                            accessible online hub that makes academic information easier to find and use.
                        </p>
                        <p data-lang-fil style="display:none;">
                            Tulungan ang bawat mag-aaral ng APEX na manatiling konektado sa pagkatuto sa pamamagitan ng
                            maaasahan at madaling ma-access na online hub na nagpapadali sa paghahanap at paggamit ng
                            impormasyong pang-akademiko.
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include '_partials/foot.php'; ?>