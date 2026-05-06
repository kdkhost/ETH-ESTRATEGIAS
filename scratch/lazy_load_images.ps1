$viewsDir = "g:\Tudo\MEU-SISTEMA\ETH ESTRATEGIAS\resources\views"
$files = Get-ChildItem -Path $viewsDir -Filter "*.blade.php" -Recurse

foreach ($file in $files) {
    # Ignorar arquivos do admin, focar no frontend e components
    if ($file.FullName -match "\\admin\\" -or $file.FullName -match "layout") { continue }
    
    $content = Get-Content -Path $file.FullName -Raw
    
    # Adicionar loading="lazy" a imagens que não o possuem
    if ($content -match '<img') {
        # Usar uma substituição segura com regex para <img ... >
        # Para evitar adicionar se já existir
        if ($content -notmatch 'loading="lazy"') {
            $content = $content -replace '<img\s', '<img loading="lazy" '
            Set-Content -Path $file.FullName -Value $content
            Write-Host "Lazy Load injetado: $($file.Name)"
        }
    }
}
