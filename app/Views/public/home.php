<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<section id="home" class="hero-panel mb-4 mb-lg-5">
    <div class="row align-items-center g-4 g-lg-5">
        <div class="col-lg-7">
            <span class="eyebrow mb-3"><i class="bi bi-stars"></i> Eskola Secundaria Geral Venilale</span>
            <h1 class="display-title fw-black mb-3" style="font-size: clamp(2.5rem, 7vw, 4.8rem);">
                Bemvindo informasaun konaba Eskola Secundaria Geral Venilale
            </h1>
            <p class="lead-copy mb-4">
                Eskola ida ne'e publiku iha munisipiu Baucau, postu administrativu Venilale. Página ida ne'e halo informasaun publikamente liu husi layout modern no responsivu atu fasil dehan informasaun ba estudante, inan aman, no komunidade sira.
            </p>
            <div class="cta-group d-flex flex-column flex-sm-row gap-3">
                <a class="btn btn-brand" href="#about"><i class="bi bi-info-circle me-1"></i>Hatene liu tan</a>
                <a class="btn btn-outline-soft" href="<?= site_url('nilai') ?>"><i class="bi bi-search me-1"></i>Peskiza Valor</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="glass-card section-card">
                <div class="section-label mb-2">Informasaun Skola</div>
                <div class="stat mb-3">
                    <strong>Publiku</strong>
                    <span>Eskola secundária geral ida ne'e serve komunidade Venilale no area sira loron liu.</span>
                </div>
                <div class="stat mb-3">
                    <strong>Mobile responsive</strong>
                    <span>Desain hamosu ona ba telefóne, tablet, no desktop.</span>
                </div>
                <div class="stat">
                    <strong>Akses valor</strong>
                    <span>Estudante sira bele peskiza valor publicamente tuir naran.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="row g-4 mb-4 mb-lg-5">
    <div class="col-lg-6">
        <div class="glass-card section-card">
            <div class="section-label mb-2">1. Informasaun Geral</div>
            <h2 class="section-title mb-3">Detalhe prinsipál konaba eskola</h2>
            <ul class="info-list mb-0">
                <li><strong>Tipu:</strong> Eskola Secundaria Geral Publiku</li>
                <li><strong>Durasaun Kursu:</strong> tinan 3, tuir regras Ministeriu Edukasaun</li>
                <li><strong>Rekezitu tama:</strong> tenke kompleta ensinu baziku 9⁰ anu</li>
                <li><strong>Lokal:</strong> Venilale, Baucau</li>
            </ul>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="glass-card section-card">
            <div class="section-label mb-2">2. Kursu nebe iha</div>
            <h2 class="section-title mb-3">Oferta kursu no direksaun akademika</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="stat h-100">
                        <strong>Siensia Natural</strong>
                        <span>Ba estudante nebe gosta Matematika, Quimica, no Biologi.</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat h-100">
                        <strong>Siensia Sosial</strong>
                        <span>Ba estudante nebe gosta historia no geografis.</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="stat">
                        <strong>Lian</strong>
                        <span>Foku liu ba lian tetun, inglesh, no portugues.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="glass-card section-card mb-3 mb-lg-4">
    <div class="row g-4 align-items-center">
        <div class="col-lg-8">
            <div class="section-label mb-2">Contact no Anunsiu</div>
            <h2 class="section-title mb-3">Informasaun importante ba inan, aman, no komunidade</h2>
            <p class="muted mb-3">
                Anunsiu ba inan aman no komunidade sira bainhira rejistu 10⁰ ano iha escola secundaria Geral Venilale presija mak hanesan:
            </p>
            <div class="floating-note mb-3">
                Sertifikadu 9⁰ anu, kartaun Identidade, no foto 3×4. Atu hatene liu tan informasaun bele ba kontaktu diretamente iha eskola.
            </div>
            <p class="muted mb-0">
                Se hanoin atu haree valor estudante sira, bele uza menu Valor iha leten atu hetan página peskiza publik.
            </p>
        </div>
        <div class="col-lg-4">
            <div class="stat mb-3">
                <strong>Peskiza valor</strong>
                <span>Haburas akses direta ba informasaun akademika.</span>
            </div>
            <div class="stat">
                <strong>Komunidade</strong>
                <span>Eskola no komunidade servisu hamutuk ba edukasaun nebe di'ak.</span>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>