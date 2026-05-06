$viewsDir = "g:\Tudo\MEU-SISTEMA\ETH ESTRATEGIAS\resources\views"
$files = @(
    "$viewsDir\page\page-create.blade.php",
    "$viewsDir\post\post-create.blade.php",
    "$viewsDir\post\post-edit.blade.php"
)

$seoCard = @"
                    <!-- Módulo SEO Premium -->
                    <div class="col-12 mt-4">
                        <div class="card shadow border-0 text-bg-indigo" style="background-color: #6610f2 !important;">
                            <div class="card-header py-3 border-0 bg-transparent">
                                <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-search me-2"></i> SEO Avançado (Google)</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75 small">Meta Título (Máx 60 caracteres)</label>
                                        <input type="text" name="meta_title" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" placeholder="Título chamativo para o Google" value="{{ isset(`$page) ? `$page->meta_title : (isset(`$post) ? `$post->meta_title : '') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-white opacity-75 small">Meta Descrição (Máx 160 caracteres)</label>
                                        <input type="text" name="meta_description" class="form-control bg-white bg-opacity-10 text-white border-0 shadow-none" placeholder="Resumo magnético para aumentar cliques" value="{{ isset(`$page) ? `$page->meta_description : (isset(`$post) ? `$post->meta_description : '') }}">
                                    </div>
                                </div>
                                <div class="mt-3 text-white-50 small">
                                    <i class="fas fa-info-circle me-1"></i> Preencha estes campos para que o link fique com miniatura e resumo profissional ao ser compartilhado no WhatsApp ou Facebook.
                                </div>
                            </div>
                        </div>
                    </div>
"@

foreach ($file in $files) {
    if (Test-Path $file) {
        $content = Get-Content -Path $file -Raw
        
        # Expressão regular para encontrar e remover os inputs antigos de meta_title e meta_description
        # Vamos remover tudo desde <div class="col-md-6"> que contém name="meta_title" até o final da div do meta_description
        $content = $content -replace '(?s)<div class="col-md-6">\s*<div class="form-group[^>]*">\s*<label[^>]*>.*?meta_title.*?</div>\s*</div>\s*<div class="col-md-6">\s*<div class="form-group[^>]*">\s*<label[^>]*>.*?meta_description.*?</div>\s*</div>', $seoCard
        
        # Se for um post-edit, o HTML pode ser diferente, então fazemos um replace mais genérico
        $content = $content -replace '(?s)<label class="form-label fw-bold">\{\{clean\( trans\(''niva-backend.meta_title''\) \)\}\}</label>\s*<input type="text" name="meta_title".*?</label>\s*<input type="text" name="meta_description"[^>]*>', $seoCard
        
        Set-Content -Path $file -Value $content
        Write-Host "SEO Premium injetado em: $file"
    }
}
