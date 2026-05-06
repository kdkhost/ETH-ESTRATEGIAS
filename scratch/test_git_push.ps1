$keys = @(
    "C:/Users/marce/.ssh/id_ed25519_antigravity",
    "C:/Users/marce/.ssh/deploy_key",
    "C:/Users/marce/.ssh/id_rsa_novo_foco_deploy",
    "C:/Users/marce/.ssh/id_rsa"
)

foreach ($key in $keys) {
    if (Test-Path $key) {
        Write-Host "Tentando chave: $key"
        $env:GIT_SSH_COMMAND = "ssh -i `"$key`" -o IdentitiesOnly=yes -o StrictHostKeyChecking=no"
        git push origin master 2>&1
        if ($LASTEXITCODE -eq 0) {
            Write-Host "SUCESSO com a chave: $key"
            break
        }
    }
}
