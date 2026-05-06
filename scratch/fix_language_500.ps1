$controllersDir = "g:\Tudo\MEU-SISTEMA\ETH ESTRATEGIAS\app\Http\Controllers"
$files = Get-ChildItem -Path $controllersDir -Filter "*.php" -Recurse

$search = "`$lang = Language::where('code', `$request->language)->first();"
$replace = "`$lang = Language::where('code', `$request->language)->first();`n        if (!`$lang) { `$lang = \App\Models\Language::where('is_default', 1)->first() ?? \App\Models\Language::first(); }"

foreach ($file in $files) {
    $content = Get-Content -Path $file.FullName -Raw
    if ($content -match [regex]::Escape($search)) {
        $content = $content -replace [regex]::Escape($search), $replace
        Set-Content -Path $file.FullName -Value $content
        Write-Host "Corrigido: $($file.Name)"
    }
}
