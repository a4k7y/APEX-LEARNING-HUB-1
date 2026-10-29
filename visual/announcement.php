<?php
$pageTitle  = 'Announcements — APEX Learning Hub';
$activePage = 'announcement';
include '_partials/head.php';
?>

<main>

<div class="page-band">
    <h1 data-lang-en>Announcements</h1>
    <h1 data-lang-fil style="display:none;">Mga Anunsyo</h1>
    <p data-lang-en>Stay updated with the latest news, advisories, and academic bulletins from APEX Learning Hub.</p>
    <p data-lang-fil style="display:none;">Sundan ang pinakabagong balita, abiso, at anunsyo mula sa APEX Learning Hub.</p>
</div>

<section class="section">
    <div class="container">

        
        <div class="filter-tabs" role="tablist">
            <button class="filter-tab active" data-filter="all" role="tab" aria-selected="true">
                <span data-lang-en>All Bulletins</span>
                <span data-lang-fil>Lahat ng Anunsyo</span>
            </button>
            <button class="filter-tab" data-filter="academic" role="tab">
                <span data-lang-en>Academic</span>
                <span data-lang-fil>Akademiko</span>
            </button>
            <button class="filter-tab" data-filter="system" role="tab">
                <span data-lang-en>System Updates</span>
                <span data-lang-fil>Mga Update sa Sistema</span>
            </button>
            <button class="filter-tab" data-filter="event" role="tab">
                <span data-lang-en>Campus Events</span>
                <span data-lang-fil>Mga Kaganapan sa Kampus</span>
            </button>
            <button class="filter-tab" data-filter="policy" role="tab">
                <span data-lang-en>Policy Notices</span>
                <span data-lang-fil>Mga Abiso sa Patakaran</span>
            </button>
        </div>

        <div class="announcement-grid" id="announcementList">

            
            <article class="announcement-card" data-category="academic">
                <span class="badge badge-coral" data-lang-en>Academic</span>
                <span class="badge badge-coral" data-lang-fil style="display:none;">Akademiko</span>
                <time datetime="2026-10-24"><span data-lang-en>October 24, 2026</span><span data-lang-fil style="display:none;">Oktubre 24, 2026</span></time>
                <h3 data-lang-en>Midterm Examination Schedule Released</h3>
                <h3 data-lang-fil style="display:none;">Inilabas na ang Iskedyul ng Pagsusulit sa Kalagitnaan ng Semestre</h3>
                <p data-lang-en>
                    The complete midterm examination schedule is now available in the student portal.
                    Please check your assigned rooms and time slots and prepare accordingly.
                </p>
                <p data-lang-fil style="display:none;">
                    Makikita na sa portal ng mag-aaral ang kumpletong iskedyul ng pagsusulit sa kalagitnaan ng semestre.
                    Tingnan ang itinalagang silid at oras ng pagsusulit at maghanda.
                </p>
            </article>

            <article class="announcement-card" data-category="academic">
                <span class="badge badge-coral" data-lang-en>Academic</span>
                <span class="badge badge-coral" data-lang-fil style="display:none;">Akademiko</span>
                <time datetime="2026-10-18"><span data-lang-en>October 18, 2026</span><span data-lang-fil style="display:none;">Oktubre 18, 2026</span></time>
                <h3 data-lang-en>Enrollment Deadline — 2nd Semester</h3>
                <h3 data-lang-fil style="display:none;">Huling Araw ng Pagpapatala — Ikalawang Semestre</h3>
                <p data-lang-en>
                    Enrollment for the second semester closes on November 8, 2026.
                    Complete all requirements before the deadline to secure your slot.
                </p>
                <p data-lang-fil style="display:none;">
                    Magsasara ang pagpapatala para sa ikalawang semestre sa Nobyembre 8, 2026.
                    Kumpletuhin ang lahat ng kinakailangan bago ang huling araw.
                </p>
            </article>

            
            <article class="announcement-card" data-category="system">
                <span class="badge badge-teal" data-lang-en>System</span>
                <span class="badge badge-teal" data-lang-fil style="display:none;">Sistema</span>
                <time datetime="2026-10-20"><span data-lang-en>October 20, 2026</span><span data-lang-fil style="display:none;">Oktubre 20, 2026</span></time>
                <h3 data-lang-en>Scheduled Maintenance — October 25</h3>
                <h3 data-lang-fil style="display:none;">Nakatakdang Pagpapanatili ng Sistema — Oktubre 25</h3>
                <p data-lang-en>
                    The portal will be offline for routine maintenance on October 25, 2:00 AM – 4:00 AM UTC.
                    Please save all pending work before this window.
                </p>
                <p data-lang-fil style="display:none;">
                    Hindi maa-access ang portal habang isinasagawa ang regular na pagpapanatili sa Oktubre 25, mula 2:00 hanggang 4:00 ng madaling-araw (UTC).
                    I-save muna ang lahat ng kasalukuyang gawain.
                </p>
            </article>

            <article class="announcement-card" data-category="system">
                <span class="badge badge-teal" data-lang-en>System</span>
                <span class="badge badge-teal" data-lang-fil style="display:none;">Sistema</span>
                <time datetime="2026-10-10"><span data-lang-en>October 10, 2026</span><span data-lang-fil style="display:none;">Oktubre 10, 2026</span></time>
                <h3 data-lang-en>Portal Password Policy Updated</h3>
                <h3 data-lang-fil style="display:none;">Na-update ang Patakaran sa Password ng Portal</h3>
                <p data-lang-en>
                    All users are required to reset their portal passwords by October 31 to comply with
                    the updated data security policy.
                </p>
                <p data-lang-fil style="display:none;">
                    Kailangang palitan ng lahat ng gumagamit ang kanilang password sa portal bago sumapit ang Oktubre 31
                    upang makasunod sa na-update na patakaran sa seguridad ng datos.
                </p>
            </article>

            
            <article class="announcement-card" data-category="event">
                <span class="badge badge-navy" data-lang-en>Event</span>
                <span class="badge badge-navy" data-lang-fil style="display:none;">Kaganapan</span>
                <time datetime="2026-10-15"><span data-lang-en>October 15, 2026</span><span data-lang-fil style="display:none;">Oktubre 15, 2026</span></time>
                <h3 data-lang-en>Academic Year Opening Ceremony</h3>
                <h3 data-lang-fil style="display:none;">Seremonya ng Pagbubukas ng Taong Akademiko</h3>
                <p data-lang-en>
                    Join us for the formal opening of the new academic year. All students and faculty
                    members are encouraged to attend.
                </p>
                <p data-lang-fil style="display:none;">
                    Dumalo sa pormal na pagbubukas ng bagong taong akademiko. Hinihikayat ang lahat
                    ng mag-aaral at guro na makilahok.
                </p>
            </article>

            <article class="announcement-card" data-category="event">
                <span class="badge badge-navy" data-lang-en>Event</span>
                <span class="badge badge-navy" data-lang-fil style="display:none;">Kaganapan</span>
                <time datetime="2026-11-05"><span data-lang-en>November 5, 2026</span><span data-lang-fil style="display:none;">Nobyembre 5, 2026</span></time>
                <h3 data-lang-en>Student Leadership Summit 2026</h3>
                <h3 data-lang-fil style="display:none;">Pagtitipon ng mga Lider ng Mag-aaral 2026</h3>
                <p data-lang-en>
                    Nominations for student organization positions are now open. Deadline for submission
                    is November 5, 2026.
                </p>
                <p data-lang-fil style="display:none;">
                    Tumatanggap na ng nominasyon para sa mga posisyon sa organisasyon ng mag-aaral.
                    Ang huling araw ng pagsusumite ay Nobyembre 5, 2026.
                </p>
            </article>

            
            <article class="announcement-card" data-category="policy">
                <span class="badge badge-navy" data-lang-en>Policy</span>
                <span class="badge badge-navy" data-lang-fil style="display:none;">Patakaran</span>
                <time datetime="2026-10-01"><span data-lang-en>October 1, 2026</span><span data-lang-fil style="display:none;">Oktubre 1, 2026</span></time>
                <h3 data-lang-en>Updated Academic Integrity Guidelines</h3>
                <h3 data-lang-fil style="display:none;">Na-update na mga Alituntunin ng Integridad sa Akademiko</h3>
                <p data-lang-en>
                    The Academic Integrity Policy has been updated to include AI-generated content guidelines.
                    Review the updated policy on the Policies page.
                </p>
                <p data-lang-fil style="display:none;">
                    Binago ang Patakaran sa Integridad ng Akademiko upang isama ang mga alituntunin
                    tungkol sa nilalamang nilikha gamit ang AI. Basahin ang na-update na patakaran sa pahina ng Mga Patakaran.
                </p>
            </article>

        </div>
    </div>
</section>

</main>

<?php include '_partials/foot.php'; ?>
