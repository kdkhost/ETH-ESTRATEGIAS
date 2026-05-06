# Changelog - ETH Estratégias

Todas as alterações notáveis neste projeto serão documentadas neste arquivo.

## [Unreleased]
### Planejado / Em Andamento
- **Atualização de Core:** Migração do Laravel 8 para Laravel 12.
- **Atualização de PHP:** Migração do PHP 7.3/8.0 para PHP 8.3/8.4.
- **Painel Administrativo:** Migração do tema SB Admin 2 (Bootstrap 4) para AdminLTE 4 (Bootstrap 5).
- **Editores e Uploads:** Substituição do Dropzone pelo FilePond e TinyMCE pelo Summernote no painel administrativo.
- **Notificações:** Padronização global de alertas usando SweetAlert2 e Toasty Notify via chamadas AJAX.
- **Documentação:** Estabelecimento de direitos autorais para Marcelo Brad RJ e sanitização da base de código legada.

## [1.0.0] - 2026-05-06
### Adicionado
- Importação da versão original de produção (Laravel 8) do servidor da ETH Estratégias para o repositório local e remoto.
- Sincronização direta configurada via SSH local-to-production usando remote `production`.
