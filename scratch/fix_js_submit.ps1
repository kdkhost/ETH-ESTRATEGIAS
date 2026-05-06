$viewsDir = "g:\Tudo\MEU-SISTEMA\ETH ESTRATEGIAS\resources\views"
$files = Get-ChildItem -Path $viewsDir -Filter "*-index.blade.php" -Recurse

foreach ($file in $files) {
    $content = Get-Content -Path $file.FullName -Raw
    
    if ($content -match 'this\.submit\(\);') {
        # Check if we already injected it
        if ($content -notmatch "name: 'delete_all'") {
            $content = $content -replace 'this\.submit\(\);', "`$('<input>').attr({type: 'hidden', name: 'delete_all', value: '1'}).appendTo(this);`n                    this.submit();"
            Set-Content -Path $file.FullName -Value $content
            Write-Host "Corrigido JS: $($file.Name)"
        }
    }
}
